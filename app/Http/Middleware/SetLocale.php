<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $request->route()->forgetParameter('locale');

        $lang = $request->segment(1);
        if($lang =='en' || $lang =='ar'){
            App::setLocale($lang);
        }else{
            \abort(404);
        }
        URL::defaults(['locale'=>app()->getLocale()]);
        $request->route()->forgetParameter('locale');
        return $next($request);
    }
}
