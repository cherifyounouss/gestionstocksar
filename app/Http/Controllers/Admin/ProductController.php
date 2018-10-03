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
        $data['date_peremption'] = date("Y-m-d", strtotime($data['date_peremption']));
        $data['date_exp_fds'] = date("Y-m-d", strtotime($data['date_exp_fds']));
        
        //Test de sauvegarde des informations au niveau de la base de donnees
        $produit = new Produit;
        $produit->nom_produit = $data['nom_produit'];
        $produit->est_solvant = $data['solvant'];
        $produit->criticite = $data['criticite'];
        $produit->date_peremption = $data['date_peremption'];
        $produit->qte_stock = $data['qte_stock'];
        $produit->qte_min = $data['qte_min'];
        $produit->unite = $data['unite'];
        $produit->etagere = $data['etagere'];
        $produit->casier = $data['num_casier'];
        $produit->date_exp_fds = Carbon::parse(date($data['date_exp_fds']))->format('Y-m-d');
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
        $successMessage = 'Le nouveau produit a ete enregistre';
        
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
        $produit->date_peremption = date("d-m-Y", strtotime($produit->date_peremption));
        $produit->date_exp_fds = date('d-m-Y', strtotime($produit->date_exp_fds));
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
        $data['date_peremption'] = date("Y-m-d", strtotime($data['date_peremption']));
        $data['date_exp_fds'] = date("Y-m-d", strtotime($data['date_exp_fds']));
        $produit = Produit::findOrFail($id);

        $produit->nom_produit = $data['nom_produit'];
        $produit->est_solvant = $data['solvant'];
        $produit->criticite = $data['criticite'];
        $produit->date_peremption = $data['date_peremption'];
        $produit->qte_stock = $data['qte_stock'];
        $produit->qte_min = $data['qte_min'];
        $produit->unite = $data['unite'];
        $produit->etagere = $data['etagere'];
        $produit->casier = $data['num_casier'];
        $produit->date_exp_fds = $data['date_exp_fds'];
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
        $successMessage = 'Les modifications ont été enregistré';
        
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
        $produits = json_decode($produits);
        return view('stock.product.list_etagere')->with(compact('produits'));
    }
}
