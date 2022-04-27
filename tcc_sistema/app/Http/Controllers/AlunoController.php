<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alunos = Aluno::latest()->paginate(5);

        return view('admin.alunos.index',compact('alunos'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.alunos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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

        return redirect()->route('alunos.index')
                        ->with('success','Aluno criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function show(Aluno $aluno)
    {
        return view('admin.alunos.show',compact('aluno'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function edit(Aluno $aluno)
    {
        return view('admin.alunos.edit',compact('aluno'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aluno $aluno)
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

        return redirect()->route('alunos.index')
                        ->with('success','Aluno atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aluno $aluno)
    {
        $aluno->delete();

        return redirect()->route('alunos.index')
                        ->with('success','Aluno deletado com sucesso!');
    }
}
