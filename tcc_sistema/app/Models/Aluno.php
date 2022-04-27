<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    protected $fillable = [
        'alu_nome',
        'alu_email',
        'alu_endereco',
        'alu_data_nascimento',
        'alu_telefone',
        'alu_celular',
        'alu_cpf',
    ];
}
