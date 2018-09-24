<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/se_connecter','Admin\LoginController@showLoginForm');
Route::post('/connexion','Admin\LoginController@login');
Route::post('Admin\LoginController@logout');
Route::get('/accueil', function() {
    return "Bienvenue sur la page d'accueil";
});
Route::post('/password_request','Admin\ForgotPasswordController@sendResetLinkEmail');