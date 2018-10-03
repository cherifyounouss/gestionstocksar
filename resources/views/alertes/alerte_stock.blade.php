@extends('layouts.layout')
@section('crumb')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Notifications alertes</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Accueil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Notifications alertes</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="card">
    <div class="card-body border-top">
        <h5 class="card-title">Alertes !!!</h5>
        @foreach ($produits_en_rupt as $produit)
        <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading"> {{$produit->nom_produit}}</h4>
                <p>La quantit&eacute; minimale dalerte a été atteinte pour ce produit</p>
                <hr>
                <p class="mb-0">Veuillez proc&eacute;der &agrave; un réapprovisionnement du stock</p>
        </div>
        @endforeach
    </div>
</div>

@endsection