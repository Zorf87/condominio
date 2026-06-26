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
        Schema::create('letture', function (Blueprint $table) {
            $table->id();
            $table->foreignId("anagrafica_id")->constrained('anagrafiche');
            $table->bigInteger("valore")->default(0);
            $table->foreignId("unita_misura_id")->constrained('unita_misura');
            $table->date("data_lettura")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letture');
    }
};
