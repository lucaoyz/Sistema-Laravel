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
        Schema::create('avaliacao_fisicas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alu_id')->nullable()->constrained('alunos');
            $table->string('af_kg')->nullable();
            $table->string('af_altura')->nullable();
            $table->string('af_massa_gorda')->nullable();
            $table->string('af_massa_magra')->nullable();
            $table->string('af_imc')->nullable();
            $table->string('af_cm_bracoE')->nullable();
            $table->string('af_cm_bracoD')->nullable();
            $table->string('af_cm_antebracoE')->nullable();
            $table->string('af_cm_antebracoD')->nullable();
            $table->string('af_cm_coxaE')->nullable();
            $table->string('af_cm_coxaD')->nullable();
            $table->string('af_cm_panturrilhaE')->nullable();
            $table->string('af_cm_panturrilhaD')->nullable();
            $table->string('af_cm_torax')->nullable();
            $table->string('af_cm_cintura')->nullable();
            $table->string('af_cm_abdomen')->nullable();
            $table->string('af_cm_quadril')->nullable();
            $table->string('af_cm_pescoco')->nullable();
            $table->string('af_cm_ombro')->nullable();
            $table->string('af_dc_subescapular')->nullable();
            $table->string('af_dc_triceps')->nullable();
            $table->string('af_dc_biceps')->nullable();
            $table->string('af_dc_torax')->nullable();
            $table->string('af_dc_axilarMedia')->nullable();
            $table->string('af_dc_suprailiaca')->nullable();
            $table->string('af_dc_abdominal')->nullable();
            $table->string('af_dc_coxaMedial')->nullable();
            $table->string('af_dc_panturrilhaMedial')->nullable();
            $table->string('af_objetivo')->nullable();
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
        Schema::dropIfExists('avaliacao_fisicas');
    }
};
