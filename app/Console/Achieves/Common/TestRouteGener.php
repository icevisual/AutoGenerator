<?php
namespace App\Console\Achieves\Common;

use Route;
use App\Models\Common\Parameters;
use App\Models\Common\RequestLog;
use function GuzzleHttp\json_encode;

class TestRouteGener
{

    /**
     * 分割action
     *
     * @param unknown $action_name            
     * @return multitype:|boolean
     */
    public function compileAction($action_name)
    {
        if ('Closure' != $action_name) {
            if (strpos($action_name, '@')) {
                $action = explode('@', $action_name);
                return $action;
            }
        }
        return false;
    }

    /**
     * 获取action指向方法的所需参数和参数备注
     *
     * @param unknown $action            
     * @return multitype:boolean
     */
    public function getInputParamsAndAnns($action)
    {
        $codes = getFunctionDeclaration($action);
        return $this->filterParamsAndAnns($codes,$action);
    }

    /**
     * @param unknown $class_method
     * Class name and method name delimited by ::. 
     */
    public function getMethodParametersWithReflection($class_method)
    {
        $ReflectionMethod = new \ReflectionMethod($class_method);
        $paArray = $ReflectionMethod->getParameters();
        $params = [];
        foreach ($paArray as $v){
            $pa = [];
            $pa['type'] = 'String';
            if($v->isDefaultValueAvailable()){
                $pa['default'] = $v->getDefaultValue();
            }
            $pa['name'] = $v->getName();
            $params[$v->getName()] = $pa;
        }
        return $params;
    }
    
    /**
     * 获取函数的参数
     * 
     * @param unknown $codesArray            
     * @return multitype:multitype:string unknown
     */
    public function findFunctionParameters($codesArray)
    {
        $params = [];
        $funcPa = '';
        $findTag = false;
        foreach ($codesArray as $line) {
            if (! $findTag) {
                if (($p1 = strpos($line, '(')) !== false) {
                    $findTag = true;
                    if (($p2 = strpos($line, ')')) !== false) {
                        $funcPa = trim(substr($line, $p1 + 1, $p2 - $p1 - 1));
                        break;
                    } else {
                        $funcPa = trim(substr($line, $p1 + 1));
                    }
                }
            } else {
                if (($p2 = strpos($line, ')')) !== false) {
                    $funcPa .= trim(substr($line, 0, $p2));
                    break;
                } else {
                    $funcPa .= trim($line);
                }
            }
        }
        
        if ($funcPa) {
            foreach (explode(',', $funcPa) as $v) {
                $v = substr(trim($v), 1);
                
                if (strpos($v, '=') !== false) {
                    // has default value
                    $segs = explode('=', $v, 2);
                    
                    $params[trim($segs[0])] = [
                        'type' => 'String',
                        'name' => $segs[0],
                        'default' => trim($segs[1], ' \'')
                    ];
                } else {
                    $params[$v] = [
                        'type' => 'String',
                        'name' => $v
                    ];
                }
            }
        }
        return $params;
    }

    /**
     * 判别所需参数，现以Input::get()判定
     *
     * @param unknown $codes            
     * @return multitype:boolean
     */
    public function filterParamsAndAnns($codes,$action)
    {
        $params = array();
        if (! is_array($codes))
            return false;
        $params1 = $this->findFunctionParameters($codes);
        $params = $this->getMethodParametersWithReflection($action[0].'::'.$action[1]);

        if(json_encode($params1) != json_encode($params)){
            dd($params1,$params);
        }
        
        array_walk($codes, function ($v, $k) use(&$params, $codes) {
            $regs = [
                '/(?:Input::get|\$request->input)\s*\(\s*[\'\"]([\w\d_]*)[\'\"]\s*(?:\s*,\s*[\'\"]?([\s\w_\-]*)[\'\"]?\s*)?\)/',
                '/\$_(?:POST|GET)\s*\[[\'\"]([\w\d_]*)[\'\"]\]/'
            ];
            $hit = false;
            foreach ($regs as $regex) {
                $r = preg_match($regex, $v, $matchs);
                if ($r) {
                    $hit = true;
                    $params[$matchs[1]] = [];
                    if (isset($matchs[2])) {
                        // 设置默认值
                        $params[$matchs[1]] = [
                            'default' => $matchs[2]
                        ];
                    }
                    break;
                }
            }
            if ($hit) {
                if (isset($codes[$k - 1])) {
                    // 获取 参数名称、类别
                    $ann = trim($codes[$k - 1]);
                    if (strpos($ann, '//') === 0) {
                        list ($params[$matchs[1]]['type'], $params[$matchs[1]]['name']) = $this->getPossibleTypeAndName(trim($ann, "/ \r\n"));
                    } else {
                        $ann = explode("//", $v, 2);
                        if (isset($ann[1])) {
                            $ann = trim($ann[1], "/ \r\n");
                            list ($params[$matchs[1]]['type'], $params[$matchs[1]]['name']) = $this->getPossibleTypeAndName(trim($ann, "/ \r\n"));
                        } else {
                            $params[$matchs[1]]['name'] = $this->getDefaultParamName($matchs[1]);
                            $params[$matchs[1]]['type'] = 'String';
                        }
                    }
                }
            }
        });
        return $params;
    }

