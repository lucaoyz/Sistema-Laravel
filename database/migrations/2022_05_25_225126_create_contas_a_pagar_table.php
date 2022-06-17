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
        Schema::create('contas_a_pagar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tpg_id')->constrained('tipopagto');
            $table->foreignId('for_id')->constrained('fornecedores');
            $table->char('con_tipo');
            $table->string('con_valor');
            $table->string('con_valor_final');
            $table->string('con_parcelas');
            $table->date('con_data_venc');
            $table->date('con_data_pag')->nullable();
            $table->string('con_status');
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
        Schema::dropIfExists('contas_a_pagar');
    }
};
