<?php
namespace App\Console\Achieves\ConfigParser;

use App\Extensions\Common\ConstTrait;

class Adjudicator implements AdjudicatorConstInter
{
    
    use ConstTrait;
    
    public function judgeApiParameter($key,$value){
        return $key == 'data';
    }
    
    public function judgeApiValidate($key,$value){
        return $key == 'validate';
    }
    
    
}















