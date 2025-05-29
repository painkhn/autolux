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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->integer('price');
            $table->integer('mileage')->default(0);
            $table->integer('year');
            $table->string('vin_code')->unique();
            $table->string('image');

            $table->enum('engine_type', ['diesel', 'petrol', 'electric', 'hybrid']); // дизель, бензин, электро, гибрид
            $table->decimal('engine_volume', 3, 1); // объём двигателя
            $table->integer('engine_power'); // мощность в лошадках
            $table->enum('transmission', ['automatic', 'manual', 'robot']); // Автомат, механика, робот
            $table->enum('drive_type', ['front', 'rear', 'four']); // Передний, задний, полный
            $table->string('color'); // Цвет кузова
            $table->string('body_type'); // Седан, SUV, купе и т.д.
            
            $table->enum('status', ['available', 'reserved', 'sold'])->default('available'); // доступен, забронирован, продан

            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
