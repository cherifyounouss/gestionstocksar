<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Etagere;
use View;

class BaseController extends Controller
{
    public function __construct()
    {
      //its just a dummy data object.
      $etageres = Etagere::all();
  
      // Sharing is caring
      View::share('etageres', $etageres);
    }
}
