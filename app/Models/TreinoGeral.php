<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TreinoGeral extends Model
{
    use HasFactory;

    protected $fillable = [
        'per_id',
        'alu_id',
        'tg_data_inicio',
        'tg_dias_semana',
        'tg_data_final',
        'tg_divisoes',
    ];

    protected $dates = [
        'tg_data_inicio',
        'tg_data_final',
    ];

    public function treinoGeralParaTreino() {
        return $this->hasOne(Treino::class, 'tg_id', 'id');
    }

    public function alunoId()
    {
        return $this->belongsTo(Aluno::class, 'alu_id', 'id');
    }

    public function personalId()
    {
        return $this->belongsTo(Personal::class, 'per_id', 'id');
    }
}
