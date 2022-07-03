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

}
