<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProviderStoreRequest;
use App\Fournisseur;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        //On recupere tous les fournisseurs se trouvant dans la bd pour ensuite les fournir a la vue ci-dessous
        $fournisseurs = Fournisseur::all();
        return view('provider.list')->with(compact('fournisseurs'));
    }

    /**
     * Affiche le formulaire pour creer un nouveau fournisseur
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('provider.new');
    }

    /**
     * Sauvegarde le nouveau fournisseur en base de donnees.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProviderStoreRequest $request)
    {
        $validated = $request->validated();
        $data = $request->all();

        //On cree un nouveau fournisseur avec des champs de valeurs vides
        $fournisseur = new Fournisseur;
        //On remplace les valeurs des champs par les valeurs soumises dans le formulaire
        $fournisseur->nom_fournisseur = $data['nom_fournisseur'];
        $fournisseur->adresse_fournisseur = $data['adresse'];
        $fournisseur->num_tel = $data['num_tel'];
        //On sauvegarde le nouveau fournisseur
        $fournisseur->save();

        $successMessage = 'Le nouveau fournisseur a été enregistré';
        return redirect('/liste_fournisseur')->with('successMessage', $successMessage);
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
        $fournisseur = Fournisseur::find($id);
        $fournisseur = json_decode($fournisseur);
        return view('provider.edit')->with(compact('fournisseur'));
    }

    /**
     * Modifier un fournisseur spécifié par son id au niveau de la base
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProviderStoreRequest $request, $id)
    {
        $data = $request->all();
        // verification de la validite du formulaire
        $request->validated();

        $fournisseur = Fournisseur::findOrFail($id);
        $fournisseur->nom_fournisseur = $data['nom_fournisseur'];
        $fournisseur->adresse_fournisseur = $data['adresse'];
        $fournisseur->num_tel = $data['num_tel'];
        $fournisseur->save();
        $successMessage = "Les modifications ont été enregistrées";
        return redirect('/liste_fournisseur')->with('successMessage', $successMessage);
    

    }

    /**
     * Suppression d'un fournisseur de la base de données.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        echo $id;
        die;
        $fournisseur = Fournisseur::findOrFail($id);
        $fournisseur->delete();
        $successMessage = "Le fournisseur a été supprimé avec succès";
        return redirect('/liste_fournisseur')->with('successMessage',$successMessage);
    }

}
