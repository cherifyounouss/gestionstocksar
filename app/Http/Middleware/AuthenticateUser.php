<?php

namespace App\Http\Middleware;

use Closure;
//Auth facade
use Auth;

class AuthenticateUser
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
        //Si les requetes proviennent d'un utilisateur non connecte,
        //On lui renvoie vers la page d'identification (login)
        if(!Auth::guard('utilisateur')->check()){
            return redirect('/se_connecter');
        }
        return $next($request);
    }
}
