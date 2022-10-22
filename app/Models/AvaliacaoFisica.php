<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvaliacaoFisica extends Model
{
    use HasFactory;

    protected $fillable = [
        'alu_id',
        'af_kg',
        'af_altura',
        'af_massa_gorda',
        'af_massa_magra',
        'af_imc',
        'af_cm_bracoE',
        'af_cm_bracoD',
        'af_cm_antebracoE',
        'af_cm_antebracoD',
        'af_cm_coxaE',
        'af_cm_coxaD',
        'af_cm_panturrilhaE',
        'af_cm_panturrilhaD',
        'af_cm_torax',
        'af_cm_cintura',
        'af_cm_abdomen',
        'af_cm_quadril',
        'af_cm_pescoco',
        'af_cm_ombro',
        'af_dc_subescapular',
        'af_dc_triceps',
        'af_dc_biceps',
        'af_dc_torax',
        'af_dc_axilarMedia',
        'af_dc_suprailiaca',
        'af_dc_abdominal',
        'af_dc_coxaMedial',
        'af_dc_panturrilhaMedial',
        'af_objetivo',
    ];

    public function alunoId()
    {
        return $this->belongsTo(Aluno::class, 'alu_id', 'id');
    }
}
