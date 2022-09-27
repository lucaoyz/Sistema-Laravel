<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TreinoDetalhe extends Model
{
    use HasFactory;

    protected $fillable = [
        'eq_id',
        'exe_id',
        'tg_id',
        'td_numero',
        'td_divisao',
        'td_series',
        'td_repeticoes',
    ];

    public function exercicioId()
    {
        return $this->belongsTo(Exercicio::class, 'exe_id', 'id');
    }

    public function equipamentoId()
    {
        return $this->belongsTo(Equipamento::class, 'eq_id', 'id');
    }

    public function treinoGeralId()
    {
        return $this->belongsTo(TreinoGeral::class, 'tg_id', 'id');
    }

}
