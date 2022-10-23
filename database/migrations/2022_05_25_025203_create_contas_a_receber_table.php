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
        Schema::create('contas_a_receber', function (Blueprint $table) {
            $table->id();
            $table->foreignId('men_id')->nullable()->constrained('mensalidade');
            $table->foreignId('tpg_id')->constrained('tipopagto');
            $table->date('rec_data')->nullable();
            $table->string('rec_descricao');
            $table->string('rec_valor');
            $table->string('rec_status');
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
        Schema::dropIfExists('contas_a_receber');
    }
};
