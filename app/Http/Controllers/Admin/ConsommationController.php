<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin;
use App\Http\Requests\ConsommationRequest;
use App\Produit;
use App\Consommation;
use App\Utilisateur;
use DateTime;
use Auth;

class ConsommationController extends BaseController
{

    public function __construct() {
        parent::__construct();
        $this->middleware('consommation_control');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produits = Produit::all();
        return view('stock.product.historic_consommation')->with(compact('produits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produits = Produit::all();
        return view('stock.product.consommation')->with(compact('produits'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConsommationRequest $request)
    {
        $request->validated();
        $data = $request->all();
        //On procede au traitement si et seulement le produit concerné par l'consommation existe
        if($produit = Produit::findOrFail($data['produit'])){

            //On sauvegarde les details de la consommation
            $consommation = new Consommation;
            $consommation->produit = $data['produit'];
            $consommation->conditionnement = $data['conditionnement'];
            $consommation->qte_cond = $data['qte_par_cond'];
            $consommation->total = $data['total'];
            $date_consommation = DateTime::createFromFormat('d/m/Y', $data['date_consommation']);
            $consommation->date_consommation = $date_consommation->format('Y-m-d');
            $consommation->utilisateur = Auth::guard('utilisateur')->id();
            $consommation->save();
            //On augmente le stock actuel
            $produit->qte_stock-=$data['total'];
            $produit->save();
            $successMessage = 'Le stock a été mis à jour';
            return redirect('/stock/consommer')->with('successMessage', $successMessage);
        }

        die;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function liste_cons_date(Request $request){
        $data = $request->all();
        //On cree un objet date a partir du format d/m/Y
        $date_debut = DateTime::createFromFormat('d/m/Y', $data['date_debut']);
        $date_fin = DateTime::createFromFormat('d/m/Y', $data['date_fin']);
        //On met l'objet date au format Y-m-d
        $date_debut = $date_debut->format('Y-m-d');
        $date_fin = $date_fin->format('Y-m-d');
        //Produit selectionné 
        $produit = $data['produit'];
        $response = '';
        //On verifie s'il existe des approvisionnements a la date choisis par l'utilisateur
        if($consommations = Consommation::whereDate('date_consommation', '>=', $date_debut)->whereDate('date_consommation', '<=', $date_fin)->where('produit',$produit)->get()){
            $response = '';
            foreach ($consommations as $consommation) {

                //On recupere le nom du produit grace a l'id correspondant au produit
                if($produit = Produit::findOrFail($consommation->produit)){
                    $consommation->nom_prod = $produit->nom_produit;
                }
                //On recupere le nom de l'utilisateur grace a l'id correspondant au nom de l'utilisateur
                if($utilisateur = Utilisateur::findOrFail($consommation->utilisateur)){
                    $consommation->nom_utilisateur = $utilisateur->prenom.' '.$utilisateur->nom;
                }
                //On construit le corps du tableau d'historique avec les donnees recueillis
                $response.='
                            <tr>
                                <td>'.$consommation->nom_prod.'</td>
                                <td>'.$consommation->conditionnement.'</td>
                                <td>'.$consommation->qte_cond.'</td>
                                <td>'.$consommation->total.'</td>
                                <td>'.$consommation->nom_utilisateur.'</td>
                            </tr>
                ';
            }
        }
        return $response;
    }
}
