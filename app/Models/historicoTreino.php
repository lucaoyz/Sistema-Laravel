<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class historicoTreino extends Model
{
    use HasFactory;


    protected $fillable = [
        'alu_id',
        'tg_id',
        'tg_id',
        'ht_divisao',
    ];

    public function aluId()
    {
        return $this->belongsTo(Aluno::class, 'alu_id', 'id');
    }

    public function treinoGeralId()
    {
        return $this->belongsTo(TreinoGeral::class, 'tg_id', 'id');
    }

    protected $dates = [
        'ht_data_concluido',
    ];

}
