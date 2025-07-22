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
        Schema::create('recours', function (Blueprint $table) {
            $table->id();

            // Clés étrangères
            $table->unsignedBigInteger('structure_id')->nullable();
            $table->unsignedBigInteger('section_id')->nullable();
            $table->unsignedBigInteger('objet_id')->nullable();



            // Autres champs
            $table->string('numero_dossier')->unique();
            $table->string('etat_dossier')->nullable();
            $table->boolean('dossier_clos')->default(false);
            $table->date('date_enregistrement')->nullable();
            $table->date('date_clos')->nullable();
            $table->string('observation')->nullable()->default('null');

            $table->timestamps();

            // Contraintes de clés étrangères
            $table->foreign('structure_id')->references('id')->on('structures')->onDelete('cascade');
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->foreign('objet_id')->references('id')->on('objets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recours');
    }
};
