@extends('layouts.layout')
@section('links')
<link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
@endsection
@section('crumb')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Etag&egrave;re</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Accueil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Liste des &eacute;tag&egrave;res</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="card">
  <div class="card-body">
    @if(Session::has('successMessage'))
        <div class="alert alert-success" role="alert">
            {{session('successMessage')}}
        </div>        
    @endif
    <h5 class="card-title">Liste des &eacute;tag&egrave;res</h5>
    <div class="table-responsive">
        <table id="table_etagere" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th><b>Libelle &eacute;tag&egravere;</b></th>
                    <th><b>Nombres de casiers</b></th>
                    <th><b>Actions</b></th>
                </tr>
            </thead>
            <tbody>
                @foreach($etageres as $etagere)
                <tr>
                    <td>{{$etagere->libelle}}</td>
                    <td>{{$etagere->nbCasiers}}</td>
                    <td>
                        {{--  On transmet l'id de l'etagere a modifier au controlleur via l'url  --}}
                        <form action="{{url('/stock/modifier_etagere',$etagere->id)}}" style="display: inline;">
                            <button type="submit" class="btn btn-cyan btn-sm">Modifier</button>
                        </form>
                        <input type="hidden">
                        <button type="button" class="btn btn-danger btn_delete btn-sm" data-toggle="modal">Supprimer</button>
                    </td>                  
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th><b>Libelle &eacute;tag&egravere;</b></th>
                    <th><b>Nombres de casiers</b></th>
                    <th><b>Actions</b></th>
                </tr>
            </tfoot>
        </table>     
</div>
@endsection
@section('scripts')
<script src="{{asset('assets/extra-libs/DataTables/datatables.min.js')}}"></script>
<script>
    /****************************************
        *       Basic Table                   *
        ****************************************/
    $('#table_etagere').DataTable();
</script>
@endsection