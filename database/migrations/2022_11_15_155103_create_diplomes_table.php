<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiplomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diplomes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('prenom');
            $table->date('date_naiss');
            $table->string('lieu_naiss');
            $table->string('matricule');
            $table->date('date_soutenance');
            $table->string('category');
            $table->string('promotion');
            $table->string('annee_ac');
            $table->string('annee_etude');
            $table->string('formation');
            $table->string('status');
            $table->string('num_demande');
            $table->string('pdf_diplome')->nullable();
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
        Schema::dropIfExists('diplomes');
    }
}