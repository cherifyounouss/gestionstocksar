@extends('layouts.layout')
@section('links')
<link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
@endsection
@section('crumb')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">R&ocirc;le</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Accueil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Liste des r&ocirc;les</li>
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
    <h5 class="card-title" id="liste_title">Liste des r&ocirc;les</h5>
    <div class="table-responsive">
        <table id="table_etagere" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th><b>Id</b></th>
                    <th><b>Role</b></th>
                    <th><b>Actions</b></th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                <tr>
                    <td>{{$role->id}}</td>
                    <td>{{$role->name}}</td>
                    <td>
                        {{--  On transmet l'id de l'etagere a modifier au controlleur via l'url  --}}
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#Modal{{ $role->id}}">Voir</button>
                        <form action="{{url('/modifier_role', $role->id)}}" style="display: inline;">
                            <button type="submit" class="btn btn-cyan btn-sm">Modifier</button>
                        </form>
                        <button type="button" onclick="supprimer_role({{ $role->id}})" id="btn_delete" class="btn btn-danger btn_delete btn-sm" data-toggle="modal">Supprimer</button>
                    </td>                  
                </tr>
                <div class="modal fade" id="Modal{{ $role->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                    <div class="modal-dialog" role="document ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Informations r&ocirc;le</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true ">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>
                                    <h6>Nom r&ocirc;le</h6>
                                    {{ $role->name}}
                                </p>
                                <p>
                                    <h6>Permissions</h6>
                                    @foreach ($role->permissions->pluck('name') as $permission)
                                        <p>
                                        -> {{ $permission}}
                                        </p>
                                    @endforeach
                                </p>
                        </div>
                    </div>
                </div>    
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th><b>Id</b></th>
                    <th><b>Role</b></th>
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

    function supprimer_role(id) {
        if (confirm("Voulez-vous vraiment supprimer ce role...?")) {
            $.ajax({
                method: "POST",
                url: "{{url('/supprimer_role')}}",
                data: {id: id, _token: "{{ csrf_token() }}"}, 
            }).done(function(response){
                if(response == "success"){
                    //On crée une variable afin de contenir la notification de suppression                    
                    sessionStorage.setItem('messageSuppression', 'Le role a été supprimé');
                    location.reload(true);
                }
            });
        }
    }
    
</script>
@endsection