<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TreinoDia extends Model
{
    use HasFactory;

    protected $fillable = [
        'td_id',
        'tdia_data',
        'tdia_sequencia',
    ];

}
