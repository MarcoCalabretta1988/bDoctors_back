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
        Schema::create('sponsoreds', function (Blueprint $table) {
            $table->id();
            $table->decimal('cost', 6, 2); //decimal per i pagamenti, come ha detto il tizio in chiamata zoom 
            $table->string('duration'); //intesa come data di scadenza in minuti
            $table->string('name', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sponsoreds');
    }
};
