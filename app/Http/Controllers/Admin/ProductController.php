<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\BaseController;
use App\Produit;
use App\Etagere;
use App\Http\Requests\ProductRequest;
use Carbon\Carbon;
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
        $data['date_peremption'] = DateTime::createFromFormat('d/m/Y', $data['date_peremption']);
        $data['date_exp_fds'] = DateTime::createFromFormat('d/m/y', $data['date_exp_fds']);
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
            $nom_fichier = $file->getClientOriginalName();
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

    public function view_file($fds){
        // $urlc = url_decode(public_path()."/laraview/#../fds/$fds");
        // echo '
        //     <iframe src ="'.$urlc.'" width="1000px" height="600px"></iframe>
        // ';
        return response()->file(public_path()."/fds/$fds");
    }
}
