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
        Schema::create('exercicios_treino', function (Blueprint $table) {
            $table->foreignId('tre_id')->nullable()->constrained('treinos');
            $table->string('tex_dia')->nullable();;
            $table->string('tex_membro1')->nullable();;
            $table->string('tex_membro2')->nullable();
            $table->string('tex_exenum')->nullable();;
            $table->foreignId('exe_id')->nullable()->constrained('exercicios');
            $table->string('tex_series')->nullable();
            $table->string('tex_reps')->nullable();;
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
        Schema::dropIfExists('exercicios_treino');
    }
};
