<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcelas_Men extends Model
{
    use HasFactory;

    protected $table = "parcelas_men";

    protected $fillable = [
        'men_id',
        'alu_id',
        'par_data_pagto',
        'par_status',
    ];

    protected $dates = [
        'par_data_pagto',
    ];

    public function mensalidadesID()
    {
        return $this->belongsTo(Mensalidade::class, 'men_id', 'id');
    }

    public function AlunoID()
    {
        return $this->belongsTo(Aluno::class, 'alu_id', 'id');
    }

}
