<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\ResetsPasswords;

//Auth Facade
use Illuminate\Support\Facades\Auth;

//Password Broker Facade
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    //
    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
    */
    protected $redirectTo = "/dashboard";

    //Formulaire pour pouvoir reinitialiser le mot de passe
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset2')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
    
    // Retourne le password broker de l'utilisateur
    public function Broker(){
        return Password::broker('utilisateurs');
    }

    // Retourne le guard de l'utilisateur
    public function guard(){
        return Auth::guard('utilisateur');
        
    }

}
