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
            ]);
    }

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
        $alunoIdTreinoGeral = TreinoGeral::where('alu_id', '=', $request->input('alu_id'))->first();

        if($alunoIdTreinoGeral){
            return redirect()->route('treinos.indexGeral')
            ->with('error','Esse treino já está cadastrado para esse aluno!');
        } else {
        $request->validate([
            'per_id' => 'required',
            'alu_id' => 'required',
            'tg_data_inicio' => 'required|date',
            'tg_dias_semana' => 'required',
            'tg_data_final' => 'required|date',
            'tg_divisoes' => 'required',
        ]);

        $result = TreinoGeral::create($request->all());

        if($request->tg_divisoes === 'A'){
            $treino = new Treino;
            $treino->tg_id = $result->id;
            $treino->tre_divisoes = 'A';
            $treino->save();
        };

        if($request->tg_divisoes === 'AB'){
            $treino = new Treino;
            $treino->tg_id = $result->id;
            $treino->tre_divisoes = 'A';
            $treino->save();

            $treino = new Treino;
            $treino->tg_id = $result->id;
            $treino->tre_divisoes = 'B';
            $treino->save();
        };

        if($request->tg_divisoes === 'ABC'){
            $treino = new Treino;
            $treino->tg_id = $result->id;
            $treino->tre_divisoes = 'A';
            $treino->save();

            $treino = new Treino;
            $treino->tg_id = $result->id;
            $treino->tre_divisoes = 'B';
            $treino->save();

            $treino = new Treino;
            $treino->tg_id = $result->id;
            $treino->tre_divisoes = 'C';
            $treino->save();
        };

        if($request->tg_divisoes === 'ABCD'){
            $treino = new Treino;
            $treino->tg_id = $result->id;
            $treino->tre_divisoes = 'A';
            $treino->save();

            $treino = new Treino;
            $treino->tg_id = $result->id;
            $treino->tre_divisoes = 'B';
            $treino->save();

            $treino = new Treino;
            $treino->tg_id = $result->id;
            $treino->tre_divisoes = 'C';
            $treino->save();

            $treino = new Treino;
            $treino->tg_id = $result->id;
            $treino->tre_divisoes = 'D';
            $treino->save();
        };

        if($request->tg_divisoes === 'ABCDE'){
            $treino = new Treino;
            $treino->tg_id = $result->id;
            $treino->tre_divisoes = 'A';
            $treino->save();

            $treino = new Treino;
            $treino->tg_id = $result->id;
            $treino->tre_divisoes = 'B';
            $treino->save();

            $treino = new Treino;
            $treino->tg_id = $result->id;
            $treino->tre_divisoes = 'C';
            $treino->save();

            $treino = new Treino;
            $treino->tg_id = $result->id;
            $treino->tre_divisoes = 'D';
            $treino->save();

            $treino = new Treino;
            $treino->tg_id = $result->id;
            $treino->tre_divisoes = 'E';
            $treino->save();
        };

        if($request->tg_divisoes === 'ABCDEF'){
            $treino = new Treino;
            $treino->tg_id = $result->id;
            $treino->tre_divisoes = 'A';
            $treino->save();

            $treino = new Treino;
            $treino->tg_id = $result->id;
            $treino->tre_divisoes = 'B';
            $treino->save();

            $treino = new Treino;
            $treino->tg_id = $result->id;
            $treino->tre_divisoes = 'C';
            $treino->save();

            $treino = new Treino;
            $treino->tg_id = $result->id;
            $treino->tre_divisoes = 'D';
            $treino->save();

            $treino = new Treino;
            $treino->tg_id = $result->id;
            $treino->tre_divisoes = 'E';
            $treino->save();

            $treino = new Treino;
            $treino->tg_id = $result->id;
            $treino->tre_divisoes = 'F';
            $treino->save();
        };

        return redirect()->route('treinos.indexGeral')
                        ->with('success','Treino criado com sucesso!');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TreinoGeral  $treinoGeral
     * @return \Illuminate\Http\Response
     */
    public function showGeral(TreinoGeral $treinoGeral)
    {
        return view('admin.viewsTreino.treinoGeral', [
            'treinoGeral' => $treinoGeral
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TreinoGeral  $treinoGeral
     * @return \Illuminate\Http\Response
     */
    public function editGeral(TreinoGeral $treinoGeral)
    {
        return view('admin.viewsTreino.treinoGeral', [
            'treinoGeral' => $treinoGeral
        ]);
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
        $alunoIdTreinoGeral = TreinoGeral::where('alu_id', '=', $request->input('alu_id'))->first();
        $treinoGeralId = TreinoGeral::where('id', '=', $request->input('id'))->first();

        if($alunoIdTreinoGeral){
            if($alunoIdTreinoGeral->alu_id != $treinoGeralId->alu_id){
                return redirect()->route('treinos.indexGeral')
                    ->with('error','Esse treino já está cadastrado para esse aluno!');
                } else {
                $request->validate([
                    'per_id' => 'required',
                    'alu_id' => 'required',
                    'tg_data_inicio' => 'required|date',
                    'tg_dias_semana' => 'required',
                    'tg_data_final' => 'required|date',
                    'tg_divisoes' => 'required',
                ]);

                $treinoGeral->id = $request->id;
                $treinoGeral->per_id = $request->per_id;
                $treinoGeral->alu_id = $request->alu_id;
                $treinoGeral->tg_data_inicio = $request->tg_data_inicio;
                $treinoGeral->tg_dias_semana = $request->tg_dias_semana;
                $treinoGeral->tg_data_final = $request->tg_data_final;
                $treinoGeral->tg_divisoes = $request->tg_divisoes;


                $treinoGeral->save();

                    return redirect()->route('treinos.indexGeral')
                                ->with('success', 'Treino atualizado!');
            }
        } else {
            $request->validate([
                'per_id' => 'required',
                'alu_id' => 'required',
                'tg_data_inicio' => 'required|date',
                'tg_dias_semana' => 'required',
                'tg_data_final' => 'required|date',
                'tg_divisoes' => 'required',
            ]);

            $treinoGeral->update($request->all());

                return redirect()->route('treinos.indexGeral')
                                ->with('success', 'Treino atualizado!');
}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TreinoGeral  $treinoGeral
     * @return \Illuminate\Http\Response
     */
    public function destroyGeral(TreinoGeral $treinoGeral)
    {
        $treinoGeral->delete();

                return redirect()->route('treinos.indexGeral')
                                ->with('success', 'Treino excluido com sucesso!');

    }

    public function searchGeral(Request $request)
    {

        $filters = $request->except('_token');
        $treinoGerals = TreinoGeral::where('alu_id', 'LIKE', "%{$request->search}%")
            ->paginate(5);

            return view('admin.viewsTreino.treinoGeral', [
                'treinoGerals' => $treinoGerals,
                'filters' => $filters,
                ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexDetalhes(TreinoGeral $treinoGeral)
    {
        $treinoGeralDivisoes = $treinoGeral->tg_divisoes;
        $treinos = Treino::select('tre_divisoes')->where('tg_id', $treinoGeral->id)->get();
        $alunos = Aluno::all();
        $personals = Personal::all();

        return view('admin.viewsTreino.treinoDetalhes', [
            'treinoGeralDivisoes' => $treinoGeralDivisoes,
            'treinos' => $treinos,
            'alunos' => $alunos,
            'personals' => $personals,
            ]);
    }

}
