<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TreinoController extends Controller
{
    public function treino() {
        return view ('admin.treino');
    }
}
