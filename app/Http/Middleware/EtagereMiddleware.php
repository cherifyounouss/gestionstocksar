<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class EtagereMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //Si l'utilisateur connecté n'a pas la permission creer etagere, il ne pourra pas acceder a cette page
        if ($request->is('stock/ajouter_etagere')) {
            if(!Auth::guard('utilisateur')->user()->hasPermissionTo('creer etagere')){
                abort('401');
            }
            else {
                return $next($request);
            }
        }
        //Si l'utilisateur connecté n'a pas la permission modifier etagere, il ne pourra pas acceder a cette page
        if ($request->is('stock/liste_etagere')) {
            if(!Auth::guard('utilisateur')->user()->hasPermissionTo('lister etagere')){
                abort('401');
            }
            else {
                return $next($request);
            }            
        }
        //Si l'utilisateur connecté n'a pas la permission lister etagere, il ne pourra pas acceder a cette page
        if ($request->is('stock/modifier_etagere/*')) {
            if(!Auth::guard('utilisateur')->user()->hasPermissionTo('modifier etagere')){
                abort('401');
            }
            else {
                return $next($request);
            }            
        }
        
        return $next($request);
    }
}
