<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Etagere;
use App\Produit;
use View;
use DateTime;
use Carbon\Carbon;
use App\Approvisionnement;

class BaseController extends Controller
{
    public function __construct()
    {
      $produits = Produit::all();
      $approvisionnements = Approvisionnement::all();
      //tableau pour stocker les produits en voie de rupture
      $produits_en_rupt = array();
      //tableau pour stocker les produits en voie de peremption
      $produits_en_per = array();
      //Date du jour
      $today = Carbon::now();
      foreach ($produits as $produit) {
          //Si la quantite minimale accepté pour un produit est superieur a la quantite disponible en stock
          //Alors on conserve le dit produit au niveau de la table $produits_en_rupt
          if($produit->qte_min >= $produit->qte_stock){
              $produits_en_rupt[] = $produit;
          }
        //   $date_peremption = Carbon::createFromFormat('Y-m-d', $produit->date_peremption);
        //   //Les produits dont la date de peremption est dans deux semaines
        //   if ($date_peremption->diffInWeeks($today) <= 2){
        //       $produit->intervalle = $date_peremption->diffInWeeks($today);
        //       $produits_en_per[] = $produit;
        //   }
      }

      foreach ($approvisionnements as $approvisionnement) {
        $date_peremption = Carbon::createFromFormat('Y-m-d', $approvisionnement->date_peremption);
        $produit = Produit::findOrFail($approvisionnement->produit);
        //Les produits dont la date de peremption est dans moins de 8 semaines
        if ($date_peremption->diffInWeeks($today) <= 8){
            $produits_en_per[] = $approvisionnement;
        }
        //end of if
    }

      //nombres d'alertes total = nombre d'alertes pour rupture de stock + nombre d'alerte pour date de preemption
      $nb_alertes = count($produits_en_per) + count($produits_en_rupt);

      //its just a dummy data object.
      $etageres = Etagere::all();
      //nombres d'alertes partagées avec toutes les vues
      View::share('nb_alertes', $nb_alertes);
      View::share('nb_produits_en_per', count($produits_en_per));
      View::share('nb_produits_en_rupt', count($produits_en_rupt));
      // Sharing is caring
      View::share('etageres', $etageres);
    }
}
