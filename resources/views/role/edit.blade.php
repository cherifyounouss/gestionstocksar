@extends('layouts.layout')
@section('crumb')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">R&ocirc;le</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Accueil</a></li>
                        <li class="breadcrumb-item"><a href="{{url('/liste_role')}}">Liste des r&ocirc;les</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Modifier un r&ocirc;le</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="card">
        <form class="form-horizontal" method="POST" action="{{url('/modifier_role', $role->id)}}">
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
                <h4 class="card-title">Modifier un r&ocirc;le</h4>
                <div class="form-group row">
                    <label for="nom" class="col-sm-3 text-right control-label col-form-label">Nom</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nom_role" name="nom_role" value="{{ old('nom_role', $role->name)}}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 text-right control-label col-form-label">Permissions</label>
                    <div class="col-sm-9">
                        @foreach ($permissions as $permission)
                        <div class="custom-control custom-checkbox mr-sm-2">
                            <input type="checkbox" class="custom-control-input" id="{{ $permission->id}}" name="permissions[]" value="{{ $permission->id}}">
                            <label class="custom-control-label" for="{{ $permission->id}}">{{$permission->name}}</label>
                        </div>
                        @endforeach
                    </div>
                </div>                           
            </div>
            <div class="border-top">
                <div class="card-body">
                    <button type="submit" class="btn btn-primary">Enregistrer modifications</button>
                </div>
            </div>
    </form>
</div>
@endsection
