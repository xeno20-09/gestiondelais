<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mouvements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recours_id')->nullable();
            $table->unsignedBigInteger('instruction_id')->nullable();
            $table->dateTime('date_debut_instruction')->nullable();
            $table->dateTime('date_debut_notification')->nullable();
            $table->dateTime('date_fin_instruction')->nullable();
            $table->string('observation')->nullable();

            $table->enum('etat_instruction', ['Executée', 'Contacté', 'Inachevée', 'Initiée', 'Non Contacté'])->nullable();
            $table->enum('communique_au', ['Deux parties', 'Réquerant', 'Défendeur'])->nullable();

            $table->timestamps();

            // Clés étrangères
            $table->foreign('recours_id')->references('id')->on('recours')->onDelete('cascade');
            $table->foreign('instruction_id')->references('id')->on('instructions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mouvements');
    }
};
