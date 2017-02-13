<?php
namespace App\Console\Achieves\Common;

use Route;
use App\Models\Common\Parameters;
use App\Models\Common\RequestLog;

class RouteAnalyzer
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
        if(strpos($class_method, "::") !== false){
            $Reflection = new \ReflectionMethod($class_method);
        }else{
            $Reflection = new \ReflectionFunction($class_method);
        }
        $paArray = $Reflection->getParameters();
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
        $params = $this->getMethodParametersWithReflection($action[0].'::'.$action[1]);

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

}















