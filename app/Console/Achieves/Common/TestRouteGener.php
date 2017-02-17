<?php
namespace App\Console\Achieves\Common;

use Route;
use App\Models\Common\Parameters;
use App\Models\Common\RequestLog;
use Illuminate\Support\Str;

class TestRouteGener extends RouteAnalyzer
{

    protected $storagePath = '/tests/TestRoutes.php';

    protected $filterSetting = [
        'except' => [],
        'only' => [],
        'prefix' => ['api/auto']
    ];
    
    
    public function getFilterSetting($key = ''){
        if($key){
            return array_get($this->filterSetting, $key,false);
        }
        return $this->filterSetting;
    }
    
    public function setFilterSetting(array $setting)
    {
        foreach ($this->filterSetting as $k => $v){
            if(isset($setting[$k])){
                $this->filterSetting[$k] = is_array($setting[$k]) ? $setting[$k] : [$setting[$k]];
            }
        }
    }

    public function setStoragePath($storagePath)
    {
        $storagePath && $this->storagePath = $storagePath;
    }

    public function getStoragePath()
    {
        $storagePath = preg_replace('/[\/\\\\]/', DIRECTORY_SEPARATOR, trim($this->storagePath, "\/"));
        return base_path($storagePath);
    }
    
    public function getStorageClassName()
    {
        $pathinfo = pathinfo($this->storagePath,PATHINFO_FILENAME);
        return $pathinfo;
    }
    

    public function filterUri($uri)
    {
        $filterHandlers = array_keys($this->filterSetting);
        
        foreach ($filterHandlers as $handler){
            if(empty($this->getFilterSetting($handler))){
                continue;
            }
            $handlerName = 'filter'.ucfirst(strtolower($handler)).'Uri';
            if(method_exists($this, $handlerName)){
                $handlerResult = call_user_func_array([
                    $this,$handlerName
                ], [$uri]);
                if(false === $handlerResult){
                    return false;
                }
            }
        }
        return true;
    }
    
    public function filterExceptUri($uri)
    {
        foreach ($this->getFilterSetting('except') as $k => $v){
            if(Str::is($v, $uri)){
                return false;
            }
        }
        return true;
    }
    
    public function filterOnlyUri($uri)
    {
        foreach ($this->getFilterSetting('only') as $k => $v){
            if(Str::is($v, $uri)){
                return true;
            }
        }
        return false;
    }
    
    public function filterPrefixUri($uri)
    {
        foreach ($this->getFilterSetting('prefix') as $k => $v){
            if(Str::is($v.'*', $uri)){
                return true;
            }
        }
        return false;
    }

    /**
     *
     * @param string $storagePath            
     * @param unknown $fileter            
     */
    public function make($storagePath = '', $setting = [])
    {
        $this->setStoragePath($storagePath);
        $this->setFilterSetting($setting);
        // Add route matcher & output file &
        $routes = \Route::getRoutes();
        
        $routesSelect = [];
        
        foreach ($routes as $v) {
            $data = [];
            $method = [];
            $methods = $v->getMethods();
            $uri = $v->getPath();
            $action = $v->getActionName();
            
            if(false === $this->filterUri($uri)){
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
        $className = $this->getStorageClassName();
        $template = <<<EOF
<?php 

class $className extends TestCase
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
        file_put_contents($this->getStoragePath(), $str);
    }
}















