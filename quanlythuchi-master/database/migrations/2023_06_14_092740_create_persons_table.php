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
        Schema::create('persons', function (Blueprint $table) {
            $table->id();
            $table->string('idCard')->nullable();
            $table->string('firstName');
            $table->string('lastName');
            $table->date('dateOfBirth');
            $table->string('avatar')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->string('email')->nullable();
            $table->string('numberPhone')->nullable();
            $table->string('ethnic');
            $table->string('nationality');
            $table->string('address');
            $table->string('occupation')->nullable();
            $table->string('educationLevel')->nullable();
            $table->enum('maritalStatus', ['single', 'married']);
            $table->enum('status', ['alive', 'dead'])->default('alive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persons');
    }
};
