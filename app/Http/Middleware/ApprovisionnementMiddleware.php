<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class ApprovisionnementMiddleware
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
        //Si l'utilisateur connecté n'a pas la permission approvisionner stock, il ne pourra pas acceder a cette page
        if ($request->is('stock/approvisionner')) {
            if(!Auth::guard('utilisateur')->user()->hasPermissionTo('approvisionner stock')){
                abort('401');
            }
            else {
                return $next($request);
            }
        }
        //Si l'utilisateur connecté n'a pas la permission voir historique approvisionnement, il ne pourra pas acceder a cette page
        if ($request->is('stock/historique_approvisionnement')) {
            if(!Auth::guard('utilisateur')->user()->hasPermissionTo('voir historique approvisionnement')){
                abort('401');
            }
            else {
                return $next($request);
            }            
        }        
        return $next($request);
    }
}