    /**
     * 分析备注。获取参数类别和名称
     *
     * @param unknown $ann            
     * @return multitype:string unknown
     */
    protected function getPossibleTypeAndName($ann)
    {
        // TODO 根据参数名称 自学习类别
        if (strpos($ann, ' ') === false) {
            return [
                'String',
                $ann
            ];
        }
        $segments = explode(" ", $ann, 2);
        $standardTypesArray = [
            'string',
            'array',
            'object',
            'int',
            'integer',
            'float',
            'double',
            'bool',
            'boolean',
            'file',
            'long',
            'char',
            'short',
            'varchar',
            'date',
            'time',
            'datatime'
        ];
        $standardTypesArray = array_flip($standardTypesArray);
        if (isset($standardTypesArray[strtolower($segments[0])])) {
            return [
                ucfirst(strtolower($segments[0])),
                trim($segments[1])
            ];
        }
        if (isset($standardTypesArray[strtolower($segments[1])])) {
            return [
                ucfirst(strtolower($segments[1])),
                trim($segments[0])
            ];
        }
        return [
            'String',
            $ann
        ];
    }

    protected function getDefaultParamName($property)
    {
        // fill Default Map , from exists params of other api , 自学习算法
        $name = Parameters::searchParameters($property);
        return $name ? $name : 'unknown';
    }

    /**
     *
     * @param string $env            
     * @param string $apidocAnnstorageFile            
     */
    public function run($apidocAnnstorageFile = '')
    {
        // Add route matcher & output file &
        
        
        
        
        
        
        $ignoreRoutes = [];
        
        $handlePrefix = 'api';
        
        $routes = \Route::getRoutes();
        
        $routesSelect = [];
        
        foreach ($routes as $v) {
            $data = [];
            $method = [];
            $methods = $v->getMethods();
            $uri = $v->getPath();
            $action = $v->getActionName();
            
            if (in_array($uri, $ignoreRoutes)) {
                continue;
            }
            
            if (strpos($uri, $handlePrefix) !== 0) {
                continue;
            }
            $actionData = $v->getAction();
            // 分割action , 不解析 Closure
            $action = $this->compileAction($action);
            if (! $action || ! method_exists($action[0], $action[1])) {
                continue;
            }
            in_array('POST', $methods) and $method[] = 'POST';
            in_array('GET', $methods) and $method[] = 'GET';
            empty($method) && $method[] = $methods[0];
            // 生成method和uri
            $data = [
                'as' => array_get($actionData, 'as', false),
                'method' => '[' . implode('/', $method) . ']',
                'doMethod' => $method[0],
                'uri' => ltrim($uri, '/')
            ];
            // 获取action指向的方法内的参数
            $data['params'] = $this->getInputParamsAndAnns($action);
            
            $funcAnn = getAnnotation($action);
            
            $data['uriName'] = array_get($funcAnn, 'function.note', $action[1]);
            
            if (isset($funcAnn['@apiName'])) {
                $data['apiName'] = $funcAnn['@apiName'][0]['type'];
            }
            if (isset($funcAnn['@apiContentType'])) {
                $data['apiContentType'] = $funcAnn['@apiContentType'][0]['type'];
            }
            
            $routesSelect[] = $data;
        }
        $this->gener($routesSelect);
        
        return ($routesSelect);
    }

    public function randerFunctionNotRetJson($data)
    {
        extract($data);
        $method = strtolower($method);
        
        if ('get' == $method) {
            $route = "        \$ret = \$this->{$method}Json({$route}.'?'.http_build_query(\$data));";
        } else {
            $route = "        \$ret = \$this->{$method}Json({$route},\$data);";
        }
        
        $template = <<<EOF
    
    /**
     * $describe
     *
     * $paramAnn
     */
    public function $functionName(\$params = [])
    {
        \$data = [
$paramKeyValueAnnType
        ];
$route
        return \$ret;
    }
EOF;
        return $template . PHP_EOL;
    }

