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
        Schema::create('treino_gerals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('per_id')->nullable()->constrained('personals');
            $table->foreignId('alu_id')->nullable()->constrained('alunos');
            $table->date('tg_data_inicio');
            $table->integer('tg_dias_semana');
            $table->date('tg_data_final');
            $table->string('tg_divisoes');
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
        Schema::dropIfExists('treino_gerals');
    }
};
