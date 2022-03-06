<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function perfil(){
        return view('admin.perfil');
    }

    public function usuarios(){
        return view('admin.usuarios');
    }

    public function notificacoes(){
        return view('admin.notificacoes');
    }
}
