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

Route::get('/','Admin\EtagereController@listeEtagere');
Route::get('/dashboard', 'Admin\EtagereController@listeEtagere');

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
Route::post('/supprimer_fournisseur','Admin\ProviderController@destroy');

//Utilisateur
Route::get('/ajouter_utilisateur', 'Admin\UserController@create');
Route::post('/ajouter_utilisateur', 'Admin\UserController@store');
Route::get('/liste_utilisateur', 'Admin\UserController@index');
Route::post('/supprimer_utilisateur', 'Admin\UserController@destroy');

//Etagere
Route::get('/stock/ajouter_etagere', 'Admin\EtagereController@create');
Route::post('/stock/ajouter_etagere', 'Admin\EtagereController@store');
Route::get('/stock/liste_etagere', 'Admin\EtagereController@index');
Route::get('/stock/modifier_etagere/{id}', 'Admin\EtagereController@edit');
Route::post('/stock/modifier_etagere/{id}', 'Admin\EtagereController@update');
Route::post('/stock/supprimer_etagere', 'Admin\EtagereController@destroy');

//Produit
Route::get('/stock/ajouter_produit', 'Admin\ProductController@create');
Route::post('/stock/ajouter_produit', 'Admin\ProductController@store');
Route::get('/stock/liste_produit', 'Admin\ProductController@index');
Route::get('/view_file/{fds}','Admin\ProductController@view_file');
Route::get('/stock/modifier_produit/{id}', 'Admin\ProductController@edit');
Route::post('/stock/modifier_produit/{id}', 'Admin\ProductController@update');
Route::post('/stock/supprimer_produit', 'Admin\ProductController@destroy');

//Unite
Route::post('/stock/ajouter_unite', 'Admin\UniteController@store');
Route::get('/stock/unites', 'Admin\UniteController@unite_ajax');

Route::get('/stock/liste_produit_etagere/{id}', 'Admin\ProductController@index_etagere');

//Approvisionnement
Route::get('/stock/approvisionner', 'Admin\ApprovisionnementController@create');
Route::post('/stock/approvisionner', 'Admin\ApprovisionnementController@store');
Route::get('/stock/historique_approvisionnement', 'Admin\ApprovisionnementController@index');
Route::get('/liste_approvisionnement', 'Admin\ApprovisionnementController@liste_appro_date');