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
        Schema::create('sections', function (Blueprint $table) {
            $table->id();

            $table->string('nom_section');
            $table->string('code_section')->unique();

            $table->unsignedBigInteger('structure_id');

            $table->timestamps();

            // Clé étrangère vers la table structures
            $table->foreign('structure_id')
                ->references('id')
                ->on('structures')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
