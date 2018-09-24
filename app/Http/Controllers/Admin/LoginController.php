<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Auth;

class LoginController extends Controller
{
    //
    use AuthenticatesUsers;

    protected $redirectTo = '/accueil';

    public function showLoginForm(){
        return view('auth.login');
    }


    protected function guard(){
        return Auth::guard('utilisateur');
    }
}
