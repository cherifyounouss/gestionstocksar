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

    protected $redirectTo = '/dashboard';

    public function showLoginForm(){
        return view('auth.login');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/se_connecter');
    }

    protected function guard(){
        return Auth::guard('utilisateur');
    }
}
