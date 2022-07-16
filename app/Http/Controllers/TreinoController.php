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

        return view('admin.viewsTreino.treinoGeral', [
            'treinoGerals' => $treinoGerals,
            ]);    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
