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
        // Table principale des parties
        Schema::create('parties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recours_id')->nullable();
            $table->unsignedBigInteger('requerant_id')->nullable();
            $table->unsignedBigInteger('defendeur_id')->nullable();
            $table->unsignedBigInteger('greffier_id')->nullable();
            $table->unsignedBigInteger('conseiller_id')->nullable();
            $table->unsignedBigInteger('auditeur_id')->nullable();
            $table->unsignedBigInteger('avocat_defendeur_id')->nullable();
            $table->unsignedBigInteger('avocat_requerant_id')->nullable();


            $table->timestamps();

            // Clés étrangères
            $table->foreign('recours_id')->references('id')->on('recours')->onDelete('cascade');
            $table->foreign('requerant_id')->references('id')->on('requerants')->onDelete('cascade');
            $table->foreign('defendeur_id')->references('id')->on('defendeurs')->onDelete('cascade');
            $table->foreign('avocat_defendeur_id')->references('id')->on('avocat_defendeurs')->onDelete('cascade');
            $table->foreign('avocat_requerant_id')->references('id')->on('avocat_requerants')->onDelete('cascade');

            $table->foreign('greffier_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('conseiller_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('auditeur_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Suppression dans l'ordre inverse de création
        Schema::dropIfExists('avocat_defendeur_partie');
        Schema::dropIfExists('avocat_requerant_partie');
        Schema::dropIfExists('parties');
    }
};
