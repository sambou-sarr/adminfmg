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
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->string('prenom');
            $table->string('nom');
            $table->integer('telephone');
            $table->string('adresse');
            $table->integer('quantite');
            $table->string('email')->nullable();
            $table->string('numero_commande')->nullable()->unique();
            $table->decimal('montant_total', 10, 2)->default(0);
            $table->enum('statut', ['en attente', 'confirmée', 'en cours', 'livrée', 'annulée'])->default('en attente');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
