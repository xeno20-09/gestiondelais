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
    Schema::create('defendeurs', function (Blueprint $table) {
      $table->id();
      $table->string('nom_complet')->nullable();
      $table->string('domicile')->nullable();
      $table->enum('type_personne', ['Physique', 'Morale']);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('defendeurs');
  }
};
