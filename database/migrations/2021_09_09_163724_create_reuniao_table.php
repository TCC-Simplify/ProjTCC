<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReuniaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reuniao', function (Blueprint $table) {
            $table->id();
            $table->string('reuniao');
            $table->string('descricao');
            $table->integer('destinatario');
            $table->integer('responsavel');
            $table->integer('tipo_destinatario'); // 1 - ind e 2 - equipe
            $table->string('data');
            $table->string('horario');
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
        Schema::dropIfExists('reuniao');
    }
}
