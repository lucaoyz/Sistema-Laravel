<?php

namespace App\Http\Controllers;


use App\Models\Exercicio;
use App\Models\Aluno;
use App\Models\Equipamento;
use App\Models\Personal;
use App\Models\TreinoDetalhe;
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
        //$treinoGerals = TreinoGeral::latest()->paginate(5);
        $treinoGerals =TreinoGeral::join('alunos', 'alunos.id', '=', 'treino_gerals.alu_id')
        ->join('personals', 'personals.id', '=', 'treino_gerals.per_id')
        ->select(['personals.*', 'alunos.*', 'treino_gerals.*'])->paginate(5);

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
        $alunos = Aluno::all();
        $personals = Personal::all();
        $nome = $request->nome;
        $data = $request->data;
        if($data == null){
            $treinoGerals = TreinoGeral::join('alunos', 'alunos.id', '=', 'treino_gerals.alu_id')
            ->join('personals', 'personals.id', '=', 'treino_gerals.per_id')
            ->select(['personals.*', 'alunos.*', 'treino_gerals.*'])
            ->where('alu_nome', 'LIKE', "%{$nome}%")
            ->orWhere('per_nome', 'LIKE', "%{$nome}%")
            ->paginate(5);
        } else if($nome == null){
            $treinoGerals = TreinoGeral::join('alunos', 'alunos.id', '=', 'treino_gerals.alu_id')
            ->join('personals', 'personals.id', '=', 'treino_gerals.per_id')
            ->select(['personals.*', 'alunos.*', 'treino_gerals.*'])
            ->orWhere('tg_data_final', 'LIKE', "%{$data}%")
            ->paginate(5);
        } else {
            $treinoGerals = TreinoGeral::join('alunos', 'alunos.id', '=', 'treino_gerals.alu_id')
            ->join('personals', 'personals.id', '=', 'treino_gerals.per_id')
            ->select(['personals.*', 'alunos.*', 'treino_gerals.*'])
            ->where('alu_nome', 'LIKE', "%{$nome}%")
            ->where('tg_data_final', 'LIKE', "%{$data}%")
            ->orWhere('per_nome', 'LIKE', "%{$nome}%")
            ->paginate(5);
            //dd($treinoGerals);
        }


        //dd($treinoGerals);

            return view('admin.viewsTreino.treinoGeral', [
                'treinoGerals' => $treinoGerals,
                'filters' => $filters,
                'alunos' => $alunos,
                'personals' => $personals,
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
        $alunos = Aluno::all();
        $personals = Personal::all();

        return view('admin.viewsTreino.treinoDetalhes', [
            'treinoGeralDivisoes' => $treinoGeralDivisoes,
            'treinoGeral' => $treinoGeral,
            'alunos' => $alunos,
            'personals' => $personals,
            ]);
    }


    // DIVISÃO A
        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createDetalhesDivisaoA(TreinoGeral $treinoGeral, TreinoDetalhe $treinoDetalhe)
    {

        $treinoDetalhes =TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('tg_id', $treinoGeral->id)
        ->where('td_divisao', 'A')
        ->select(['exercicios.*', 'equipamentos.*', 'treino_detalhes.*'])->paginate(5);
        //dd($treinoDetalhes);
        $exercicios = Exercicio::all();
        $equipamentos = Equipamento::all();

        return view('admin.viewsTreino.divisoes.treinoA', [
            'treinoGeral' => $treinoGeral,
            'equipamentos' => $equipamentos,
            'exercicios' => $exercicios,
            'treinoDetalhes' => $treinoDetalhes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeDetalhesDivisaoA(Request $request, treinoGeral $treinoGeral)
    {

        $request->validate([
            'eq_id' => 'required',
            'exe_id' => 'required',
            'td_divisao' => 'required',
            'td_series' => 'required',
            'td_repeticoes' => 'required',
        ]);

        $result = TreinoDetalhe::create($request->all());

        $treinoDetalheTB = TreinoDetalhe::where('id', $result->id)->first();
        $treinoDetalheTB->tg_id = $treinoGeral->id;
        $result = $treinoDetalheTB->save();

        return redirect()->route('treinos.createDetalhesDivisaoA', $treinoGeral->id)
                        ->with('success','Exercício adicionado com sucesso!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TreinoGeral  $treinoGeral
     * @return \Illuminate\Http\Response
     */
    public function updateDetalhesDivisaoA(Request $request, TreinoGeral $treinoGeral, TreinoDetalhe $treinoDetalhe)
    {
        $request->validate([
            'id' => 'required',
            'eq_id' => 'required',
            'exe_id' => 'required',
            'td_divisao' => 'required',
            'td_series' => 'required',
            'td_repeticoes' => 'required',
        ]);

        $treinoDetalhes = treinoDetalhe::where('id', $request->id)->first();

        $treinoDetalhes->tg_id = $treinoGeral->id;
        $treinoDetalhes->eq_id = $request->eq_id;
        $treinoDetalhes->exe_id = $request->exe_id;
        $treinoDetalhes->td_divisao = $request->td_divisao;
        $treinoDetalhes->td_series = $request->td_series;
        $treinoDetalhes->td_repeticoes = $request->td_repeticoes;
        $treinoDetalhes->save();

        return redirect()->route('treinos.createDetalhesDivisaoA', $treinoGeral->id)
                        ->with('success','Exercício atualizado com sucesso!');
    }

    public function searchDetalhesDivisaoA(Request $request, TreinoGeral $treinoGeral)
    {

        $filters = $request->except('_token');
        $exercicios = Exercicio::all();
        $equipamentos = Equipamento::all();
        $treinoDetalhes =TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->select(['exercicios.*', 'equipamentos.*', 'treino_detalhes.*'])
        ->where('tg_id', $treinoGeral->id)
        ->where('td_divisao', 'A')
        ->where('exercicios.exe_membro', 'LIKE', "%{$request->search}%")
        ->paginate(5);
        //dd($treinoDetalhes);


        return view('admin.viewsTreino.divisoes.treinoA', [
            'treinoGeral' => $treinoGeral,
            'filters' => $filters,
            'equipamentos' => $equipamentos,
            'exercicios' => $exercicios,
            'treinoDetalhes' => $treinoDetalhes,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TreinoDetalhe  $treinoDetalhe
     * @param  \App\Models\TreinoGeral  $treinoGeral
     * @return \Illuminate\Http\Response
     */
    public function destroyDetalhesDivisaoA(TreinoGeral $treinoGeral, TreinoDetalhe $treinoDetalhe)
    {
        $treinoDetalhe->delete();

                return redirect()->route('treinos.createDetalhesDivisaoA', $treinoGeral->id)
                                ->with('success', 'Exercicio excluido com sucesso!');

    }

    // DIVISÃO B
        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createDetalhesDivisaoB(TreinoGeral $treinoGeral, TreinoDetalhe $treinoDetalhe)
    {

        $treinoDetalhes =TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('tg_id', $treinoGeral->id)
        ->where('td_divisao', 'B')
        ->select(['exercicios.*', 'equipamentos.*', 'treino_detalhes.*'])->paginate(5);
        //dd($treinoDetalhes);
        $exercicios = Exercicio::all();
        $equipamentos = Equipamento::all();

        return view('admin.viewsTreino.divisoes.treinoB', [
            'treinoGeral' => $treinoGeral,
            'equipamentos' => $equipamentos,
            'exercicios' => $exercicios,
            'treinoDetalhes' => $treinoDetalhes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeDetalhesDivisaoB(Request $request, treinoGeral $treinoGeral)
    {

        $request->validate([
            'eq_id' => 'required',
            'exe_id' => 'required',
            'td_divisao' => 'required',
            'td_series' => 'required',
            'td_repeticoes' => 'required',
        ]);

        $result = TreinoDetalhe::create($request->all());

        $treinoDetalheTB = TreinoDetalhe::where('id', $result->id)->first();
        $treinoDetalheTB->tg_id = $treinoGeral->id;
        $result = $treinoDetalheTB->save();

        return redirect()->route('treinos.createDetalhesDivisaoB', $treinoGeral->id)
                        ->with('success','Exercício adicionado com sucesso!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TreinoGeral  $treinoGeral
     * @return \Illuminate\Http\Response
     */
    public function updateDetalhesDivisaoB(Request $request, TreinoGeral $treinoGeral, TreinoDetalhe $treinoDetalhe)
    {
        $request->validate([
            'id' => 'required',
            'eq_id' => 'required',
            'exe_id' => 'required',
            'td_divisao' => 'required',
            'td_series' => 'required',
            'td_repeticoes' => 'required',
        ]);

        $treinoDetalhes = treinoDetalhe::where('id', $request->id)->first();

        $treinoDetalhes->tg_id = $treinoGeral->id;
        $treinoDetalhes->eq_id = $request->eq_id;
        $treinoDetalhes->exe_id = $request->exe_id;
        $treinoDetalhes->td_divisao = $request->td_divisao;
        $treinoDetalhes->td_series = $request->td_series;
        $treinoDetalhes->td_repeticoes = $request->td_repeticoes;
        $treinoDetalhes->save();

        return redirect()->route('treinos.createDetalhesDivisaoB', $treinoGeral->id)
                        ->with('success','Exercício atualizado com sucesso!');
    }

    public function searchDetalhesDivisaoB(Request $request, TreinoGeral $treinoGeral)
    {

        $filters = $request->except('_token');
        $exercicios = Exercicio::all();
        $equipamentos = Equipamento::all();
        $treinoDetalhes =TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->select(['exercicios.*', 'equipamentos.*', 'treino_detalhes.*'])
        ->where('tg_id', $treinoGeral->id)
        ->where('td_divisao', 'B')
        ->where('exercicios.exe_membro', 'LIKE', "%{$request->search}%")
        ->paginate(5);
        //dd($treinoDetalhes);


        return view('admin.viewsTreino.divisoes.treinoB', [
            'treinoGeral' => $treinoGeral,
            'filters' => $filters,
            'equipamentos' => $equipamentos,
            'exercicios' => $exercicios,
            'treinoDetalhes' => $treinoDetalhes,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TreinoDetalhe  $treinoDetalhe
     * @param  \App\Models\TreinoGeral  $treinoGeral
     * @return \Illuminate\Http\Response
     */
    public function destroyDetalhesDivisaoB(TreinoGeral $treinoGeral, TreinoDetalhe $treinoDetalhe)
    {
        $treinoDetalhe->delete();

                return redirect()->route('treinos.createDetalhesDivisaoB', $treinoGeral->id)
                                ->with('success', 'Exercicio excluido com sucesso!');

    }

        // DIVISÃO C
        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createDetalhesDivisaoC(TreinoGeral $treinoGeral, TreinoDetalhe $treinoDetalhe)
    {

        $treinoDetalhes =TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('tg_id', $treinoGeral->id)
        ->where('td_divisao', 'C')
        ->select(['exercicios.*', 'equipamentos.*', 'treino_detalhes.*'])->paginate(5);
        //dd($treinoDetalhes);
        $exercicios = Exercicio::all();
        $equipamentos = Equipamento::all();

        return view('admin.viewsTreino.divisoes.treinoC', [
            'treinoGeral' => $treinoGeral,
            'equipamentos' => $equipamentos,
            'exercicios' => $exercicios,
            'treinoDetalhes' => $treinoDetalhes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeDetalhesDivisaoC(Request $request, treinoGeral $treinoGeral)
    {

        $request->validate([
            'eq_id' => 'required',
            'exe_id' => 'required',
            'td_divisao' => 'required',
            'td_series' => 'required',
            'td_repeticoes' => 'required',
        ]);

        $result = TreinoDetalhe::create($request->all());

        $treinoDetalheTB = TreinoDetalhe::where('id', $result->id)->first();
        $treinoDetalheTB->tg_id = $treinoGeral->id;
        $result = $treinoDetalheTB->save();

        return redirect()->route('treinos.createDetalhesDivisaoC', $treinoGeral->id)
                        ->with('success','Exercício adicionado com sucesso!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TreinoGeral  $treinoGeral
     * @return \Illuminate\Http\Response
     */
    public function updateDetalhesDivisaoC(Request $request, TreinoGeral $treinoGeral, TreinoDetalhe $treinoDetalhe)
    {
        $request->validate([
            'id' => 'required',
            'eq_id' => 'required',
            'exe_id' => 'required',
            'td_divisao' => 'required',
            'td_series' => 'required',
            'td_repeticoes' => 'required',
        ]);

        $treinoDetalhes = treinoDetalhe::where('id', $request->id)->first();

        $treinoDetalhes->tg_id = $treinoGeral->id;
        $treinoDetalhes->eq_id = $request->eq_id;
        $treinoDetalhes->exe_id = $request->exe_id;
        $treinoDetalhes->td_divisao = $request->td_divisao;
        $treinoDetalhes->td_series = $request->td_series;
        $treinoDetalhes->td_repeticoes = $request->td_repeticoes;
        $treinoDetalhes->save();

        return redirect()->route('treinos.createDetalhesDivisaoC', $treinoGeral->id)
                        ->with('success','Exercício atualizado com sucesso!');
    }

    public function searchDetalhesDivisaoC(Request $request, TreinoGeral $treinoGeral)
    {

        $filters = $request->except('_token');
        $exercicios = Exercicio::all();
        $equipamentos = Equipamento::all();
        $treinoDetalhes =TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->select(['exercicios.*', 'equipamentos.*', 'treino_detalhes.*'])
        ->where('tg_id', $treinoGeral->id)
        ->where('td_divisao', 'C')
        ->where('exercicios.exe_membro', 'LIKE', "%{$request->search}%")
        ->paginate(5);
        //dd($treinoDetalhes);


        return view('admin.viewsTreino.divisoes.treinoC', [
            'treinoGeral' => $treinoGeral,
            'filters' => $filters,
            'equipamentos' => $equipamentos,
            'exercicios' => $exercicios,
            'treinoDetalhes' => $treinoDetalhes,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TreinoDetalhe  $treinoDetalhe
     * @param  \App\Models\TreinoGeral  $treinoGeral
     * @return \Illuminate\Http\Response
     */
    public function destroyDetalhesDivisaoC(TreinoGeral $treinoGeral, TreinoDetalhe $treinoDetalhe)
    {
        $treinoDetalhe->delete();

                return redirect()->route('treinos.createDetalhesDivisaoC', $treinoGeral->id)
                                ->with('success', 'Exercicio excluido com sucesso!');

    }

            // DIVISÃO D
        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createDetalhesDivisaoD(TreinoGeral $treinoGeral, TreinoDetalhe $treinoDetalhe)
    {

        $treinoDetalhes =TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('tg_id', $treinoGeral->id)
        ->where('td_divisao', 'D')
        ->select(['exercicios.*', 'equipamentos.*', 'treino_detalhes.*'])->paginate(5);
        //dd($treinoDetalhes);
        $exercicios = Exercicio::all();
        $equipamentos = Equipamento::all();

        return view('admin.viewsTreino.divisoes.treinoD', [
            'treinoGeral' => $treinoGeral,
            'equipamentos' => $equipamentos,
            'exercicios' => $exercicios,
            'treinoDetalhes' => $treinoDetalhes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeDetalhesDivisaoD(Request $request, treinoGeral $treinoGeral)
    {

        $request->validate([
            'eq_id' => 'required',
            'exe_id' => 'required',
            'td_divisao' => 'required',
            'td_series' => 'required',
            'td_repeticoes' => 'required',
        ]);

        $result = TreinoDetalhe::create($request->all());

        $treinoDetalheTB = TreinoDetalhe::where('id', $result->id)->first();
        $treinoDetalheTB->tg_id = $treinoGeral->id;
        $result = $treinoDetalheTB->save();

        return redirect()->route('treinos.createDetalhesDivisaoD', $treinoGeral->id)
                        ->with('success','Exercício adicionado com sucesso!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TreinoGeral  $treinoGeral
     * @return \Illuminate\Http\Response
     */
    public function updateDetalhesDivisaoD(Request $request, TreinoGeral $treinoGeral, TreinoDetalhe $treinoDetalhe)
    {
        $request->validate([
            'id' => 'required',
            'eq_id' => 'required',
            'exe_id' => 'required',
            'td_divisao' => 'required',
            'td_series' => 'required',
            'td_repeticoes' => 'required',
        ]);

        $treinoDetalhes = treinoDetalhe::where('id', $request->id)->first();

        $treinoDetalhes->tg_id = $treinoGeral->id;
        $treinoDetalhes->eq_id = $request->eq_id;
        $treinoDetalhes->exe_id = $request->exe_id;
        $treinoDetalhes->td_divisao = $request->td_divisao;
        $treinoDetalhes->td_series = $request->td_series;
        $treinoDetalhes->td_repeticoes = $request->td_repeticoes;
        $treinoDetalhes->save();

        return redirect()->route('treinos.createDetalhesDivisaoD', $treinoGeral->id)
                        ->with('success','Exercício atualizado com sucesso!');
    }

    public function searchDetalhesDivisaoD(Request $request, TreinoGeral $treinoGeral)
    {

        $filters = $request->except('_token');
        $exercicios = Exercicio::all();
        $equipamentos = Equipamento::all();
        $treinoDetalhes =TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->select(['exercicios.*', 'equipamentos.*', 'treino_detalhes.*'])
        ->where('tg_id', $treinoGeral->id)
        ->where('td_divisao', 'D')
        ->where('exercicios.exe_membro', 'LIKE', "%{$request->search}%")
        ->paginate(5);
        //dd($treinoDetalhes);


        return view('admin.viewsTreino.divisoes.treinoD', [
            'treinoGeral' => $treinoGeral,
            'filters' => $filters,
            'equipamentos' => $equipamentos,
            'exercicios' => $exercicios,
            'treinoDetalhes' => $treinoDetalhes,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TreinoDetalhe  $treinoDetalhe
     * @param  \App\Models\TreinoGeral  $treinoGeral
     * @return \Illuminate\Http\Response
     */
    public function destroyDetalhesDivisaoD(TreinoGeral $treinoGeral, TreinoDetalhe $treinoDetalhe)
    {
        $treinoDetalhe->delete();

                return redirect()->route('treinos.createDetalhesDivisaoD', $treinoGeral->id)
                                ->with('success', 'Exercicio excluido com sucesso!');

    }

                // DIVISÃO E
        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createDetalhesDivisaoE(TreinoGeral $treinoGeral, TreinoDetalhe $treinoDetalhe)
    {

        $treinoDetalhes =TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('tg_id', $treinoGeral->id)
        ->where('td_divisao', 'E')
        ->select(['exercicios.*', 'equipamentos.*', 'treino_detalhes.*'])->paginate(5);
        //dd($treinoDetalhes);
        $exercicios = Exercicio::all();
        $equipamentos = Equipamento::all();

        return view('admin.viewsTreino.divisoes.treinoE', [
            'treinoGeral' => $treinoGeral,
            'equipamentos' => $equipamentos,
            'exercicios' => $exercicios,
            'treinoDetalhes' => $treinoDetalhes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeDetalhesDivisaoE(Request $request, treinoGeral $treinoGeral)
    {

        $request->validate([
            'eq_id' => 'required',
            'exe_id' => 'required',
            'td_divisao' => 'required',
            'td_series' => 'required',
            'td_repeticoes' => 'required',
        ]);

        $result = TreinoDetalhe::create($request->all());

        $treinoDetalheTB = TreinoDetalhe::where('id', $result->id)->first();
        $treinoDetalheTB->tg_id = $treinoGeral->id;
        $result = $treinoDetalheTB->save();

        return redirect()->route('treinos.createDetalhesDivisaoE', $treinoGeral->id)
                        ->with('success','Exercício adicionado com sucesso!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TreinoGeral  $treinoGeral
     * @return \Illuminate\Http\Response
     */
    public function updateDetalhesDivisaoE(Request $request, TreinoGeral $treinoGeral, TreinoDetalhe $treinoDetalhe)
    {
        $request->validate([
            'id' => 'required',
            'eq_id' => 'required',
            'exe_id' => 'required',
            'td_divisao' => 'required',
            'td_series' => 'required',
            'td_repeticoes' => 'required',
        ]);

        $treinoDetalhes = treinoDetalhe::where('id', $request->id)->first();

        $treinoDetalhes->tg_id = $treinoGeral->id;
        $treinoDetalhes->eq_id = $request->eq_id;
        $treinoDetalhes->exe_id = $request->exe_id;
        $treinoDetalhes->td_divisao = $request->td_divisao;
        $treinoDetalhes->td_series = $request->td_series;
        $treinoDetalhes->td_repeticoes = $request->td_repeticoes;
        $treinoDetalhes->save();

        return redirect()->route('treinos.createDetalhesDivisaoE', $treinoGeral->id)
                        ->with('success','Exercício atualizado com sucesso!');
    }

    public function searchDetalhesDivisaoE(Request $request, TreinoGeral $treinoGeral)
    {

        $filters = $request->except('_token');
        $exercicios = Exercicio::all();
        $equipamentos = Equipamento::all();
        $treinoDetalhes =TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->select(['exercicios.*', 'equipamentos.*', 'treino_detalhes.*'])
        ->where('tg_id', $treinoGeral->id)
        ->where('td_divisao', 'E')
        ->where('exercicios.exe_membro', 'LIKE', "%{$request->search}%")
        ->paginate(5);
        //dd($treinoDetalhes);


        return view('admin.viewsTreino.divisoes.treinoE', [
            'treinoGeral' => $treinoGeral,
            'filters' => $filters,
            'equipamentos' => $equipamentos,
            'exercicios' => $exercicios,
            'treinoDetalhes' => $treinoDetalhes,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TreinoDetalhe  $treinoDetalhe
     * @param  \App\Models\TreinoGeral  $treinoGeral
     * @return \Illuminate\Http\Response
     */
    public function destroyDetalhesDivisaoE(TreinoGeral $treinoGeral, TreinoDetalhe $treinoDetalhe)
    {
        $treinoDetalhe->delete();

                return redirect()->route('treinos.createDetalhesDivisaoE', $treinoGeral->id)
                                ->with('success', 'Exercicio excluido com sucesso!');

    }

}

