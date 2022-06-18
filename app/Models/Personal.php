<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;

    protected $fillable = [
        'per_nome',
        'per_email',
        'per_endereco',
        'per_data_nascimento',
        'per_telefone',
        'per_celular',
        'per_cpf',
    ];

    protected $dates = [
        'per_data_nascimento',
    ];

    public function usuarioPersonal() {
        return $this->hasOne(User::class, 'per_id', 'id');
    }

    public function PersonalTreino() {
        return $this->hasMany(Personal::class, 'per_id', 'id');
    }

}
