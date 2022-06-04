<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('aluno.dashboard');
    }

      /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        return view('admin.dashboard');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function professorHome()
    {
        return view('professor.dashboard');
    }

    /* Mudar senha admin // gerencial */

    public function changePasswordAdmin()
    {
        return view('admin.change-password');
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

}
