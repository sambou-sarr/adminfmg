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

            $table->enum('statut', ['en_attente', 'en cours', 'terminée'])->default('en_attente');

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
