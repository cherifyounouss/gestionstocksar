@extends('layouts.layout')
@section('links')
<link rel="stylesheet" type="text/css" href="{{asset('/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
@endsection
@section('crumb')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 d-flex no-block align-items-center">
            <h4 class="page-title">Consommations</h4>
            <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Accueil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Historique des consommations</li>
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
                <h5 class="card-title m-b-0">Historique des consommations</h5>
                <div class="form-group row">
                    <label class="col-sm-3 text-right control-label col-form-label">Date consommation</label>
                    <div class="input-group col-sm-5">
                        <input type="text" class="form-control" id="date_consommation" name="date_consommation" placeholder="jj/mm/aaaa">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div> 
            </div>
                <table class="table">
                      <thead>
                        <tr>
                          <th scope="col"><b>Produit</b></th>
                          <th scope="col"><b>Conditionnement</b></th>
                          <th scope="col"><b>Quantit&eacute;/Cond</b></th>
                          <th scope="col"><b>Total</b></th>
                          <th scope="col"><b>Utilisateur</b></th>
                        </tr>
                      </thead>
                      <tbody id="tab_cons_body">
                      </tbody>
                </table>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script src="{{asset('/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script>

    $("#date_consommation").change(function(){
        var date_consommation = $("#date_consommation").val();

        $.ajax({
            method: "GET",
            url: "{{url('/liste_consommation')}}",
            data: {date_consommation: date_consommation}
        }).done(function(response){
            if(response)
                $("#tab_cons_body").html(response);
            else
                $("#tab_cons_body").html('<tr><td>Aucun resultat</td></tr>');   
        })
    });
    /*datepicker*/
    jQuery('#date_consommation').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true
    });    
</script>
@endsection