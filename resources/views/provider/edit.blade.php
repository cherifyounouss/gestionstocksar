@extends('layouts.layout')
@section('crumb')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Fournisseurs</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Accueil</a></li>
                        <li class="breadcrumb-item"><a href={{url('/liste_fournisseur')}}>Liste fournisseur</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Modifier un fournisseur</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="card">
        <form class="form-horizontal" method="POST" action="{{url('/modifier_fournisseur',$fournisseur->id)}}">
            {{csrf_field()}}
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif            
                <h4 class="card-title">Modifier un fournisseur</h4>
                <div class="form-group row">
                    <label for="nom_fournisseur" class="col-sm-3 text-right control-label col-form-label">Nom fournisseur</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nom_fournisseur" value="{{ $fournisseur->nom_fournisseur}}" name="nom_fournisseur" placeholder="Entrer le nom du fournisseur">
                    </div>
                </div>
                <div class="form-group row">
                        <label for="adresse" class="col-sm-3 text-right control-label col-form-label">Adresse</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $fournisseur->adresse_fournisseur }}" id="adresse" name="adresse" placeholder="Entrer l'adresse du fournissseur">
                        </div>
                </div>
                <div class="form-group row">
                        <label for="num_tel" class="col-sm-3 text-right control-label col-form-label">Num&eacute;ro de t&eacute;l&eacute;phone</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="num_tel" value="{{ $fournisseur->num_tel}}" name="num_tel" placeholder="Entrer le num&eacute;ro de t&eacute;l&eacute;phone du fournisseur">
                        </div>
                </div>
                </div>         
            </div>
            <div class="border-top">
                <div class="card-body">
                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                </div>
            </div>
    </form>
</div>

@endsection