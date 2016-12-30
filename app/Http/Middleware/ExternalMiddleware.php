<?php
namespace App\Http\Middleware;

use App\Services\Log\ServiceLog;
use Closure;

class ExternalMiddleware
{
    
    public static function setHeaders()
    {
        $header['Access-Control-Allow-Origin'] = '*';
        $header['Access-Control-Allow-Methods'] = 'GET, PUT, POST, DELETE, HEAD, OPTIONS';
        $header['Access-Control-Allow-Headers'] = 'X-Requested-With, Origin, X-Csrftoken, Content-Type, Accept';
    
        foreach ($header as $head => $value) {
            header("{$head}: {$value}");
        }
    }
    

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request            
     * @param \Closure $next            
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        self::setHeaders();
        
        return $next($request);
    }
}
