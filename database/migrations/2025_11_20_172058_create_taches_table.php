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
        Schema::create('taches', function (Blueprint $table) {
            $table->id();

            // À qui la tâche est assignée
            $table->foreignId('assignee_id')->constrained('users')->cascadeOnDelete();

            $table->string('titre');
            $table->text('description')->nullable();
            
            // Échéance
            $table->date('due_date')->nullable();

            // Priorité et statut de la tâche
            $table->enum('priorite', ['basse', 'moyenne', 'haute'])->default('moyenne');
            $table->enum('statut', ['à faire', 'en cours', 'terminée'])->default('à faire');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taches');
    }
};
