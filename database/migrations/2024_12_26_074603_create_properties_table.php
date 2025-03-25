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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->dateTime('date_time')->nullable();
            $table->string('type')->nullable();
            $table->longText('detail')->nullable();
            $table->string('unit_no')->nullable();
            $table->string('room_sq')->nullable();
            $table->string('property_sq')->nullable();
            $table->string('bedroom')->nullable();
            $table->string('bathroom')->nullable();
            $table->string('cat')->nullable();
            $table->string('dog')->nullable();
            $table->decimal('amount', 11, 2)->nullable();
            $table->decimal('security', 11, 2)->nullable();
            $table->longText('lease')->nullable();
            $table->string('available_day')->nullable();
            $table->string('place')->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
