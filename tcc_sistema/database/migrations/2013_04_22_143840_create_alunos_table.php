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
        Schema::create('alunos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tre_id')->nullable()->constrained('treinos');
            $table->string('alu_nome');
            $table->string('alu_email');
            $table->date('alu_data_nascimento');
            $table->string('alu_endereco');
            $table->string('alu_mensalidade');
            $table->string('alu_celular')->nullable;
            $table->string('alu_cpf');
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
        Schema::dropIfExists('alunos');
    }
};
