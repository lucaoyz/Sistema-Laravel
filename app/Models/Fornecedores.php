<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedores extends Model
{
    use HasFactory;

    protected $table = "fornecedores";

    protected $fillable = [
        'for_nome',
        'for_cidade',
        'for_estado',
        'for_bairro',
        'for_rua',
        'for_numero',
        'for_tipoproduto',
        'for_telefone',
        'for_celular',
        'for_cpf_cnpj',
        'for_cep',
    ];

    public function FornecedoresParaContasAPagar() {
        return $this->hasOne(Contas_A_Pagar::class, 'for_id', 'id');
    }

}
