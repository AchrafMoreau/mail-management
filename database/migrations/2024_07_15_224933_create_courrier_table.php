<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourrierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courriers', function (Blueprint $table) {
            $table->id(); // Clé primaire
            $table->enum('type',['entrant','sortant']);
            $table->date('date');
            $table->string('objet');
            $table->string('adresse_emetteur');
            $table->string('emetteur');
            $table->text('observation')->nullable();
            $table->enum("division", ['Rh', 'administration', 'gestion']);
            $table->binary('image_scan')->nullable();
            $table->timestamps(); // created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courrier');
    }
}
