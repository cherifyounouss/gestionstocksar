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

Route::get('/dashboard', function () {
    return view('dashboard');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/se_connecter','Admin\LoginController@showLoginForm');
Route::post('/connexion','Admin\LoginController@login');
Route::post('Admin\LoginController@logout');
Route::get('utilisateur/reset/{token}', 'Admin\ResetPasswordController@showResetForm');
Route::post('utilisateur/reset', 'Admin\ResetPasswordController@reset');
Route::get('/accueil', function() {
    return "Bienvenue sur la page d'accueil";
});
Route::post('/password_request','Admin\ForgotPasswordController@sendResetLinkEmail');

//Fournisseur
Route::get('/ajouter_fournisseur', 'Admin\ProviderController@create');
Route::post('/ajouter_fournisseur', 'Admin\ProviderController@store');
Route::get('/liste_fournisseur', 'Admin\ProviderController@index');
Route::get('/modifier_fournisseur/{id}', 'Admin\ProviderController@edit');
Route::post('/modifier_fournisseur/{id}', 'Admin\ProviderController@update');
Route::post('/supprimer_fournisseur/{id}','Admin\ProviderController@destroy');