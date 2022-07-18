<?php

namespace App\Http\Controllers;

use App\Models\Treino;
use App\Models\Exercicio;
use App\Models\Aluno;
use App\Models\Personal;
use App\Models\TreinoGeral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TreinoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.treino');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexGeral()
    {
        $treinoGerals = TreinoGeral::latest()->paginate(5);
        $alunos = Aluno::all();
        $personals = Personal::all();

        return view('admin.viewsTreino.treinoGeral', [
            'treinoGerals' => $treinoGerals,
            'alunos' => $alunos,
            'personals' => $personals,
            ]);    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createGeral()
    {
        return view('admin.viewsTreino.treinoGeral');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeGeral(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TreinoGeral  $treinoGeral
     * @return \Illuminate\Http\Response
     */
    public function showGeral(TreinoGeral $treinoGeral)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TreinoGeral  $treinoGeral
     * @return \Illuminate\Http\Response
     */
    public function editGeral(TreinoGeral $treinoGeral)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TreinoGeral  $treinoGeral
     * @return \Illuminate\Http\Response
     */
    public function updateGeral(Request $request, TreinoGeral $treinoGeral)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TreinoGeral  $treinoGeral
     * @return \Illuminate\Http\Response
     */
    public function destroyGeral(TreinoGeral $treinoGeral)
    {
        //
    }

    public function searchGeral(Request $request)
    {

        $filters = $request->except('_token');
        $treinoGerals = TreinoGeral::where('per_id', 'LIKE', "%{$request->search}%")
            ->orWhere('alu_id', 'LIKE', "%{$request->search}%")
            ->paginate(5);

            return view('admin.viewsTreino.treinoGeral', [
                'treinoGerals' => $treinoGerals,
                'filters' => $filters,
                ]);
    }

}
