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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('age');
            $table->enum('gender', ['male', 'female']);
            $table->string('type');
            $table->string('information'); 
            $table->string('pet_vaccinations_image')->nullable();
            $table->string('Special_needs')->nullable(); 
            $table->enum('is_adopted', ['Available', 'Pending', 'Adopted' ])->default('Available');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
