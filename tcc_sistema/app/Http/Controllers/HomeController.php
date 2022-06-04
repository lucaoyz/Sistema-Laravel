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

    /* Mudar senha */

    public function changePassword()
    {
        return view('change-password');
    }

    public function updatePassword(Request $request)
{
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "As senhas não batem!");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        if (auth()->user()->type == 'admin') {
            return redirect()->route('admin.perfil')->with('success','Senha alterada com sucesso!');
        }else if (auth()->user()->type == 'professor') {
            return redirect()->route('professor.perfil')->with('success','Senha alterada com sucesso!');
        }else{
            return redirect()->route('aluno.perfil')->with('success','Senha alterada com sucesso!');
        }
}
}
