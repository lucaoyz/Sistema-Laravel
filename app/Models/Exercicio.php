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
        'exe_foto',
    ];

    public function exeParaTreinoDetalhes() {
        return $this->hasOne(TreinoDetalhe::class, 'exe_id', 'id');
    }

}
