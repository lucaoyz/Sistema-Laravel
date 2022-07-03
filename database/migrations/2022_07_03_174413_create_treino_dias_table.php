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
        Schema::create('treino_dias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('td_id')->nullable()->constrained('treino_detalhes');
            $table->date('tdia_data');
            $table->integer('tdia_sequencia');
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
        Schema::dropIfExists('treino_dias');
    }
};
