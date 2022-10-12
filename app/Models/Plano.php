<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plano extends Model
{
    use HasFactory;

    protected $fillable = [
        'pl_plano1',
        'pl_plano2',
        'pl_plano3',
        'pl_plano4',
    ];

}
