<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\BaseController;
use App\Produit;
use App\Etagere;
use App\Http\Requests\ProductRequest;
use Carbon\Carbon;
use Response;
use DateTime;
class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produits = Produit::all();
        //On change le format des dates en jj/mm/aa
        foreach ($produits as $produit) {
            $date_peremption = DateTime::createFromFormat('Y-m-d',$produit->date_peremption);
            $produit->date_peremption = $date_peremption->format('d-m-Y');
            $date_exp_fds = DateTime::createFromFormat('Y-m-d',$produit->date_exp_fds);
            $produit->date_exp_fds = $date_exp_fds->format('d-m-Y');
        }
        return view('stock.product.list')->with(compact('produits'));
    }

    /**
     * Formulaire pour creer un nouveau produit
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $etageres = Etagere::all();
        return view('stock.product.new')->with(compact('etageres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $request->validated();
        $data = $request->all();
        // $data['date_peremption'] = date("Y-m-d", strtotime($data['date_peremption']));
        // $data['date_exp_fds'] = date("Y-m-d", strtotime($data['date_exp_fds']));
        
        //Test de sauvegarde des informations au niveau de la base de donnees
        $produit = new Produit;
        $produit->nom_produit = $data['nom_produit'];
        $produit->est_solvant = $data['solvant'];
        $produit->criticite = $data['criticite'];
        $date_peremption = DateTime::createFromFormat('d/m/Y', $data['date_peremption']);
        // $produit->date_peremption = Carbon::parse(date($data['date_peremption']))->format('Y-m-d');
        $produit->date_peremption = $date_peremption->format('Y-m-d');
        $produit->qte_stock = $data['qte_stock'];
        $produit->qte_min = $data['qte_min'];
        $produit->unite = $data['unite'];
        $produit->etagere = $data['etagere'];
        $produit->casier = $data['num_casier'];
        $date_exp_fds = DateTime::createFromFormat('d/m/Y', $data['date_exp_fds']);
        // $produit->date_exp_fds = Carbon::parse(date($data['date_exp_fds']))->format('Y-m-d');
        $produit->date_exp_fds = $date_exp_fds->format('Y-m-d');
        //Traitement du fichier
        //On verifie si le fichier est bien présent
        if($file = $request->hasFile('fds')){
            $file = $request->file('fds');
            $extension = $file->getClientOriginalExtension();
            $nom_fichier = rand(111,99999).'.'.$extension;
            // $nom_fichier = $file->getClientOriginalName();
            $destination = public_path()."/fds/";
            $file->move($destination, $nom_fichier);
            $produit->fds = $nom_fichier;
        }
        $produit->save();
        $successMessage = 'Le nouveau produit a été enregistré';
        
        return redirect('/stock/liste_produit')->with('successMessage', $successMessage);
        
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
        $produit = Produit::findOrFail($id);
        $produit = json_decode($produit);
        $date_peremption = DateTime::createFromFormat('Y-m-d',$produit->date_peremption);
        $produit->date_peremption = $date_peremption->format('d/m/Y');
        $date_exp_fds = DateTime::createFromFormat('Y-m-d',$produit->date_exp_fds);
        $produit->date_exp_fds = $date_exp_fds->format('d/m/Y');
        // $produit->date_peremption = DateTime::format('d-m-Y', $produit->date_peremption);
        // $produit->date_exp_fds = DateTime::createFromFormat('d-m-Y', $produit->date_exp_fds);
 
        return view('stock.product.edit')->with(compact('produit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $request->validated();
        $data = $request->all();

        $produit = Produit::findOrFail($id);

        $produit->nom_produit = $data['nom_produit'];
        $produit->est_solvant = $data['solvant'];
        $produit->criticite = $data['criticite'];
        $date_peremption = DateTime::createFromFormat('d/m/Y', $data['date_peremption']);
        $produit->date_peremption = $date_peremption->format('Y-m-d');
        $date_exp_fds = DateTime::createFromFormat('d/m/Y',$data['date_exp_fds']);
        $produit->date_exp_fds = $date_exp_fds->format('Y-m-d');
        $produit->qte_stock = $data['qte_stock'];
        $produit->qte_min = $data['qte_min'];
        $produit->unite = $data['unite'];
        $produit->etagere = $data['etagere'];
        $produit->casier = $data['num_casier'];
        //Traitement du fichier
        //On verifie si le fichier est bien présent
        if($file = $request->hasFile('fds')){
            $file = $request->file('fds');
            $nom_fichier = $file->getClientOriginalName();
            $destination = public_path()."/fds/";
            $file->move($destination, $nom_fichier);
            $produit->fds = $nom_fichier;
        }
        $produit->save();
        $successMessage = 'Les modifications ont été enregistrées';
        
        return redirect('/stock/liste_produit')->with('successMessage', $successMessage);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        $etagere = Produit::findOrFail($id);
        $etagere->delete();
        return "success";
    }

    public function view_file($fds){
        // $pdf = \App::make(public_path()."/fds/$fds");
        // return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView(public_path()."/fds/$fds")->stream();
        // return $pdf->stream(); 
            $response = Response::make(public_path()."/fds/$fds", 200); 
            $response->header('Content-Type', 'application/pdf'); 
            return $response; 
    }

    public function index_etagere($id)
    {
        $produits = Produit::where('etagere',$id)->get();
            //On change le format des dates en jj/mm/aa
            foreach ($produits as $produit) {
                $date_peremption = DateTime::createFromFormat('Y-m-d',$produit->date_peremption);
                $produit->date_peremption = $date_peremption->format('d-m-Y');
                $date_exp_fds = DateTime::createFromFormat('Y-m-d',$produit->date_exp_fds);
                $produit->date_exp_fds = $date_exp_fds->format('d-m-Y');
            }
        $produits = json_decode($produits);
        return view('stock.product.list_etagere')->with(compact('produits'));
    }
    
    /*
    *
    *fonction pour recuperer les produits dont la quantite minimun d'alerte a été atteinte
    *
    */
    public function get_alerte_stock(Request $request){
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
        return view('alertes.alerte_stock')->with(compact('produits_en_rupt'));
    }

    public function get_alerte_date_prmtion(){
        // $datetime1 = Carbon::now();
        // $datetime2 = Carbon::yesterday();
        // echo $datetime1->diffInWeeks($datetime2);
        $today = Carbon::now();
        $produits = Produit::all();
        $produits_per = array();
        foreach ($produits as $produit) {
            $date_peremption = Carbon::createFromFormat('Y-m-d', $produit->date_peremption);
            //Les produits dont la date de peremption est dans deux semaines
            if ($date_peremption->diffInWeeks($today) <= 2){
                $produit->intervalle = $date_peremption->diffInWeeks($today);
                $produits_per[] = $produit;
            }
            //end of if
        }
        //end of foreach
        return view('alertes.alerte_peremption')->with(compact('produits_per'));
    }
    //end of function
}
