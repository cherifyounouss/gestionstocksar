@extends('layouts.layout')
@section('links')
<link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
@endsection
@section('crumb')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Fournisseurs</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Accueil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Liste des fournisseurs</li>
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
    <h5 class="card-title">Liste des fournisseurs</h5>
    <div class="table-responsive">
        <table id="provider_table" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th><b>Id</b></th>
                    <th><b>Nom fournisseur</b></th>
                    <th><b>Adresse</b></th>
                    <th><b>Num&eacute;ro de t&eacute;l&eacute;phone</b></th>
                    <th><b>Actions</b></th>
                </tr>
            </thead>
            <tbody>
                @foreach($fournisseurs as $fournisseur)
                <tr>
                    <td>{{$fournisseur->id}}</td>
                    <td>{{$fournisseur->nom_fournisseur}}</td>
                    <td>{{$fournisseur->adresse_fournisseur}}</td>
                    <td>{{$fournisseur->num_tel}}</td>
                    <td>
                        {{--  On transmet l'id du fournisseur a modifier au controlleur via l'url  --}}
                        <form action="{{url('/modifier_fournisseur',$fournisseur->id)}}">
                            <button type="submit" class="btn btn-cyan btn-sm">Modifier</button>
                        </form>
                        <input type="hidden">
                        <button type="button" onclick="test({{ $fournisseur->id}})" class="btn btn-danger btn_delete btn-sm" data-toggle="modal">Supprimer</button>
                    </td>                  
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th><b>Id</b></th>
                    <th><b>Nom fournisseur</b></th>
                    <th><b>Adresse</b></th>
                    <th><b>Num&eacute;ro de t&eacute;l&eacute;phone</b></th>
                    <th><b>Actions</b></th>
                </tr>
            </tfoot>
        </table>
        <div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Suppression du fournisseur</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Voulez-vous vraiment supprimer ce fournisseur...?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Confirmer</button>
                    </div>
                </div>
            </div>
        </div>        
</div>
@endsection
@section('scripts')
<script src="{{asset('assets/extra-libs/DataTables/datatables.min.js')}}"></script>
<script>
    /****************************************
        *       Basic Table                   *
        ****************************************/
    $('#provider_table').DataTable();
    const APP_NAME = "localhost/stockLaboSAR/public";

   
    function test(id){
        if(confirm("Voulez-vous vraiment supprimer ce fournisseur ?")){
            /*$.post(APP_NAME+"/supprimer_fournisseur",id: id, _token: {{ csrf_token() }}, function(){
                alert('YESSSSSSS');
            });*/
            $.ajax({
                method: "POST",
                url: "{{url('/supprimer_fournisseur')}}",
                data: {id: id, _token: "{{ csrf_token() }}"},
            }).done(function(response) {
                if(response == "success"){
                    location.reload(true);
                }
            })
        }
    }
</script>
@endsection