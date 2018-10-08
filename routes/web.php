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

// Route::get('/','Admin\EtagereController@listeEtagere');
// Route::get('/dashboard', 'Admin\EtagereController@listeEtagere');

Auth::routes();


Route::group(['middleware' => 'utilisateur_non_connecte'], function() {

    Route::get('/dashboard', 'Admin\HomeController@home');
    Route::get('/', 'Admin\HomeController@home');

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
    Route::get('/modifier_utilisateur/{id}', 'Admin\UserController@edit');
    Route::post('/modifier_utilisateur/{id}', 'Admin\UserController@update');
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

    //Notifications d'alerte
    Route::get('/notifications/alerte_stock', 'Admin\ProductController@get_alerte_stock');
    Route::get('/notifications/alerte_peremption', 'Admin\ProductController@get_alerte_date_prmtion');

    //Unite
    Route::post('/stock/ajouter_unite', 'Admin\UniteController@store');
    Route::get('/stock/unites', 'Admin\UniteController@unite_ajax');

    Route::get('/stock/liste_produit_etagere/{id}', 'Admin\ProductController@index_etagere');

    //Approvisionnement
    Route::get('/stock/approvisionner', 'Admin\ApprovisionnementController@create');
    Route::post('/stock/approvisionner', 'Admin\ApprovisionnementController@store');
    Route::get('/stock/historique_approvisionnement', 'Admin\ApprovisionnementController@index');
    Route::get('/liste_approvisionnement', 'Admin\ApprovisionnementController@liste_appro_date');

    //Consommation
    Route::get('/stock/consommer', 'Admin\ConsommationController@create');
    Route::post('/stock/consommer', 'Admin\ConsommationController@store');
    Route::get('/stock/historique_consommation', 'Admin\ConsommationController@index');
    Route::get('/liste_consommation', 'Admin\ConsommationController@liste_cons_date');

    //Role
    Route::get('/ajouter_role', 'Admin\RoleController@create');
    Route::post('/ajouter_role', 'Admin\RoleController@store');
    Route::get('/liste_role', 'Admin\RoleController@index');
    Route::get('/modifier_role/{id}', 'Admin\RoleController@edit');
    Route::post('/modifier_role/{id}', 'Admin\RoleController@update');
    Route::post('/supprimer_role', 'Admin\RoleController@destroy');

    Route::post('/deconnexion', 'Admin\LoginController@logout');
});

Route::group(['middleware' => 'utilisateur_connecte'], function() {
    Route::get('/se_connecter','Admin\LoginController@showLoginForm');
    Route::post('/connexion','Admin\LoginController@login');
    Route::get('utilisateur/reset/{token}', 'Admin\ResetPasswordController@showResetForm');
    Route::post('utilisateur/reset', 'Admin\ResetPasswordController@reset');
    Route::post('/password_request','Admin\ForgotPasswordController@sendResetLinkEmail');
    
});
















