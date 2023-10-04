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
        Schema::create('winning_numbers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('raffle_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->string('number');
            $table->string('hour');
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('winning_numbers');
    }
};
