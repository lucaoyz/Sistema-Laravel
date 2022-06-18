<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExerciciosTreino extends Model
{
    use HasFactory;

    protected $fillable = [
        'tre_id',
        'tex_membro',
        'tex_exenum',
        'exe_id',
        'tex_exenome',
        'tex_series',
        'tex_reps',
    ];

}
