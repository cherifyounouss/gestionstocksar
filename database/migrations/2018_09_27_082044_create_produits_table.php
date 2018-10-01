<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            //id du produit
            $table->increments('id');
            //nom du produit
            $table->string('nom_produit',100)->unique();
            //solvant ou pas ?
            $table->boolean('est_solvant');
            //criticite du produit : Vitale - Important - Secondaire
            $table->enum('criticite', ['V', 'I', 'S']);
            //date_peremption du produit
            $table->date('date_peremption');
            //quantite disponible en stock actuellement
            $table->decimal('qte_stock',8,2);
            //quantite minimale pour lancer une alerte
            $table->decimal('qte_min', 8, 2);	
            //unite de stockage
            $table->string('unite');
            //etagere ou se trouve le produit
            $table->string('etagere',10);
            //numero de casier
            $table->integer('casier');
            //fiche de donnees securites
            $table->string('fds',100);
            //Date d'expiration de la fiche de donnees securites
            $table->date('date_exp_fds');
            //timestamps = date de creation et date de derniere modification
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
        Schema::dropIfExists('produits');
    }
}
