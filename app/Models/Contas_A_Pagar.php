<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contas_A_Pagar extends Model
{
    use HasFactory;

    protected $table = "contas_a_pagar";

    protected $fillable = [
        'tpg_id',
        'for_id',
        'con_tipo',
        'con_valor',
        'con_valor_final',
        'con_parcelas',
        'con_data_venc',
        'con_data_pag',
        'con_status',
    ];

    protected $dates = [
        'con_data_venc',
        'con_data_pag',
    ];

    public function tipoPagtoID()
    {
        return $this->belongsTo(TipoPagto::class, 'tpg_id', 'id');
    }

    public function FornecedoresID()
    {
        return $this->belongsTo(Fornecedores::class, 'for_id', 'id');
    }

}
