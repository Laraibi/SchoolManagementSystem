<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seances', function (Blueprint $table) {
            $table->id();
            $table->integer("Matiere_id");
            $table->integer("Classe_id");
            $table->integer("Teacher_id");
            $table->integer("Salle_id");
            $table->integer("Type_id");
            $table->string("Type");
            $table->date('DateSeance');
            $table->string("Creneau");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seances');
    }
}
