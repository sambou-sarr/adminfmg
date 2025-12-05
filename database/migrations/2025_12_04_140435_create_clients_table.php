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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('prenom')->nullable();
            $table->string('nom')->nullable();
            $table->string('email')->nullable();
            $table->integer('telephone')->nullable();
            $table->string('adresse')->nullable();
            $table->string('type_client');
            $table->string('ninea')->nullable();
            $table->string('rccm')->nullable();
            $table->string('nom_entreprise')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
