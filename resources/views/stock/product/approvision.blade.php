@extends('layouts.layout')
@section('links')
<link rel="stylesheet" type="text/css" href="{{asset('/assets/libs/select2/dist/css/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
@endsection
@section('crumb')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Approvisionnemnent</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Accueil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Enregistrer un approvisionnement</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="card">
        @if(Session::has('successMessage'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>        
            {{session('successMessage')}}
        </div>        
        @endif
        <form class="form-horizontal" method="POST" action="{{url('/stock/approvisionner')}}">
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
                <h4 class="card-title">Enregistrer un approvisionnement</h4>
                <div class="form-group row">
                    <label for="num_bl" class="col-sm-3 text-right control-label col-form-label">Num&eacute;ro BL </label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="num_bl" name="num_bl" placeholder="Entrer le num&eacute;ro du BL" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 text-right control-label col-form-label">Produit</label>
                    <div class="col-sm-9">
                        <select class="select2 form-control custom-select" name="produit" id="produit" style="width: 100%; height:36px;" required>
                            <option>Select</option>
                            @foreach($produits as $produit)
                            <option value="{{ $produit->id}}">{{ $produit->nom_produit}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 text-right control-label col-form-label">Fournisseur</label>
                    <div class="col-sm-9">
                        <select class="select2 form-control custom-select" name="fournisseur" id="fournisseur" style="width: 100%; height:36px;" required>
                            <option>Select</option>
                            @foreach($fournisseurs as $fournisseur)
                            <option value="{{ $fournisseur->id}}">{{ $fournisseur->nom_fournisseur}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>                            
                <div class="form-group row">
                    <label for="conditionnement" class="col-sm-3 text-right control-label col-form-label">Conditionnement</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" step="0.01" min="0" id="conditionnement" value="{{ old('conditionnement')}}" name="conditionnement" placeholder="Entrer le conditionnement" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="qte_par_cond" class="col-sm-3 text-right control-label col-form-label">Quantite par conditionnement</label>
                    <div class="col-sm-9">
                        <input type="number" step="0.01" min="0" class="form-control" id="qte_par_cond" value="{{ old('qte_par_cond')}}" name="qte_par_cond" placeholder="Entrer la quantit&eacute; par conditionnement" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="total" class="col-sm-3 text-right control-label col-form-label">Quantite total</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="total" value="{{ old('total')}}" name="total" readonly required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 text-right control-label col-form-label">Date approvisionnemnent</label>
                    <div class="input-group col-sm-9">
                        <input type="text" class="form-control" id="date_approvision" name="date_approvision" value="{{ old('date_approvision')}}" placeholder="jj/mm/aaaa">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
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
@section('scripts');
<script src="{{asset('/assets/libs/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('/assets/libs/select2/dist/js/select2.min.js')}}"></script>
<script src="{{asset('/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script>
    //***********************************//
    // For select 2
    //***********************************//
    $(".select2").select2();
    /*datepicker*/
    jQuery('#date_approvision').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true
    });

    $("#conditionnement").change(function(){
        var conditionnement = $("#conditionnement").val();
        var qte_par_cond = $("#qte_par_cond").val();
        if((conditionnement > 0) && (qte_par_cond>0)){
            ("#total").val(conditionnement*qte_par_cond)
        }
        else{
            $("#total").val(0);
        }
    });
    $("#conditionnement").keyup(function(){
        var conditionnement = $("#conditionnement").val();
        var qte_par_cond = $("#qte_par_cond").val();
        if((conditionnement > 0) && (qte_par_cond>0)){
            $("#total").val(conditionnement*qte_par_cond);
        }
        else{
            $("#total").val(0);
        }
    });
    $("#qte_par_cond").keyup(function(){
        var conditionnement = $("#conditionnement").val();
        var qte_par_cond = $("#qte_par_cond").val();
        if((conditionnement > 0) && (qte_par_cond>0)){
            $("#total").val(conditionnement*qte_par_cond);
        }
        else{
            $("#total").val(0);
        }
    });
</script>    
@endsection