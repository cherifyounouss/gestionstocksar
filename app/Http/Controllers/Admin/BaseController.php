<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Etagere;
use App\Produit;
use View;

class BaseController extends Controller
{
    public function __construct()
    {
      $produits = Produit::all();
      //tableau pour stocker les produits en voie de rupture
      $produits_en_rupt = array();
      foreach ($produits as $produit) {
          //Si la quantite minimale accepté pour un produit est superieur a la quantite disponible en stock
          //Alors on conserve le dit produit au niveau de la table $produits_en_rupt
          if($produit->qte_min >= $produit->qte_stock){
              $produits_en_rupt[] = $produit;
          }
      }

      $nb_alertes = count($produits_en_rupt);

      //its just a dummy data object.
      $etageres = Etagere::all();
      
      View::share('nb_alertes', $nb_alertes);
      // Sharing is caring
      View::share('etageres', $etageres);
    }
}
