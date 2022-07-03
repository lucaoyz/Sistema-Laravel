<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'eq_nome',
    ];

    public function equipParaTreinoDetalhes() {
        return $this->hasOne(TreinoDetalhe::class, 'eq_id', 'id');
    }

}
