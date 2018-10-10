@extends('layouts.layout')
@section('links')
<link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
@endsection
@section('crumb')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Utilisateurs</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Accueil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Liste des utilisateurs</li>
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
    <h5 class="card-title" id="liste_title">Liste des utilisateurs</h5>
    <div class="table-responsive">
        <table id="provider_table" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th><b>Pr&eacute;nom</b></th>
                    <th><b>Nom</b></th>
                    <th><b>Email</b></th>
                    <th><b>Actions</b></th>
                </tr>
            </thead>
            <tbody>
                @foreach($utilisateurs as $utilisateur)
                <tr>
                    <td>{{$utilisateur->prenom}}</td>
                    <td>{{$utilisateur->nom}}</td>
                    <td>{{$utilisateur->email}}</td>
                    <td>
                        {{--  On transmet l'id du fournisseur a modifier au controlleur via l'url  --}}
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#Modal{{ $utilisateur->id}}">Voir</button>
                        <form action="{{url('/modifier_utilisateur',$utilisateur->id)}}" style="display: inline">
                            <button type="submit" class="btn btn-cyan btn-sm">Modifier</button>
                        </form>
                        <button type="button" onclick="supprimer_utilisateur({{ $utilisateur->id}})" class="btn btn-danger btn_delete btn-sm" data-toggle="modal">Supprimer</button>
                    </td>
                    <div class="modal fade" id="Modal{{ $utilisateur->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                        <div class="modal-dialog" role="document ">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Informations utilisateur</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true ">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>
                                        <h6>Pr&eacute;nom</h6>
                                        {{ $utilisateur->prenom}}
                                    </p>
                                    <p>
                                        <h6>Nom</h6>
                                        {{ $utilisateur->nom}}
                                    </p>
                                    <p>
                                        <h6>Email</h6>
                                        {{ $utilisateur->email}}                                        
                                    </p>
                                    <p>
                                        <h6>Cr&eacute;&eacute; le</h6>
                                        {{ $utilisateur->created_at}}
                                    </p>                                                                                                            
                                </div>
                            </div>
                        </div>
                    </div>                                   
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th><b>Pr&eacute;nom</b></th>
                    <th><b>Nom</b></th>
                    <th><b>Email</b></th>
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
    $('#provider_table').DataTable();
    const APP_NAME = "localhost/stockLaboSAR/public";

   
    function supprimer_utilisateur(id){
        if(confirm("Voulez-vous vraiment supprimer cet utilisateur...?")){
            //Requete post envoyé au controlleur pour pouvoir supprimer un fournisseur
            $.ajax({
                method: "POST",
                url: "{{url('/supprimer_utilisateur')}}",
                data: {id: id, _token: "{{ csrf_token() }}"},
            }).done(function(response) {
                if(response == "success"){
                    //On crée une variable afin de contenir la notification de suppression
                    sessionStorage.setItem('messageSuppression','L\'utilisateur a été supprimé');
                    location.reload(true);
                }
            })
        }
    }
</script>
@endsection