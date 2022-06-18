<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercicio extends Model
{
    use HasFactory;

    protected $fillable = [
        'exe_nome',
        'exe_membro',
        'exe_descricao',
    ];

    public function ExerciciosTreino() {
        return $this->hasOne(ExerciciosTreino::class, 'exe_id', 'id');
    }

}
