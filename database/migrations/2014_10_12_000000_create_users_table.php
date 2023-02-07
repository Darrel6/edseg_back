<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string("annee");
            $table->string("npi");
            $table->string("identifiant");
            $table->string("matricule");
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
            $table->string("montant")->nullable();
            $table->string("fiche_preinscri");
            $table->string("recu_paiement")->nullable();
            $table->string("piece_identite");
            $table->string("phone");
            $table->string("paiement_status");
            $table->string("wphone");
            $table->string("role")->default('normal');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}