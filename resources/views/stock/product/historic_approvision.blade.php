@extends('layouts.layout')
@section('links')
<link rel="stylesheet" type="text/css" href="{{asset('/assets/libs/select2/dist/css/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
@endsection
@section('crumb')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Historique approvisionnements</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Accueil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Historique approvisionnement</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title m-b-0">Approvisionnement</h5>
                <form class="form-row">
                    <div class="form-group">
                            <label class="col-md-6 text-right control-label col-form-label">Date de d&eacute;but</label>
                            <div class="input-group col-md-8">
                                <input type="text" class="form-control" id="date_debut" name="date_fin" placeholder="jj/mm/aaaa" required>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>               
                    <div class="form-group">
                        <label class="col-md-6 text-right control-label col-form-label">Date de fin</label>
                        <div class="input-group col-md-8">
                            <input type="text" class="form-control" id="date_fin" name="date_fin" placeholder="jj/mm/aaaa" required>
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 text-right control-label col-form-label">Produit</label>
                        <div class="col-md-12">
                            <select class="select2 form-control custom-select" name="produit" id="produit" style="height:36px;" required>
                                <option>Select</option>
                                @foreach($produits as $produit)
                                <option value="{{ $produit->id}}">{{ $produit->nom_produit}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row col-sm-7">
                        <button type="button" class="btn btn-primary" id="btn_search">Rechercher</button>
                    </div>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table">
                      <thead>
                        <tr>
                          <th scope="col"><b>Num&eacute;ro BL</b></th>
                          <th scope="col"><b>Produit</b></th>
                          <th scope="col"><b>Conditionnement</b></th>
                          <th scope="col"><b>Quantit&eacute;/Cond</b></th>
                          <th scope="col"><b>Total</b></th>
                          <th scope="col"><b>Fournisseur</b></th>
                          <th scope="col"><b>Date p&eacute;remption</b></th>
                        </tr>
                      </thead>
                      <tbody id="tab_appro_body">
                      </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script src="{{asset('/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('/assets/libs/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('/assets/libs/select2/dist/js/select2.min.js')}}"></script>
<script>
    //***********************************//
    // For select 2
    //***********************************//
    $(".select2").select2();

    /*$("#date_appro").change(function(){
        var date_appr = $("#date_appro").val();

        $.ajax({
            method: "GET",
            url: "{{url('/liste_approvisionnement')}}",
            data: {date_appr: date_appr}
        }).done(function(response){
            if(response)
                $("#tab_appro_body").html(response);
            else
                $("#tab_appro_body").html('<tr><td>Aucun resultat</td></tr>');   
        })
    });*/

    $("#btn_search").click(function(){
        var produit = $("#produit option:selected").val();
        var date_debut = $("#date_debut").val();
        var date_fin = $("#date_fin").val();
        

        $.ajax({
            method: "GET",
            url: "{{url('/liste_approvisionnement')}}",
            data: {date_debut: date_debut, date_fin: date_fin, produit: produit}
        }).done(function(response){
            if(response)
                $("#tab_appro_body").html(response);
            else
                $("#tab_appro_body").html('<tr><td>Aucun resultat</td></tr>');   
        })
    })

    /*datepicker*/
    jQuery('#date_debut').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true
    });
    jQuery('#date_fin').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true
    });       
</script>
@endsection