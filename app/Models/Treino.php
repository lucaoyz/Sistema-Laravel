<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treino extends Model
{
    use HasFactory;

    protected $fillable = [
        'per_id',
        'tre_dias_semana',
        'tre_tempo',
        'tre_data_troca',
    ];

    protected $dates = [
        'tre_dias_semana',
    ];

    public function TreinoAluno() {
        return $this->hasOne(Treino::class, 'tre_id', 'id');
    }

    public function TreinoExercicios() {
        return $this->hasMany(Treino::class, 'tre_id', 'id');
    }

}
