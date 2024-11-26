<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDechargesTable extends Migration
{
    public function up()
    {
        Schema::create('decharges', function (Blueprint $table) {
            $table->id();
            $table->string('nom_complet');
            $table->date('date');
            $table->string('etat')->nullable();
            $table->string('ville')->nullable();
            $table->string('image_scan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('decharges');
    }
}
