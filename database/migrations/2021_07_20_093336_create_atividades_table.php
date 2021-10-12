<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atividades', function (Blueprint $table) {
            $table->id();
            $table->string('atividade');
            $table->string('descricao');
            $table->string('prazo');
            $table->string('finalizacao');
            $table->integer('dificuldade');
	        $table->integer('tipo_destinatario'); // 1 - ind e 2 - equipe
            $table->integer('destinatario');
            $table->integer('empresa');
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
        Schema::dropIfExists('atividades');
    }
}
