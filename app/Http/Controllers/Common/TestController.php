<?php
namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Exceptions\ServiceException;

class TestController extends Controller
{

    
    
    public function test()
    {
        
        $string = 'safasdf ad json';

        
        edump(substr($string, -4));
            
            
        phpinfo();
        
        exit;
        
        dump( \App\Models\Common\Region::getRegionName(6,192,218));
        exit;
        $file = public_path('a.txt');
        
        $str = file_get_contents($file);
        $str = trim($str,' ,');
        $str = strtolower($str);
        $name = [];
        $name = explode(', ', $str);
        sort($name);
        $data = implode('#', $name);
        $de_ = base64_encode(gzdeflate($data,9));
        dump($de_);;
        dump($data);
        dump(gzinflate(base64_decode($de_)));
        
//         $data = \App\Models\Common\Region::getAllRegions();
//         dump($data[6]['children'][0]);
        
        exit;
        \App\Extensions\Common\ErrorCode::detectError();
        exit;
        \App\Models\Common\Region::throwExc();
        
        $this->assddddd();
//         \App\Models\Common\RequestLog::upgradeSha1();
        return '';
        exit;
        \App\Services\Adag\ApidocAnnParser::autoGeneration('parse','',1);
        exit;
//         (?=X) X, via zero-width positive lookahead
//         (?!X) X, via zero-width negative lookahead
//         (?<=X) X, via zero-width positive lookbehind
//         (?<!X) X, via zero-width negative lookbehind
        
        $str = 'abcdEfgh';
        
        preg_match_all('/(.)(?=[A-Z])/u', $str,$matchs);
        
        edump($matchs);
        
        
//         edump(\Illuminate\Support\Str::snake('asdAsdArrrr'));
        
        \App\Services\Adag\ApidocAnnParser::autoGeneration();
        
        exit;
        
        edump(\Carbon\Carbon::now()->__toString());
        
        $data = \App\Models\Common\RequestLog::where('id',">",'0')->limit(2)->get();
        return $this->__json($data);
    }
}


