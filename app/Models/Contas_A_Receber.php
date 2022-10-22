<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contas_A_Receber extends Model
{
    use HasFactory;

    protected $fillable = [
        'men_id',
        'tpg_id',
        'rec_data',
        'rec_valor',
        'rec_valor_final',
        'rec_parcelas',
        'rec_status',
    ];

    protected $dates = [
        'rec_data',
    ];

    public function mensalidadesID()
    {
        return $this->belongsTo(Mensalidade::class, 'men_id', 'id');
    }

    public function tipoPagtoID()
    {
        return $this->belongsTo(TipoPagto::class, 'tpg_id', 'id');
    }

}
