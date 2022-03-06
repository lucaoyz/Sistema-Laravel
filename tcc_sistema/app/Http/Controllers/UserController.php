<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile(){
        return view('admin.profile');
    }

    public function tables(){
        return view('admin.tables');
    }

    public function notificacoes(){
        return view('admin.notifications');
    }
}
