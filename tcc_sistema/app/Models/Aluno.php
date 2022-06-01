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
        'alu_mensalidade',
        'alu_celular',
        'alu_cpf',
    ];

    protected $dates = [
        'alu_data_nascimento',
    ];

    public function usuarioAluno() {
        return $this->hasOne(User::class, 'alu_id', 'id');
    }

}
