<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class ConsommationMiddleware
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
        //Si l'utilisateur connecté n'a pas la permission enregistrer consommation, il ne pourra pas acceder a cette page
        if ($request->is('stock/consommer')) {
            if(!Auth::guard('utilisateur')->user()->hasPermissionTo('enregistrer consommation')){
                abort('401');
            }
            else {
                return $next($request);
            }
        }
        //Si l'utilisateur connecté n'a pas la permission voir historique consommation, il ne pourra pas acceder a cette page
        if ($request->is('stock/historique_consommation')) {
            if(!Auth::guard('utilisateur')->user()->hasPermissionTo('voir historique consommation')){
                abort('401');
            }
            else {
                return $next($request);
            }            
        }         
        return $next($request);
    }
}
