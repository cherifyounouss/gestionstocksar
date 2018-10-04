<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\BaseController;

class HomeController extends BaseController
{
    public function home() {
        return view('dashboard');
    }
}
