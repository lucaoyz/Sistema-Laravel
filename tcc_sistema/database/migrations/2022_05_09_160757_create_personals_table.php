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
        Schema::create('personals', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('type')->default(2);
            $table->string('per_nome');
            $table->string('per_email');
            $table->date('per_data_nascimento');
            $table->string('per_endereco');
            $table->string('per_celular')->nullable;
            $table->string('per_cpf');
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
        Schema::dropIfExists('personals');
    }
};
