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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Code unique
            $table->text('description')->nullable();
            $table->string('discount_type'); // Type de réduction (pourcentage ou montant fixe)
            $table->decimal('discount_value', 10, 2); // Valeur de la réduction
            $table->decimal('minimum_spend', 10, 2)->default(0); // Dépense minimale
            $table->decimal('maximum_discount', 10, 2)->nullable(); // Réduction maximale
            $table->timestamp('start_date')->nullable(); // Date de début
            $table->timestamp('end_date')->nullable(); // Date de fin
            $table->integer('usage_limit')->nullable(); // Limite d'utilisation
            $table->integer('usage_count')->default(0); // Nombre d'utilisations
            $table->boolean('is_active')->default(true); // Statut actif ou non
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
