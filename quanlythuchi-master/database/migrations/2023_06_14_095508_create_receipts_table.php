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
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('householdId')->nullable();
            $table->unsignedBigInteger('personId');
            $table->unsignedBigInteger('feeId');
            $table->unsignedBigInteger('userId');
            $table->integer('amount');
            $table->string('note')->nullable();
            $table->timestamps();
            $table->foreign('householdId')->references('id')->on('households');
            $table->foreign('personId')->references('id')->on('persons');
            $table->foreign('feeId')->references('id')->on('fees');
            $table->foreign('userId')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipts');
    }
};
