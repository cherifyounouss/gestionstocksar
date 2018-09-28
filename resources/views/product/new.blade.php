@extends('layouts.layout')
@section('links')
<link rel="stylesheet" type="text/css" href="{{asset('/assets/libs/select2/dist/css/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
@endsection
@section('crumb')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Produits</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Accueil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cr&eacute;er un produit</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="card">
        <form class="form-horizontal" method="POST" action="{{url('/ajouter_fournisseur')}}">
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
                <h4 class="card-title">Cr&eacute;er un produit</h4>
                <div class="form-group row">
                    <label for="nom_produit" class="col-sm-3 text-right control-label col-form-label">Nom produit</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nom_produit" value="{{ old('nom_produit')}}" name="nom_produit" placeholder="Entrer le nom du produit" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 text-right control-label col-form-label">Ce produit est un solvant?</label>
                    <div class="col-sm-9">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="est_solvant" name="solvant" value="1" required>
                            <label class="custom-control-label" for="est_solvant">Oui</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="non_solvant" name="solvant" required>
                            <label class="custom-control-label" for="non_solvant">Non</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 text-right control-label col-form-label">Criticit&eacute;</label>
                    <div class="col-sm-9">
                        <select class="select2 form-control custom-select" style="width: 100%; height:36px;">
                            <option>Select</option>
                            <option value="V">Vital</option>
                            <option value="I">Important</option>
                            <option value="S">Secondaire</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 text-right control-label col-form-label">Date de peremption</label>
                    <div class="input-group col-sm-9">
                        <input type="text" class="form-control" id="datepicker-autoclose" name="date_peremption" placeholder="jj/mm/aaaa">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="qte_stock" class="col-sm-3 text-right control-label col-form-label">Quantit&eacute; actuellement en stock</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" min="0" step="0.01" id="qte_stock" value="{{ old('qte_stock')}}" name="qte_stock" placeholder="0000.00" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="qte_min" class="col-sm-3 text-right control-label col-form-label">Quantit&eacute; minimale dalerte</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" min="0" step="0.01" id="qte_min" value="{{ old('qte_min')}}" name="qte_min" placeholder="0000.00" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 text-right control-label col-form-label">Unit&eacute;</label>
                    <div class="col-sm-9">
                        <select class="form-control custom-select" id="select_unite" style="width: 95%; height:36px;">
                            <option>Select</option>
                        </select>
                        <button type="button" class="btn btn-success btn-sm" style="border-radius: 5px;" data-toggle="modal" data-target="#modal_unite">
                            <span class=" mdi mdi-plus"></span></div>
                        </button>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 text-right control-label col-form-label">Fiche de donn&eacute;es s&eacute;curit&eacute;s</label>
                    <div class="col-sm-9">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="validatedCustomFile" required>
                            <label class="custom-file-label" for="validatedCustomFile">Choisir fichier...</label>
                            <div class="invalid-feedback">Example invalid custom file feedback</div>
                        </div>
                    </div>
                </div>
                <div class="border-top">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary">Cr&eacute;er</button>
                        </div>
                    </div>
            </div>
 
    </form>
</div>

<div class="modal fade" id="modal_unite" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter une unit&eacute;</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group row">
                        <label for="nom_unite" class="col-sm-3 text-right control-label col-form-label">Unit&eacute;</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nom_unite" value="{{ old('nom_unite')}}" name="nom_unite" placeholder="Entrer le nom de l'unit&eacute;" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" id="btn_ajouter_unite">Confirmer</button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script src="{{asset('/assets/libs/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('/assets/libs/select2/dist/js/select2.min.js')}}"></script>
<script src="{{asset('/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script>
    //***********************************//
    // For select 2
    //***********************************//
    $(".select2").select2();
    /*datepicker*/
    jQuery('#datepicker-autoclose').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true
    });
    $("#select_unite").select2();
    $("#btn_ajouter_unite").click(function(){
        var unite = $("#nom_unite").val();
        $.ajax({
            method: "POST",
            url: "{{url('/stock/ajouter_unite')}}",
            data: {unite: unite, _token: '{{csrf_token()}}' }
        }).done(function(response){
            $("#modal_unite").modal('hide');
            $("#select_unite").html("<option>Select</option>");
            getUnites();
        });
    })

    function getUnites(){
        $.ajax({
            method: "GET",
            url: "{{url('/stock/unites')}}"
        }).done(function(response){
            var unites = response;
            console.log(unites.length);
            for(var i = 0; i < unites.length; i++){
                $("#select_unite").append('<option value='+unites[i].unite+'>'+unites[i].unite+'</option>'); 
            }
        });
    }

    $(document).ready(function(){
        getUnites();
    })

</script>

@endsection