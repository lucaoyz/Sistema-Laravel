<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use App\Models\Aluno;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alunos = Aluno::latest()->paginate(5);
        $alunos->alu_data_nascimento = \Carbon\Carbon::now('America/Sao_Paulo');

        $personals = Personal::latest()->paginate(5);
        $personals->per_data_nascimento = \Carbon\Carbon::now('America/Sao_Paulo');

        return view('admin.usuarios', [
            'alunos' => $alunos,
            'personals' => $personals,
            ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createAluno()
    {
        return view('admin.usuarios');
    }

    public function createPersonal()
    {
        return view('admin.usuarios');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAluno(Request $request)
    {
        $request->validate([
            'alu_nome' => 'required',
            'alu_email' => 'required',
            'alu_data_nascimento' => 'required|date',
            'alu_endereco' => 'required',
            'alu_celular' => 'required',
            'alu_cpf' => 'required',
        ]);

        Aluno::create($request->all());

        return redirect()->route('admin.usuarios')
                        ->with('success','Aluno criado com sucesso!');
    }

    public function storePersonal(Request $request)
    {
        $request->validate([
            'per_nome' => 'required',
            'per_email' => 'required',
            'per_data_nascimento' => 'required|date',
            'per_endereco' => 'required',
            'per_celular' => 'required',
            'per_cpf' => 'required',
        ]);

        Personal::create($request->all());

        return redirect()->route('admin.usuarios')
                        ->with('success','Personal criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Aluno  $aluno
     * @param  \App\Models\Personal  $personal
     * @return \Illuminate\Http\Response
     */
    public function showAluno(Aluno $aluno)
    {

        return view('admin.usuarios', [
            'aluno' => $aluno,
            ]);
    }

     public function showPersonal(Personal $personal)
    {
        return view('admin.usuarios', [
            'personal' => $personal,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \App\Models\Aluno  $aluno
     * @param  \App\Models\Personal  $personal
     * @return \Illuminate\Http\Response
     */

    public function editAluno(Aluno $aluno)
    {
        return view('admin.usuarios', [
            'aluno' => $aluno,
            ]);
    }

     public function editPersonal(Personal $personal)
    {
        return view('admin.usuarios', [
            'personal' => $personal,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Aluno  $aluno
     * @param  \App\Models\Personal  $personal
     * @return \Illuminate\Http\Response
     */

    public function updateAluno(Request $request, Aluno $aluno)
    {
        $request->validate([
            'alu_nome' => 'required',
            'alu_email' => 'required',
            'alu_data_nascimento' => 'required|date',
            'alu_endereco' => 'required',
            'alu_celular' => 'required',
            'alu_cpf' => 'required',
        ]);

        $aluno->update($request->all());

        return redirect()->route('admin.usuarios')
                        ->with('success','Aluno atualizado com sucesso!');
    }

    public function updatePersonal(Request $request, Personal $personal)
    {
        $request->validate([
            'per_nome' => 'required',
            'per_email' => 'required',
            'per_data_nascimento' => 'required|date',
            'per_endereco' => 'required',
            'per_celular' => 'required',
            'per_cpf' => 'required',
        ]);

        $personal->update($request->all());

        return redirect()->route('admin.usuarios')
                        ->with('success','Personal atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Aluno  $aluno
     * @param  \App\Models\Personal  $personal
     * @return \Illuminate\Http\Response
     */

    public function destroyAluno(Aluno $aluno)
    {
        $aluno->delete();

        return redirect()->route('admin.usuarios')
                        ->with('success','Aluno deletado com sucesso!');
    }

    public function destroyPersonal(Personal $personal)
    {
        $personal->delete();

        return redirect()->route('admin.usuarios')
                        ->with('success','Personal deletado com sucesso!');
    }

    public function search(Request $request)
    {

        $filters = $request->except('_token');
        $alunos = Aluno::where('alu_nome', 'LIKE', "%{$request->search}%")
            ->orWhere('alu_email', 'LIKE', "%{$request->search}%")
            ->orWhere('alu_cpf', 'LIKE', "%{$request->search}%")
            ->paginate(5);

        $personals = Personal::where('per_nome', 'LIKE', "%{$request->search}%")
            ->orWhere('per_email', 'LIKE', "%{$request->search}%")
            ->orWhere('per_cpf', 'LIKE', "%{$request->search}%")
            ->paginate(5);

            return view('admin.usuarios', [
                'alunos' => $alunos,
                'personals' => $personals,
                'filters' => $filters,
                ]);
    }

}
