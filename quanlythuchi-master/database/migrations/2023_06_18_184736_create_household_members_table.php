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
        Schema::create('household_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('personId');
            $table->unsignedBigInteger('householdId');
            $table->string('relationship');
            $table->boolean('isOwner');
            $table->timestamps();

            $table->foreign('personId')->references('id')->on('persons')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('householdId')->references('id')->on('households')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('household_members');
    }
};
