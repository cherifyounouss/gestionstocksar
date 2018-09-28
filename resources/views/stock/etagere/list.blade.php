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
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>        
            {{session('successMessage')}}
        </div>        
    @endif
    <h5 class="card-title" id="liste_title">Liste des &eacute;tag&egrave;res</h5>
    <div class="table-responsive">
        <table id="table_etagere" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th><b>Libelle &eacute;tag&egrave;re</b></th>
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
                        <button type="button" onclick="supprimer_etagere({{ $etagere->id}})" id="btn_delete" class="btn btn-danger btn_delete btn-sm" data-toggle="modal">Supprimer</button>
                    </td>                  
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th><b>Libelle &eacute;tag&egrave;re</b></th>
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

    $(document).ready(function(){
        //On affiche une notification de suppression si la variable de notification de suppression existe
        if(sessionStorage.getItem('messageSuppression')){
            $('<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+sessionStorage.getItem('messageSuppression')+'</div>').insertBefore($('#liste_title'));
            sessionStorage.removeItem('messageSuppression');
        }
    })    

    /****************************************
        *       Basic Table                   *
        ****************************************/
    $('#table_etagere').DataTable();

    function supprimer_etagere(id) {
        if (confirm("Voulez-vous vraiment supprimer cet etagere...?")) {
            $.ajax({
                method: "POST",
                url: "{{url('/stock/supprimer_etagere')}}",
                data: {id: id, _token: "{{ csrf_token() }}"}, 
            }).done(function(response){
                if(response == "success"){
                    //On crée une variable afin de contenir la notification de suppression                    
                    sessionStorage.setItem('messageSuppression', 'L\'étagère a été supprimé');
                    location.reload(true);
                }
            });
        }
    }
    
</script>
@endsection