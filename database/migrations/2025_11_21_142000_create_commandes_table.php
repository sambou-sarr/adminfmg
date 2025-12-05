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
            $table->string('token', 64)->nullable();
            $table->string('choix_livraison')->nullable();
            $table->string('choix_paiement')->nullable();
            $table->string('numero_commande')->nullable()->unique();
            $table->integer('montant_total')->default(0);
            $table->foreignId('id_client')->constrained('clients');
            $table->enum('statut', ['en_attente', 'confirmer', 'en cours', 'livrer', 'annuler'])->default('en_attente');
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
