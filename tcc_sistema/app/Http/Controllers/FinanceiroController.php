<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FinanceiroController extends Controller
{
    public function financeiro(){
        return view('admin.billing');
    }
}
