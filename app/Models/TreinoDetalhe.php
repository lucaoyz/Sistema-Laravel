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
        'tre_id',
        'td_series',
        'td_repeticoes',
    ];

    public function treinoDetalheParaTreinoDias() {
        return $this->hasOne(TreinoDia::class, 'td_id', 'id');
    }

    public function exercicioId()
    {
        return $this->belongsTo(Exercicio::class, 'exe_id', 'id');
    }

    public function equipamentoId()
    {
        return $this->belongsTo(Equipamento::class, 'eq_id', 'id');
    }

    public function tre_id()
    {
        return $this->belongsTo(Treino::class, 'tre_id', 'id');
    }

}
