<?php

namespace App\Http\Controllers;

use App\Models\Treino;
use App\Models\Exercicio;
use App\Models\Aluno;
use App\Models\ExerciciosTreino;
use App\Models\Personal;
use Illuminate\Http\Request;

class TreinoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exercicios = Exercicio::latest()->paginate(1000);
        $exerciciosCount = Exercicio::select('id')->count();

        $treinos = Treino::latest()->paginate(5);
        $treinosCount = Treino::select('id')->count();

        $personals = Personal::all();

        return view('admin.treino', [
            'exercicios' => $exercicios,
            'exerciciosCount' => $exerciciosCount,
            'treinos' => $treinos,
            'treinosCount' => $treinosCount,
            'personals' => $personals,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $exercicios = Exercicio::all();

        $treinos = Treino::all();

        $personals = Personal::all();

        return view('admin.criarTreino', [
            'exercicios' => $exercicios,
            'treinos' => $treinos,
            'personals' => $personals,
            ]);
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
            'per_id' => 'required',
            'tre_dias_semana' => 'required',
            'tre_tempo' => 'required',
            'tre_data_troca' => 'required|date',
        ]);

       Treino::create($request->all());

       return redirect()->route('treinos.create')
                        ->with('success','Informações gerais cadastradas com sucesso!')->with('proximaAbaDMA', 'true');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Treino  $treino
     * @return \Illuminate\Http\Response
     */
    public function show(Treino $treino)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Treino  $treino
     * @return \Illuminate\Http\Response
     */
    public function edit(Treino $treino)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Treino  $treino
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Treino $treino)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Treino  $treino
     * @return \Illuminate\Http\Response
     */
    public function destroy(Treino $treino)
    {
        //
    }
}
