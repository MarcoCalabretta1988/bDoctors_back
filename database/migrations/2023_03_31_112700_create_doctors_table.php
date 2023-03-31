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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->string('photo')->nullable();
            $table->string('curriculum')->nullable();
            $table->string('phone', 20);
            // $table->foreignId('message_id')->nullable()->onDelete('set null')->constrained();
            // $table->foreignId('rewiew_id')->nullable()->onDelete('set null')->constrained();
            // $table->foreignId('user_id')->nullable()->onDelete('set null')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
        // Schema::table('doctors', function (Blueprint $table) {
        //     $table->dropForeign('projects_message_id_foreign');
        //     $table->dropForeign('projects_rewiew_id_foreign');
        //     $table->dropForeign('projects_user_id_foreign');
        // });
    }
};