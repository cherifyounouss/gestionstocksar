<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class ProductMiddleware
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
        //Si l'utilisateur connecté n'a pas la permission lister produit, il ne pourra pas acceder a cette page
        if($request->is('stock/liste_produit')){
            if (!Auth::guard('utilisateur')->user()->hasPermissionTo('lister produit')) {
                abort('401');
            }
            else {
                return $next($request);
            }
        }
        //Si l'utilisateur connecté n'a pas la permission creer, il ne pourra pas acceder a cette page
        if($request->is('stock/ajouter_produit')){
            if (!Auth::guard('utilisateur')->user()->hasPermissionTo('creer produit')) {
                abort('401');
            }
            else {
                return $next($request);
            }
        }
        //Si l'utilisateur connecté n'a pas la permission modifier fournisseur, il ne pourra pas acceder a cette page
        if($request->is('stock/modifier_produit/*')){
            if (!Auth::guard('utilisateur')->user()->hasPermissionTo('modifier produit')) {
                abort('401');
            }
            else {
                return $next($request);
            }
        }

        return $next($request);
    }
}
