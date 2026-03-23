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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Relation avec la table users
            $table->string('status')->default('active'); // Exemple de colonne supplémentaire
            $table->integer('total_orders')->default(0); // Nombre total de commandes
            $table->decimal('total_spent', 10, 2)->default(0.00); // Total dépensé
            $table->date('join_date')->nullable(); // Date d'inscription
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
