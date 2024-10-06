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
        Schema::create('to_adoupts', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('pet_id')->nullable();
            $table->foreign('pet_id')->references('id')->on('pets');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('to_adoupts');
    }
};