    public function randerFunction($data)
    {
        extract($data);
        $method = strtolower($method);
        
        if ('get' == $method) {
            $route = "        \$ret = \$this->{$method}Json({$route}.'?'.http_build_query(\$data))->toJson();";
        } else {
            $route = "        \$ret = \$this->{$method}Json({$route},\$data)->toJson();";
        }
        
        $template = <<<EOF
        
    /**
     * $describe
     *
     * $paramAnn
     */
    public function $functionName(\$params = [])
    {
        \$data = [
$paramKeyValueAnnType
        ];
$route
        return \$ret;
    }
EOF;
        return $template . PHP_EOL;
    }

    public function randerParamLine($data)
    {
        $ret = '';
        foreach ($data as $v) {
            extract($v);
            $ret .= <<<EOF
            '$key' => array_get(\$params,'$key',''),// $name $type
EOF;
            $ret .= PHP_EOL;
        }
        return rtrim($ret, "\r\n");
    }

    public function randerParamAnn($data)
    {
        $ret = <<<EOF
     * @param array \$params
     *            <pre>
EOF;
        $ret .= PHP_EOL;
        foreach ($data as $v) {
            extract($v);
            $ret .= <<<EOF
     *            '$key' => '', //$type $name
EOF;
            $ret .= PHP_EOL;
        }
        $ret .= <<<EOF
     *            </pre>
EOF;
        return rtrim(ltrim($ret, ' *'), "\r\n");
    }

    public function randerTemplate($data)
    {
        extract($data);
        $template = <<<EOF
<?php 

use App\Services\Open\OpenServices;

class TestRoutes extends TestCase
{
$functions
}
EOF;
        return $template . PHP_EOL;
    }

    public function parseUriWithParameter($data)
    {
        $uri = $data['uri'];
        $pattern = '/\{(\w+)\}/';
        preg_match_all($pattern, $data['uri'], $matches);
        $ret = [
            'uri' => '',
            'param' => []
        ];
        if (isset($matches[0]) && $matches[0]) {
            foreach ($matches[0] as $key => $holder) {
                $uri = str_replace($holder, "'.\$data['{$matches[1][$key]}'].'", $uri);
            }
            $ret['uri'] = $uri;
            $ret['param'] = $matches[1];
            return $ret;
        }
        return false;
    }

    public function gener($data)
    {
        $functionStr = '';
        foreach ($data as $v) {
            $uriParsed = false;
            $as = array_get($v, 'as');
            $funcData = [
                'describe' => $v['uriName'],
                'method' => $v['doMethod'],
                'functionName' => '',
                'paramKeyValueAnnType' => '',
                'route' => '',
                'paramAnn' => ''
            ];
            if (isset($v['uri'])) {
                $uriParsed = $this->parseUriWithParameter($v);
            }
            if (! $as) {
                $funcData['functionName'] = str_replace('/', '_', $v['uri']);
                $funcData['route'] = '\'' . $v['uri'] . '\'';
                if ($uriParsed) {
                    $funcData['route'] = '\'' . $uriParsed['uri'] . '\'';
                }
            } else {
                $funcData['functionName'] = $as;
                $funcData['route'] = 'route(\'' . $as . '\')';
                if ($uriParsed) {
                    $funcData['route'] = 'route(\'' . $as . '\',array_only($data,[' . '\'' . implode("','", $uriParsed['param']) . '\'' . ']))';
                }
            }
            
            if (! empty($v['params'])) {
                $input = [];
                foreach ($v['params'] as $ka => $pa) {
                    $input[] = [
                        'key' => $ka,
                        'name' => $pa['name'],
                        'type' => $pa['type']
                    ];
                }
                $funcData['paramAnn'] = $this->randerParamAnn($input);
                $funcData['paramKeyValueAnnType'] = $this->randerParamLine($input);
            }
            // 获取图像验证码，无需返回JSON
            if (isset($v['apiContentType']) && strtolower(substr($v['apiContentType'], - 4)) != 'json') {
                $functionStr .= $this->randerFunctionNotRetJson($funcData);
            } else {
                $functionStr .= $this->randerFunction($funcData);
            }
        }
        $str = $this->randerTemplate([
            'functions' => $functionStr
        ]);
        file_put_contents(base_path('tests') . DIRECTORY_SEPARATOR.'TestRoutes.php', $str);
    }

}















