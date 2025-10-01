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
        Schema::create('points_configurations', function (Blueprint $table) {
            $table->id();
            $table->decimal('points_per_currency', 10, 2);
            $table->decimal('currency_per_point', 10, 2);
            $table->integer('points_expiration_days')->nullable();
            $table->json('bonus_rules')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('points_configurations');
    }
};
