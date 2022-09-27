<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historico_treinos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alu_id')->nullable()->constrained('alunos');
            $table->foreignId('tg_id')->nullable()->constrained('treino_gerals');
            $table->string('ht_divisao');
            $table->date('ht_data_concluido');
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
        Schema::dropIfExists('historico_treinos');
    }
};
