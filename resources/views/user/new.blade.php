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
                        <li class="breadcrumb-item active" aria-current="page">Ajouter un utilisateur</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="card">
        <form class="form-horizontal" method="POST" action="{{url('/ajouter_utilisateur')}}">
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
                <h4 class="card-title">Cr&eacute;er un utilisateur</h4>
                <div class="form-group row">
                    <label for="prenom" class="col-sm-3 text-right control-label col-form-label">Prenom</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="prenom" value="{{ old('prenom')}}" name="prenom" placeholder="Entrer le pr&eacute;nom de l'utilisateur">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nom" class="col-sm-3 text-right control-label col-form-label">Nom</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nom" value="{{ old('nom')}}" name="nom" placeholder="Entrer le nom de l'utilisateur">
                    </div>
                </div>                
                <div class="form-group row">
                        <label for="email" class="col-sm-3 text-right control-label col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" value="{{ old('email') }}" id="email" name="email" placeholder="Entrer l'email de l'utilisateur">
                        </div>
                </div>
                <div class="form-group row">
                        <label for="password" class="col-sm-3 text-right control-label col-form-label">Entrer le mot de passe de l'utilisateur</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="password" value="{{old('password')}}" name="password" placeholder="Entrer le mot de passe de l'utilisateur">
                        </div>
                </div>
                <div class="form-group row">
                    <label for="password_confirmation" class="col-sm-3 text-right control-label col-form-label">Confirmer le mot de passe</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="password_confirmation" value="{{old('password_confirmation')}}" name="password_confirmation" placeholder="confirmer le mot de passe">
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
