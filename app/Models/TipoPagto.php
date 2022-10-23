<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPagto extends Model
{
    use HasFactory;

    protected $table = "tipopagto";

    protected $fillable = [
        'tpg_descricao',
    ];

    public function tipoPagtoContasAPagar()
    {
        return $this->hasOne(Contas_A_Pagar::class, 'tpg_id', 'id');
    }

    public function tipoPagtoContasAReceber()
    {
        return $this->hasOne(Contas_A_Receber::class, 'tpg_id', 'id');
    }

    public function tipoPagtoMensalidade()
    {
        return $this->hasOne(Mensalidade::class, 'tpg_id', 'id');
    }
}
