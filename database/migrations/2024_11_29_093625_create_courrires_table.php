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
        Schema::create('courrires', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['SORTANT', 'ENTRANT']);
            $table->date('reception_jour');
            $table->time('reception_heure')->nullable();
            $table->string('object');
            $table->unsignedBigInteger('expediteur_id')->nullable();
            $table->foreign('expediteur_id')->references('id')->on('expediteurs')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('destination_id')->nullable();
            $table->foreign('destination_id')->references('id')->on('destinations')->onDelete('cascade')->onUpdate('cascade');
            $table->text('observation')->nullable();
            $table->string('document')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courrires');
    }
};
