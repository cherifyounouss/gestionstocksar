<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class FournisseurMiddleware
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

        //Si l'utilisateur connecté n'a pas la permission lister fournisseur, il ne pourra pas acceder a cette page
        if($request->is('liste_fournisseur')){
            if (!Auth::guard('utilisateur')->user()->hasPermissionTo('lister fournisseur')) {
                abort('401');
            }
            else {
                return $next($request);
            }
        }
        //Si l'utilisateur connecté n'a pas la permission creer, il ne pourra pas acceder a cette page
        if($request->is('ajouter_fournisseur')){
            if (!Auth::guard('utilisateur')->user()->hasPermissionTo('creer fournisseur')) {
                abort('401');
            }
            else {
                return $next($request);
            }
        }
        //Si l'utilisateur connecté n'a pas la permission modifier fournisseur, il ne pourra pas acceder a cette page
        if($request->is('modifier_fournisseur/*')){
            if (!Auth::guard('utilisateur')->user()->hasPermissionTo('modifier fournisseur')) {
                abort('401');
            }
            else {
                return $next($request);
            }
        }
        return $next($request);
    }
}
