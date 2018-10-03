@extends('layouts.layout')
@section('links')
<link rel="stylesheet" type="text/css" href="{{asset('/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
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
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title m-b-0">Approvisionnement</h5>
                <div class="form-group row">
                    <label class="col-sm-3 text-right control-label col-form-label">Date approvisionnement</label>
                    <div class="input-group col-sm-5">
                        <input type="text" class="form-control" id="date_appro" name="date_appro" placeholder="jj/mm/aaaa">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div> 
            </div>
                <table class="table">
                      <thead>
                        <tr>
                          <th scope="col"><b>Num&eacute;ro BL</b></th>
                          <th scope="col"><b>Produit</b></th>
                          <th scope="col"><b>Conditionnement</b></th>
                          <th scope="col"><b>Quantit&eacute;/Cond</b></th>
                          <th scope="col"><b>Total</b></th>
                          <th scope="col"><b>Fournisseur</b></th>
                        </tr>
                      </thead>
                      <tbody id="tab_appro_body">
                      </tbody>
                </table>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script src="{{asset('/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script>

    $("#date_appro").change(function(){
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
    });
    /*datepicker*/
    jQuery('#date_appro').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true
    });    
</script>
@endsection