<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAlumno extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumno', function (Blueprint $table) {
            $table->id(); //ID INT PRIMARY KEY AUTOINCREMENT
            $table->string('nombre', 32)->nullable(false);
            $table->string('telefono', 16)->nullable();
            $table->integer('edad')->nullable();
            $table->string('password', 64)->nullable(false);
            $table->string('email', 64)->unique();
            $table->string('sexo');
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
        Schema::dropIfExists('alumno');
    }
}
