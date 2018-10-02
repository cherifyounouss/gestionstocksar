<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApprovisionnementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approvisionnements', function (Blueprint $table) {
            $table->increments('id');
            //Nom du produit concerne
            $table->integer('produit');
            //Conditionnement
            $table->decimal('conditionnement',8,2);
            //Quantite par conditionnements
            $table->decimal('qte_cond',8,2);
            //Fournisseur ayant livre le produit
            $table->integer('fournisseur');
            //Date approvisionnement
            $table->date('date_appr');
            //Numero de bon de livraison
            $table->string('num_BL')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('approvisionnements');
    }
}
