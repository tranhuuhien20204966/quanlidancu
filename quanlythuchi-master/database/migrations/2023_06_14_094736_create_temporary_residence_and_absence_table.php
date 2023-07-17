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
        Schema::create('temporary_residence_and_absence', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('personId');
            $table->unsignedBigInteger('householdId')->nullable();
            $table->unsignedBigInteger('userId');
            $table->date('startDate')->default(now());
            $table->date('endDate');
            $table->string('reason');
            $table->enum('type',['residence', 'absence']);
            $table->string('beforeAddress')->nullable();
            $table->timestamps();

            $table->foreign('userId')->references('id')->on('users');
            $table->foreign('personId')->references('id')->on('persons');
            $table->foreign('householdId')->references('id')->on('households');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temporary_residence__and_absence');
    }
};
