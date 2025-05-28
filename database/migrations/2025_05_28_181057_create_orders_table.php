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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('car_id');
            $table->unsignedInteger('quantity')->default(1); // Добавлено количество
            $table->enum('status', ['pending', 'confirmed', 'completed', 'canceled'])->default('pending');
            $table->enum('delivery_method', ['cash', 'card']);
            $table->string('name');
            $table->string('last_name');
            $table->string('father_name')->nullable();
            $table->string('email');
            $table->string('address');
            $table->string('phone_number')->nullable(); // Изменено на string
            $table->integer('total_price');
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
