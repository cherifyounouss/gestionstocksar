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
                        <li class="breadcrumb-item active" aria-current="page">Alertes date de p&eacute;remption</li>
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
        @foreach ($produits_per as $produit)
        <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading"> {{$produit->nom_produit}}</h4>
                <p>La date de p&eacute;remption de ce produit est dans {{$produit->intervalle}} semaines</p>
                <hr>
                <p class="mb-0">Veuillez proc&eacute;der aux modifications n&eacute;cessaires</p>
        </div>
        @endforeach
    </div>
</div>

@endsection