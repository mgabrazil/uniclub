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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->decimal('amount', 10, 2);
            $table->integer('points_earned')->default(0);
            $table->integer('points_redeemed')->default(0);
            $table->decimal('final_amount', 10, 2);
            $table->string('reference_number')->unique()->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['completed', 'canceled'])->default('completed');
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('vendor_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
