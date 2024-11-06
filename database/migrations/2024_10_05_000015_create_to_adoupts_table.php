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
            $table->string('reason_for_adoption');
            $table->enum('status', ['Accept ', 'Pending', 'Reject'])->default('Pending');
            $table->string('current_pets');
            $table->string('availability');
            $table->string('pet_experience');
            $table->string('contact_info');
            $table->string('address');

            $table->unsignedBigInteger('pet_id')->unique();
            $table->foreign('pet_id')->references('id')->on('pets');
            
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->softDeletes();
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
