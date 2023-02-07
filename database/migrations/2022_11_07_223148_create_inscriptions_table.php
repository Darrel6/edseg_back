<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->id();
            $table->string("annee");
            $table->string("npi");
            $table->string("identifiant");
            $table->string("matricule");
            $table->string('nom');
            $table->string("prenom");
            $table->date("date_naiss");
            $table->string("lieu_naiss");
            $table->string("nationality");
            $table->string("entite");
            $table->string("specialite");
            $table->string("status");
            $table->string("mention");
            $table->string("reference")->nullable();
            $table->string("num_transaction")->nullable();
            $table->date("date_paiement")->nullable();
            $table->integer("montant")->nullable();
            $table->string("fiche_preinscri");
            $table->string("recu_paiement")->nullable();
            $table->string("email")->unique();
            $table->string("phone");
            $table->string("wphone");
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
        Schema::dropIfExists('inscriptions');
    }
}