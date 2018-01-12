<?php
/**
 * Created by PhpStorm.
 * User: zippyttech
 * Date: 12/01/18
 * Time: 03:10 PM
 */

namespace Infrastructure\Http\Middleware;


use Closure;
class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request
     * @param \Closure
    $request
    $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//Here we put our client domains
        $trusted_domains = ["http://localhost:4200", "http://localhost:8500"];
        if(isset($request->server()['HTTP_ORIGIN'])) {
            $origin = $request->server()['HTTP_ORIGIN'];
            if(in_array($origin, $trusted_domains)) {
                header('Access-Control-Allow-Origin: ' . $origin);
                header('Access-Control-Allow-Headers: Origin, Content-Type');
            }
        }
        return $next($request);
    }
}