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
        Schema::create('rendez_vouses', function (Blueprint $table) {
            $table->id();

            // Qui a créé ou gère ce RDV
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Détails de l'événement
            $table->string('sujet');
            $table->text('description')->nullable();
            
            // Client (pour la simplicité, nous stockons le nom directement)
            $table->string('client_nom');
            $table->string('client_contact')->nullable(); // Téléphone ou Email
            $table->string('client_email')->nullable();
            $table->string('rapport')->nullable();
            // Horaires
            $table->dateTime('start_at');
            $table->dateTime('end_at');

            // Statut du RDV
            $table->enum('statut', ['en_attente', 'confirmer', 'en_cours','terminer',])->default('en_attente');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rendez_vouses');
    }
};
