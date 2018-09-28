<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EtagereRequest;
use App\Etagere;

class EtagereController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $etageres = Etagere::all();
        return view('stock.etagere.list')->with(compact('etageres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stock.etagere.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EtagereRequest $request)
    {
        $validated = $request->validated();
        //On recupere les donnees et on les stocke au niveau de data
        $data = $request->all();
        $etagere = new Etagere;
        $etagere->libelle = $data['libelle'];
        $etagere->nbCasiers = $data['nbCasiers'];
        //On sauvegarde l'etagere grace a la methode save
        $etagere->save();

        $successMessage = 'Le nouveau étagère a été enregistré';
        return redirect('/stock/liste_etagere')->with('successMessage',$successMessage);
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
        $etagere = Etagere::findOrFail($id);
        $etagere = json_decode($etagere);
        return view('stock.etagere.edit')->with(compact('etagere'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EtagereRequest $request, $id)
    {
        $request->validated();
        $data = $request->all();
        $etagere = Etagere::findOrFail($id);
        $etagere->libelle = $data['libelle'];
        $etagere->nbCasiers = $data['nbCasiers'];
        $etagere->save();
        $successMessage = 'Les modifications ont été enregistrées';
        return redirect('/stock/liste_etagere')->with('successMessage',$successMessage);
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
        $etagere = Etagere::findOrFail($id);
        $etagere->delete();
        return "success";

    }
}
