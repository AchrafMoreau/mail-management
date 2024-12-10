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
        Schema::create('decharges', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->date('reception_jour');
            $table->unsignedBigInteger('etat_id')->nullable();
            $table->foreign('etat_id')->references('id')->on('regions')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('ville_id');
            $table->foreign('ville_id')->references('id')->on('villes')->onDelete('cascade')->onUpdate('cascade');
            $table->string('document')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('decharges');
    }
};
