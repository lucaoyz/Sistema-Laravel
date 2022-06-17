<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Aluno;
use Illuminate\Support\Facades\Hash;


class PerfilController extends Controller
{
    /* Mudar senha admin / Aluno / Professor */

    public function changePasswordAdmin()
    {
        return view('admin.change-password');
    }

    public function changePasswordAluno()
    {
        return view('aluno.change-password');
    }

    public function changePasswordProfessor()
    {
        return view('professor.change-password');
    }

    public function updatePasswordAdmin(Request $request)
    {
        # Validation

        $mensagens = [
            'required' => 'Obrigatório!',
            'new_password.min' => 'É necessário no mínimo 8 caracteres na senha!',
            'confirmed' => 'A confirmação de senha não bate!'
        ];

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed|min:8',
        ], $mensagens);


        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "As senhas não batem!");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

            return redirect()->route('admin.perfil')->with('success','Senha alterada com sucesso!');
    }

    public function updatePasswordAluno(Request $request)
    {
        # Validation

        $mensagens = [
            'required' => 'Obrigatório!',
            'new_password.min' => 'É necessário no mínimo 8 caracteres na senha!',
            'confirmed' => 'A confirmação de senha não bate!'
        ];

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed|min:8',
        ], $mensagens);


        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "As senhas não batem!");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

            return redirect()->route('aluno.perfil')->with('success','Senha alterada com sucesso!');
    }

    public function updatePasswordProfessor(Request $request)
    {
        # Validation

        $mensagens = [
            'required' => 'Obrigatório!',
            'new_password.min' => 'É necessário no mínimo 8 caracteres na senha!',
            'confirmed' => 'A confirmação de senha não bate!'
        ];

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed|min:8',
        ], $mensagens);


        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "As senhas não batem!");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

            return redirect()->route('professor.perfil')->with('success','Senha alterada com sucesso!');
    }
}
