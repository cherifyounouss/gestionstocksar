<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsommationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consommations', function (Blueprint $table) {
            $table->increments('id');
            //le produit a consommer
            $table->integer('produit');
            //l'utilisateur enregistrant la consommation
            $table->integer('utilisateur');
            $table->date('date_consommation');
            //Conditionnement
            $table->decimal('conditionnement',8,2);
            //Quantite par conditionnements
            $table->decimal('qte_cond',8,2);
            //Total
            $table->decimal('total',10,2);
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
        Schema::dropIfExists('consommations');
    }
}
