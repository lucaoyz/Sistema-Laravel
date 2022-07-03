<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treino extends Model
{
    use HasFactory;

    protected $fillable = [
        'tg_id',
        'tre_divisoes',
    ];

    public function treinoParaTreinoDetalhes() {
        return $this->hasOne(TreinoDetalhe::class, 'tre_id', 'id');
    }
}
