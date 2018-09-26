@extends('layouts.layout')
@section('crumb')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Etag&egrave;re</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Accueil</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/stock/liste_etagere')}}">Liste des &eacute;tag&egrave;re</a></li>                        
                        <li class="breadcrumb-item active" aria-current="page">Modifier une &eacute;tag&egrave;re</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="card">
        <form class="form-horizontal" method="POST" action="{{url('/stock/modifier_etagere',$etagere->id)}}">
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
                <h4 class="card-title">Cr&eacute;er une &eacute;tag&egrave;re</h4>
                <div class="form-group row">
                    <label for="libelle" class="col-sm-3 text-right control-label col-form-label">Libelle</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="libelle" value="{{ $etagere->libelle}}" name="libelle" placeholder="Entrer le libelle de l'&eacute;tag&egrave;re" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nbCasiers" class="col-sm-3 text-right control-label col-form-label">Nombres de casiers (compartiments)</label>
                    <div class="col-sm-9">
                        <input type="number" min="1" class="form-control" id="nbCasiers" value="{{ $etagere->nbCasiers}}" name="nbCasiers" placeholder="Entrer le nombre de casiers" required>
                    </div>
                </div>                                                
            </div>
            <div class="border-top">
                <div class="card-body">
                    <button type="submit" class="btn btn-primary">Cr&eacute;er</button>
                </div>
            </div>
    </form>
</div>
@endsection
