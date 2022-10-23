<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensalidade extends Model
{
    use HasFactory;

    protected $table = "mensalidade";

    protected $fillable = [
        'alu_id',
        'tpg_id',
        'men_data_inicio',
        'men_data_final',
        'men_data_pagto',
        'men_valor',
        'men_qtde_parcelas',
    ];

    protected $dates = [
        'men_data_inicio',
        'men_data_final',
        'men_data_pagto',
    ];

    public function mensalidadesID()
    {
        return $this->hasOne(Contas_A_Receber::class, 'men_id', 'id');
    }

    public function tipoPagtoID()
    {
        return $this->belongsTo(TipoPagto::class, 'tpg_id', 'id');
    }

}
