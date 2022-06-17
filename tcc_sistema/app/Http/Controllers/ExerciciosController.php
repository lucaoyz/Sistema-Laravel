<?php

namespace App\Http\Controllers;

use App\Models\Exercicio;
use Illuminate\Http\Request;

class ExerciciosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exercicios = Exercicio::latest()->paginate(5);

        return view('admin.treino', [
            'exercicios' => $exercicios,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.treino');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $exercicioNome = Exercicio::where('exe_nome', '=', $request->input('exe_nome'))->first();

        if($exercicioNome){
            return redirect()->route('treinos.index')
            ->with('error','Esse exercício já está cadastrado!');
        } else {
        $request->validate([
            'exe_nome' => 'required',
            'exe_membro' => 'required',
            'exe_descricao' => 'nullable',
        ]);

        Exercicio::create($request->all());

        return redirect()->route('treinos.index')
                        ->with('success','Exercício criado com sucesso!');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exercicio  $exercicio
     * @return \Illuminate\Http\Response
     */
    public function show(Exercicio $exercicio)
    {
        return view('admin.treino', [
            'exercicio' => $exercicio,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exercicio  $exercicio
     * @return \Illuminate\Http\Response
     */
    public function edit(Exercicio $exercicio)
    {
        return view('admin.treino', [
            'exercicio' => $exercicio,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exercicio  $exercicio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exercicio $exercicio)
    {
        $nomeExe = Exercicio::where('exe_nome', '=', $request->input('exe_nome'))->first();
        $exeId = Exercicio::where('id', '=', $request->input('id'))->first();

        if($nomeExe){
            if($nomeExe->per_email != $exeId->per_email){
                return redirect()->route('treinos.index')
                                    ->with('error', 'Esse exercício já está cadastrado!');
            } else {
                $request->validate([
                    'exe_nome' => 'required',
                    'exe_membro' => 'required',
                    'exe_descricao' => 'nullable',
                ]);

                $exercicio->id = $request->id;
                $exercicio->exe_nome = $request->exe_nome;
                $exercicio->exe_membro = $request->exe_membro;
                $exercicio->exe_descricao = $request->exe_descricao;

                $exercicio->save();

                    return redirect()->route('treinos.index')
                                ->with('success', 'Exercício atualizado!');
            }
        } else {
            $request->validate([
                'exe_nome' => 'required',
                'exe_membro' => 'required',
                'exe_descricao' => 'nullable',
            ]);

            $exercicio->update($request->all());

                return redirect()->route('treinos.index')
                            ->with('success', 'Exercício atualizado!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exercicio  $exercicio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exercicio $exercicio)
    {
        $exercicio->delete();

        return redirect()->route('treinos.index')
                        ->with('success','Exercício excluido com sucesso!');
    }

    public function search(Request $request)
    {

        $filters = $request->except('_token');
        $exercicios = Exercicio::where('exe_nome', 'LIKE', "%{$request->search}%")
            ->orWhere('exe_membro', 'LIKE', "%{$request->search}%")
            ->paginate(5);

            return view('admin.treino', [
                'exercicios' => $exercicios,
                ]);
    }

}
