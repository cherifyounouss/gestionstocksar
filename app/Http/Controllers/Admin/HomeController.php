<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\BaseController;
use App\Produit;
use App\Utilisateur;
use App\Etagere;
use App\Fournisseur;


class HomeController extends BaseController
{
    public function home() {
        $nb_produits = Produit::all()->count();
        $nb_utilisateurs = Utilisateur::all()->count();
        $nb_etageres = Etagere::all()->count();
        $nb_fournisseurs = Fournisseur::all()->count();
        return view('dashboard')->with([
            'nb_produits' => $nb_produits,
            'nb_utilisateurs' => $nb_utilisateurs,
            'nb_etageres' => $nb_etageres,
            'nb_fournisseurs' => $nb_fournisseurs,
        ]);
    }
}
