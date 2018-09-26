<?php

namespace App\Http\Middleware;

use Closure;
//Auth facade;
use Auth;
class RedirectIfUserAuthenticated
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
        //Si la requete vient d'un n'importe quel utilisateur connectee, il sera redirige
        //Vers la page d'accueil
        if(Auth::guard()->check()){
            return redirect('/dashboard');
        }

        //Si la requete vient d'un utilisateur connecte (guard: utilisateur), il sera
        //redirige vers la page d'accueil
        if(Auth::guard('utilisateur')->check()){
            return redirect('/dashboard');
        }
        return $next($request);
    }
}
