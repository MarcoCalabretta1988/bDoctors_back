<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('doctor_vote', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->onDelete('cascade')->constrained();
            $table->foreignId('vote_id')->onDelete('cascade')->constrained();
            $table->string('name', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_vote');
    }
};