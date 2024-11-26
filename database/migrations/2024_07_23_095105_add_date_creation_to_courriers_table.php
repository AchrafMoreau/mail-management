<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDateCreationToCourriersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courriers', function (Blueprint $table) {
            $table->date('date_creation')->nullable(); // Ajoute la colonne date_creation
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courriers', function (Blueprint $table) {
            $table->dropColumn('date_creation'); // Supprime la colonne date_creation
        });
    }
}
