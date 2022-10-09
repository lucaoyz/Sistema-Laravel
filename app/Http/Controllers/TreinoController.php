<?php

namespace App\Http\Controllers;


use App\Models\Exercicio;
use App\Models\Aluno;
use App\Models\Equipamento;
use App\Models\historicoTreino;
use App\Models\Personal;
use App\Models\TreinoDetalhe;
use App\Models\TreinoGeral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;
use Carbon\Carbon;


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

    public function indexAluno()
    {
        $authUser = auth::user();
        $authAluID = $authUser->alu_id;
        $aluno = Aluno::where('id', '=', $authAluID)->first();
        $treinoGeralAluno = TreinoGeral::where('alu_id', '=', $aluno->id)->first();
        $historicoTreinoFirst = historicoTreino::where('tg_id', '=', $treinoGeralAluno->id)->latest()->first();
        if(empty($historicoTreinoFirst)) {
            $historicoTreinoFirst = null;
        } else {
            $historicoTreinoFirst = $historicoTreinoFirst->ht_divisao;
        }

        $historicoTreinos = historicoTreino::where('tg_id', '=', $treinoGeralAluno->id)->orderBy('created_at', 'desc')->get();

        return view('aluno.viewsTreino.treino', [
            'historicoTreinoFirst' => $historicoTreinoFirst,
            'historicoTreinos' => $historicoTreinos,
        ]);
    }

    public function visualizarTreinoAluno()
    {
        $authUser = auth::user();
        $authAluID = $authUser->alu_id;
        $aluno = Aluno::where('id', '=', $authAluID)->first();
        $treinoGeralAluno = TreinoGeral::where('alu_id', '=', $aluno->id)->first();
        if(empty($treinoGeralAluno)){
        $treinoGeralAlunoDivisoes = null;
    }
        else {
        $treinoGeralAlunoDivisoes = $treinoGeralAluno->tg_divisoes;
    }

        return view('aluno.viewsTreino.treinoVisualizar', [
            'treinoGeralAlunoDivisoes' => $treinoGeralAlunoDivisoes,
        ]);
    }

    // DIVISÃO A
    public function visualizarTreinoAAluno()
    {
        $authUser = auth::user();
        $authAluID = $authUser->alu_id;
        $aluno = Aluno::where('id', '=', $authAluID)->first();
        $treinoGeralAluno = TreinoGeral::where('alu_id', '=', $aluno->id)->first();

        $treinoAAlunos = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'A')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('treino_detalhes.td_numero', 'asc')
        ->get();

        $treinoBAlunos = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'B')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('treino_detalhes.td_numero', 'asc')
        ->get();


        $treinoCAlunos = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'C')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('treino_detalhes.td_numero', 'asc')
        ->get();

        $treinoDAlunos = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'D')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('treino_detalhes.td_numero', 'asc')
        ->get();

        $treinoEAlunos = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'E')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('treino_detalhes.td_numero', 'asc')
        ->get();

        $treinoFAlunos = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'F')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('treino_detalhes.td_numero', 'asc')
        ->get();

        //dd($treinoAAlunos);
        return view('aluno.viewsTreino.divisoes.treinoVisualizarTreinoA', [
            'treinoAAlunos' => $treinoAAlunos,
            'treinoBAlunos' => $treinoBAlunos,
            'treinoCAlunos' => $treinoCAlunos,
            'treinoDAlunos' => $treinoDAlunos,
            'treinoEAlunos' => $treinoEAlunos,
            'treinoFAlunos' => $treinoFAlunos,
        ]);
    }

    // DIVISÃO B
    public function visualizarTreinoBAluno()
    {
        $authUser = auth::user();
        $authAluID = $authUser->alu_id;
        $aluno = Aluno::where('id', '=', $authAluID)->first();
        $treinoGeralAluno = TreinoGeral::where('alu_id', '=', $aluno->id)->first();
        $treinoAAlunos = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'A')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('treino_detalhes.td_numero', 'asc')
        ->get();

        $treinoBAlunos = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'B')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('treino_detalhes.td_numero', 'asc')
        ->get();


        $treinoCAlunos = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'C')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('treino_detalhes.td_numero', 'asc')
        ->get();

        $treinoDAlunos = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'D')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('treino_detalhes.td_numero', 'asc')
        ->get();

        $treinoEAlunos = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'E')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('treino_detalhes.td_numero', 'asc')
        ->get();

        $treinoFAlunos = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'F')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('treino_detalhes.td_numero', 'asc')
        ->get();

        //dd($treinoAAlunos);
        return view('aluno.viewsTreino.divisoes.treinoVisualizarTreinoB', [
            'treinoAAlunos' => $treinoAAlunos,
            'treinoBAlunos' => $treinoBAlunos,
            'treinoCAlunos' => $treinoCAlunos,
            'treinoDAlunos' => $treinoDAlunos,
            'treinoEAlunos' => $treinoEAlunos,
            'treinoFAlunos' => $treinoFAlunos,
        ]);
    }

    // DIVISÃO C
    public function visualizarTreinoCAluno()
    {
        $authUser = auth::user();
        $authAluID = $authUser->alu_id;
        $aluno = Aluno::where('id', '=', $authAluID)->first();
        $treinoGeralAluno = TreinoGeral::where('alu_id', '=', $aluno->id)->first();
        $treinoAAlunos = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'A')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('treino_detalhes.td_numero', 'asc')
        ->get();

        $treinoBAlunos = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'B')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('treino_detalhes.td_numero', 'asc')
        ->get();


        $treinoCAlunos = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'C')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('treino_detalhes.td_numero', 'asc')
        ->get();

        $treinoDAlunos = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'D')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('treino_detalhes.td_numero', 'asc')
        ->get();

        $treinoEAlunos = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'E')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('treino_detalhes.td_numero', 'asc')
        ->get();

        $treinoFAlunos = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'F')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('treino_detalhes.td_numero', 'asc')
        ->get();

        //dd($treinoAAlunos);
        return view('aluno.viewsTreino.divisoes.treinoVisualizarTreinoC', [
            'treinoAAlunos' => $treinoAAlunos,
            'treinoBAlunos' => $treinoBAlunos,
            'treinoCAlunos' => $treinoCAlunos,
            'treinoDAlunos' => $treinoDAlunos,
            'treinoEAlunos' => $treinoEAlunos,
            'treinoFAlunos' => $treinoFAlunos,
        ]);
    }

    // DIVISÃO D
    public function visualizarTreinoDAluno()
    {
        $authUser = auth::user();
        $authAluID = $authUser->alu_id;
        $aluno = Aluno::where('id', '=', $authAluID)->first();
        $treinoGeralAluno = TreinoGeral::where('alu_id', '=', $aluno->id)->first();
        $treinoAAlunos = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'A')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('treino_detalhes.td_numero', 'asc')
        ->get();

        $treinoBAlunos = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'B')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('treino_detalhes.td_numero', 'asc')
        ->get();


        $treinoCAlunos = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'C')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('treino_detalhes.td_numero', 'asc')
        ->get();

        $treinoDAlunos = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'D')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('treino_detalhes.td_numero', 'asc')
        ->get();

        $treinoEAlunos = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'E')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('treino_detalhes.td_numero', 'asc')
        ->get();

        $treinoFAlunos = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'F')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('treino_detalhes.td_numero', 'asc')
        ->get();

        //dd($treinoAAlunos);
        return view('aluno.viewsTreino.divisoes.treinoVisualizarTreinoD', [
            'treinoAAlunos' => $treinoAAlunos,
            'treinoBAlunos' => $treinoBAlunos,
            'treinoCAlunos' => $treinoCAlunos,
            'treinoDAlunos' => $treinoDAlunos,
            'treinoEAlunos' => $treinoEAlunos,
            'treinoFAlunos' => $treinoFAlunos,
        ]);
    }

    // DIVISÃO E
    public function visualizarTreinoEAluno()
    {
        $authUser = auth::user();
        $authAluID = $authUser->alu_id;
        $aluno = Aluno::where('id', '=', $authAluID)->first();
        $treinoGeralAluno = TreinoGeral::where('alu_id', '=', $aluno->id)->first();
        $treinoAAlunos = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'A')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('treino_detalhes.td_numero', 'asc')
        ->get();

        $treinoBAlunos = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'B')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('treino_detalhes.td_numero', 'asc')
        ->get();


        $treinoCAlunos = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'C')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('treino_detalhes.td_numero', 'asc')
        ->get();

        $treinoDAlunos = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'D')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('treino_detalhes.td_numero', 'asc')
        ->get();

        $treinoEAlunos = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'E')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('treino_detalhes.td_numero', 'asc')
        ->get();

        $treinoFAlunos = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'F')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('treino_detalhes.td_numero', 'asc')
        ->get();

        //dd($treinoAAlunos);
        return view('aluno.viewsTreino.divisoes.treinoVisualizarTreinoE', [
            'treinoAAlunos' => $treinoAAlunos,
            'treinoBAlunos' => $treinoBAlunos,
            'treinoCAlunos' => $treinoCAlunos,
            'treinoDAlunos' => $treinoDAlunos,
            'treinoEAlunos' => $treinoEAlunos,
            'treinoFAlunos' => $treinoFAlunos,
        ]);
    }

    // DIVISÃO F
    public function visualizarTreinoFAluno()
    {
        $authUser = auth::user();
        $authAluID = $authUser->alu_id;
        $aluno = Aluno::where('id', '=', $authAluID)->first();
        $treinoGeralAluno = TreinoGeral::where('alu_id', '=', $aluno->id)->first();
        $treinoAAlunos = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'A')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('treino_detalhes.td_numero', 'asc')
        ->get();

        $treinoBAlunos = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'B')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('treino_detalhes.td_numero', 'asc')
        ->get();


        $treinoCAlunos = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'C')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('treino_detalhes.td_numero', 'asc')
        ->get();

        $treinoDAlunos = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'D')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('treino_detalhes.td_numero', 'asc')
        ->get();

        $treinoEAlunos = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'E')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('treino_detalhes.td_numero', 'asc')
        ->get();

        $treinoFAlunos = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'F')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('treino_detalhes.td_numero', 'asc')
        ->get();

        //dd($treinoAAlunos);
        return view('aluno.viewsTreino.divisoes.treinoVisualizarTreinoF', [
            'treinoAAlunos' => $treinoAAlunos,
            'treinoBAlunos' => $treinoBAlunos,
            'treinoCAlunos' => $treinoCAlunos,
            'treinoDAlunos' => $treinoDAlunos,
            'treinoEAlunos' => $treinoEAlunos,
            'treinoFAlunos' => $treinoFAlunos,
        ]);
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
        ->select(['personals.*', 'alunos.*', 'treino_gerals.*'])->orderBy('treino_gerals.created_at', 'desc')->paginate(5);

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
        $treino_detalhes = TreinoDetalhe::where('tg_id', '=', $treinoGeral->id)->first();
        $historicoTreino = historicoTreino::where('tg_id', '=', $treinoGeral->id)->get();
        if(empty($treino_detalhes)){
            $historicoTreino->each->delete();
            $treinoGeral->delete();
            return redirect()->route('treinos.indexGeral')
                                ->with('success', 'Treino excluido com sucesso!');
        } else {
            return redirect()->route('treinos.indexGeral')
            ->with('error', 'Esse treino possui exercícios registrados e não pode ser excluído.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TreinoGeral  $treinoGeral
     * @return \Illuminate\Http\Response
     */
    public function limparGeral(TreinoGeral $treinoGeral)
    {
        $treino_detalhes = TreinoDetalhe::where('tg_id', '=', $treinoGeral->id)->get();

            $treino_detalhes->each->delete();
            return redirect()->route('treinos.indexGeral')
                                ->with('success', 'Treino limpo com sucesso!');
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
        ->select(['exercicios.*', 'equipamentos.*', 'treino_detalhes.*'])->orderBy('treino_detalhes.td_numero', 'asc')->paginate(5);
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
        $numeroTreinoDetalhe = TreinoDetalhe::where('td_numero', '=', $request->input('td_numero'))->where('tg_id', '=', $treinoGeral->id)->first();

        if($numeroTreinoDetalhe){
            return redirect()->route('treinos.createDetalhesDivisaoA', $treinoGeral->id)
                    ->with('error','Esse Nº de ordem de exercício já está cadastrado!');
        } else {
        $request->validate([
            'eq_id' => 'required',
            'exe_id' => 'required',
            'td_numero' => 'required',
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
        $numeroTreinoDetalhe = TreinoDetalhe::where('td_numero', '=', $request->input('td_numero'))->where('tg_id', '=', $treinoGeral->id)->first();
        $treinoDetalheId = TreinoDetalhe::where('id', '=', $request->input('id'))->first();

        if($numeroTreinoDetalhe){
            if($numeroTreinoDetalhe->id != $treinoDetalheId->id) {
            return redirect()->route('treinos.createDetalhesDivisaoA', $treinoGeral->id)
                    ->with('error','Esse Nº de ordem de exercício já está cadastrado!');
                } else {
                    $request->validate([
                        'id' => 'required',
                        'eq_id' => 'required',
                        'exe_id' => 'required',
                        'td_numero' => 'required',
                        'td_divisao' => 'required',
                        'td_series' => 'required',
                        'td_repeticoes' => 'required',
                    ]);

                    $treinoDetalhes = treinoDetalhe::where('id', $request->id)->first();

                    $treinoDetalhes->tg_id = $treinoGeral->id;
                    $treinoDetalhes->eq_id = $request->eq_id;
                    $treinoDetalhes->exe_id = $request->exe_id;
                    $treinoDetalhes->td_numero = $request->td_numero;
                    $treinoDetalhes->td_divisao = $request->td_divisao;
                    $treinoDetalhes->td_series = $request->td_series;
                    $treinoDetalhes->td_repeticoes = $request->td_repeticoes;
                    $treinoDetalhes->save();

                    return redirect()->route('treinos.createDetalhesDivisaoA', $treinoGeral->id)
                                    ->with('success','Exercício atualizado com sucesso!');
                }
        }
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
        ->select(['exercicios.*', 'equipamentos.*', 'treino_detalhes.*'])->orderBy('treino_detalhes.td_numero', 'asc')->paginate(5);
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
        ->select(['exercicios.*', 'equipamentos.*', 'treino_detalhes.*'])->orderBy('treino_detalhes.td_numero', 'asc')->paginate(5);
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
        ->select(['exercicios.*', 'equipamentos.*', 'treino_detalhes.*'])->orderBy('treino_detalhes.td_numero', 'asc')->paginate(5);
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
        ->select(['exercicios.*', 'equipamentos.*', 'treino_detalhes.*'])->orderBy('treino_detalhes.td_numero', 'asc')->paginate(5);
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

    // DIVISÃO F
        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createDetalhesDivisaoF(TreinoGeral $treinoGeral, TreinoDetalhe $treinoDetalhe)
    {

        $treinoDetalhes =TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('tg_id', $treinoGeral->id)
        ->where('td_divisao', 'F')
        ->select(['exercicios.*', 'equipamentos.*', 'treino_detalhes.*'])->orderBy('treino_detalhes.td_numero', 'asc')->paginate(5);
        //dd($treinoDetalhes);
        $exercicios = Exercicio::all();
        $equipamentos = Equipamento::all();

        return view('admin.viewsTreino.divisoes.treinoF', [
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
    public function storeDetalhesDivisaoF(Request $request, treinoGeral $treinoGeral)
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

        return redirect()->route('treinos.createDetalhesDivisaoF', $treinoGeral->id)
                        ->with('success','Exercício adicionado com sucesso!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TreinoGeral  $treinoGeral
     * @return \Illuminate\Http\Response
     */
    public function updateDetalhesDivisaoF(Request $request, TreinoGeral $treinoGeral, TreinoDetalhe $treinoDetalhe)
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

        return redirect()->route('treinos.createDetalhesDivisaoF', $treinoGeral->id)
                        ->with('success','Exercício atualizado com sucesso!');
    }

    public function searchDetalhesDivisaoF(Request $request, TreinoGeral $treinoGeral)
    {

        $filters = $request->except('_token');
        $exercicios = Exercicio::all();
        $equipamentos = Equipamento::all();
        $treinoDetalhes =TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->select(['exercicios.*', 'equipamentos.*', 'treino_detalhes.*'])
        ->where('tg_id', $treinoGeral->id)
        ->where('td_divisao', 'F')
        ->where('exercicios.exe_membro', 'LIKE', "%{$request->search}%")
        ->paginate(5);
        //dd($treinoDetalhes);


        return view('admin.viewsTreino.divisoes.treinoF', [
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
    public function destroyDetalhesDivisaoF(TreinoGeral $treinoGeral, TreinoDetalhe $treinoDetalhe)
    {
        $treinoDetalhe->delete();

                return redirect()->route('treinos.createDetalhesDivisaoF', $treinoGeral->id)
                                ->with('success', 'Exercício excluido com sucesso!');

    }

    public function PDFTreinoDivisoes()
    {
        $authUser = auth::user();
        $authAluID = $authUser->alu_id;
        $aluno = Aluno::where('id', '=', $authAluID)->first();
        $treinoGeralAluno = TreinoGeral::where('alu_id', '=', $aluno->id)->first();
        if(empty($treinoGeralAluno)){
        $treinoGeralAlunoDivisoes = null;
    }
        else {
        $treinoGeralAlunoDivisoes = $treinoGeralAluno->tg_divisoes;
    }

        return view('aluno.viewsTreino.baixarTreino.treinosDivisoesPDF', [
            'treinoGeralAlunoDivisoes' => $treinoGeralAlunoDivisoes,
        ]);
    }

    public function PDFTreinoDivisoesA()
    {
        $authUser = auth::user();
        $authAluID = $authUser->alu_id;
        $aluno = Aluno::where('id', '=', $authAluID)->first();
        $treinoGeralAluno = TreinoGeral::where('alu_id', '=', $aluno->id)->first();
        $treinoGeralDivisoes = $treinoGeralAluno->tg_divisoes;

        $treinoAlunosPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'A')
        ->where('exe_membro', '=', 'peito')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'A')
            ->where('exe_membro', '=', 'peito')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhPeito)){
                $treinoAlunosPeito = null;
            }

        $treinoAlunosCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'A')
        ->where('exe_membro', '=', 'costas')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'A')
            ->where('exe_membro', '=', 'costas')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhCostas)){
                $treinoAlunosCostas = null;
            }

        $treinoAlunosBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'A')
        ->where('exe_membro', '=', 'biceps')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'A')
            ->where('exe_membro', '=', 'biceps')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhBiceps)){
                $treinoAlunosBiceps = null;
            }

        $treinoAlunosTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'A')
        ->where('exe_membro', '=', 'triceps')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'A')
            ->where('exe_membro', '=', 'triceps')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhTriceps)){
                $treinoAlunosTriceps = null;
            }

        $treinoAlunosAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'A')
        ->where('exe_membro', '=', 'antebraco')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'A')
            ->where('exe_membro', '=', 'antebraco')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhAntebraco)){
                $treinoAlunosAntebraco = null;
            }

        $treinoAlunosOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'A')
        ->where('exe_membro', '=', 'ombro')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'A')
            ->where('exe_membro', '=', 'ombro')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhOmbro)){
                $treinoAlunosOmbro = null;
            }

        $treinoAlunosTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'A')
        ->where('exe_membro', '=', 'trapezio')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'A')
            ->where('exe_membro', '=', 'trapezio')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhTrapezio)){
                $treinoAlunosTrapezio = null;
            }

        $treinoAlunosInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'A')
        ->where('exe_membro', '=', 'inferior')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'A')
            ->where('exe_membro', '=', 'inferior')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhInferior)){
                $treinoAlunosInferior = null;
            }

        $treinoAlunosLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'A')
        ->where('exe_membro', '=', 'lombar')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'A')
            ->where('exe_membro', '=', 'lombar')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhLombar)){
                $treinoAlunosLombar = null;
            }

        $treinoAlunosAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'A')
        ->where('exe_membro', '=', 'abdomen')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'A')
            ->where('exe_membro', '=', 'abdomen')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhAbdomen)){
                $treinoAlunosAbdomen = null;
            }

    return PDF::loadView('aluno.viewsTreino.baixarTreino.PDFtreinoDivisaoA', [
        'treinoGeralDivisoes' => $treinoGeralDivisoes,
        'treinoAlunosPeito' => $treinoAlunosPeito,
        'treinoAlunosCostas' => $treinoAlunosCostas,
        'treinoAlunosBiceps' => $treinoAlunosBiceps,
        'treinoAlunosTriceps' => $treinoAlunosTriceps,
        'treinoAlunosAntebraco' => $treinoAlunosAntebraco,
        'treinoAlunosOmbro' => $treinoAlunosOmbro,
        'treinoAlunosTrapezio' => $treinoAlunosTrapezio,
        'treinoAlunosInferior' => $treinoAlunosInferior,
        'treinoAlunosLombar' => $treinoAlunosLombar,
        'treinoAlunosAbdomen' => $treinoAlunosAbdomen,
    ])
                    ->setPaper('a4', 'landscape')
                //->download('treino.pdf');
                ->stream(); //EXCLUIR DPS DE FINALIZAR A TELA DE DOWNLOAD
    }

    public function PDFTreinoDivisoesB()
    {
        $authUser = auth::user();
        $authAluID = $authUser->alu_id;
        $aluno = Aluno::where('id', '=', $authAluID)->first();
        $treinoGeralAluno = TreinoGeral::where('alu_id', '=', $aluno->id)->first();
        $treinoGeralDivisoes = $treinoGeralAluno->tg_divisoes;

        $treinoAlunosPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'B')
        ->where('exe_membro', '=', 'peito')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'B')
            ->where('exe_membro', '=', 'peito')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhPeito)){
                $treinoAlunosPeito = null;
            }

        $treinoAlunosCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'B')
        ->where('exe_membro', '=', 'costas')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'B')
            ->where('exe_membro', '=', 'costas')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhCostas)){
                $treinoAlunosCostas = null;
            }

        $treinoAlunosBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'B')
        ->where('exe_membro', '=', 'biceps')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'B')
            ->where('exe_membro', '=', 'biceps')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhBiceps)){
                $treinoAlunosBiceps = null;
            }

        $treinoAlunosTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'B')
        ->where('exe_membro', '=', 'triceps')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'B')
            ->where('exe_membro', '=', 'triceps')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhTriceps)){
                $treinoAlunosTriceps = null;
            }

        $treinoAlunosAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'B')
        ->where('exe_membro', '=', 'antebraco')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'B')
            ->where('exe_membro', '=', 'antebraco')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhAntebraco)){
                $treinoAlunosAntebraco = null;
            }

        $treinoAlunosOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'B')
        ->where('exe_membro', '=', 'ombro')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'B')
            ->where('exe_membro', '=', 'ombro')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhOmbro)){
                $treinoAlunosOmbro = null;
            }

        $treinoAlunosTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'B')
        ->where('exe_membro', '=', 'trapezio')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'B')
            ->where('exe_membro', '=', 'trapezio')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhTrapezio)){
                $treinoAlunosTrapezio = null;
            }

        $treinoAlunosInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'B')
        ->where('exe_membro', '=', 'inferior')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'B')
            ->where('exe_membro', '=', 'inferior')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhInferior)){
                $treinoAlunosInferior = null;
            }

        $treinoAlunosLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'B')
        ->where('exe_membro', '=', 'lombar')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'B')
            ->where('exe_membro', '=', 'lombar')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhLombar)){
                $treinoAlunosLombar = null;
            }

        $treinoAlunosAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'B')
        ->where('exe_membro', '=', 'abdomen')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'B')
            ->where('exe_membro', '=', 'abdomen')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhAbdomen)){
                $treinoAlunosAbdomen = null;
            }

    return PDF::loadView('aluno.viewsTreino.baixarTreino.PDFtreinoDivisaoB', [
        'treinoGeralDivisoes' => $treinoGeralDivisoes,
        'treinoAlunosPeito' => $treinoAlunosPeito,
        'treinoAlunosCostas' => $treinoAlunosCostas,
        'treinoAlunosBiceps' => $treinoAlunosBiceps,
        'treinoAlunosTriceps' => $treinoAlunosTriceps,
        'treinoAlunosAntebraco' => $treinoAlunosAntebraco,
        'treinoAlunosOmbro' => $treinoAlunosOmbro,
        'treinoAlunosTrapezio' => $treinoAlunosTrapezio,
        'treinoAlunosInferior' => $treinoAlunosInferior,
        'treinoAlunosLombar' => $treinoAlunosLombar,
        'treinoAlunosAbdomen' => $treinoAlunosAbdomen,
    ])
                    ->setPaper('a4', 'landscape')
                //->download('treino.pdf');
                ->stream(); //EXCLUIR DPS DE FINALIZAR A TELA DE DOWNLOAD
    }

    public function PDFTreinoDivisoesC()
    {
        $authUser = auth::user();
        $authAluID = $authUser->alu_id;
        $aluno = Aluno::where('id', '=', $authAluID)->first();
        $treinoGeralAluno = TreinoGeral::where('alu_id', '=', $aluno->id)->first();
        $treinoGeralDivisoes = $treinoGeralAluno->tg_divisoes;

        $treinoAlunosPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'C')
        ->where('exe_membro', '=', 'peito')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'C')
            ->where('exe_membro', '=', 'peito')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhPeito)){
                $treinoAlunosPeito = null;
            }

        $treinoAlunosCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'C')
        ->where('exe_membro', '=', 'costas')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'C')
            ->where('exe_membro', '=', 'costas')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhCostas)){
                $treinoAlunosCostas = null;
            }

        $treinoAlunosBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'C')
        ->where('exe_membro', '=', 'biceps')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'C')
            ->where('exe_membro', '=', 'biceps')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhBiceps)){
                $treinoAlunosBiceps = null;
            }

        $treinoAlunosTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'C')
        ->where('exe_membro', '=', 'triceps')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'C')
            ->where('exe_membro', '=', 'triceps')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhTriceps)){
                $treinoAlunosTriceps = null;
            }

        $treinoAlunosAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'C')
        ->where('exe_membro', '=', 'antebraco')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'C')
            ->where('exe_membro', '=', 'antebraco')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhAntebraco)){
                $treinoAlunosAntebraco = null;
            }

        $treinoAlunosOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'C')
        ->where('exe_membro', '=', 'ombro')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'C')
            ->where('exe_membro', '=', 'ombro')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhOmbro)){
                $treinoAlunosOmbro = null;
            }

        $treinoAlunosTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'C')
        ->where('exe_membro', '=', 'trapezio')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'C')
            ->where('exe_membro', '=', 'trapezio')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhTrapezio)){
                $treinoAlunosTrapezio = null;
            }

        $treinoAlunosInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'C')
        ->where('exe_membro', '=', 'inferior')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'C')
            ->where('exe_membro', '=', 'inferior')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhInferior)){
                $treinoAlunosInferior = null;
            }

        $treinoAlunosLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'C')
        ->where('exe_membro', '=', 'lombar')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'C')
            ->where('exe_membro', '=', 'lombar')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhLombar)){
                $treinoAlunosLombar = null;
            }

        $treinoAlunosAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'C')
        ->where('exe_membro', '=', 'abdomen')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'C')
            ->where('exe_membro', '=', 'abdomen')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhAbdomen)){
                $treinoAlunosAbdomen = null;
            }

    return PDF::loadView('aluno.viewsTreino.baixarTreino.PDFtreinoDivisaoC', [
        'treinoGeralDivisoes' => $treinoGeralDivisoes,
        'treinoAlunosPeito' => $treinoAlunosPeito,
        'treinoAlunosCostas' => $treinoAlunosCostas,
        'treinoAlunosBiceps' => $treinoAlunosBiceps,
        'treinoAlunosTriceps' => $treinoAlunosTriceps,
        'treinoAlunosAntebraco' => $treinoAlunosAntebraco,
        'treinoAlunosOmbro' => $treinoAlunosOmbro,
        'treinoAlunosTrapezio' => $treinoAlunosTrapezio,
        'treinoAlunosInferior' => $treinoAlunosInferior,
        'treinoAlunosLombar' => $treinoAlunosLombar,
        'treinoAlunosAbdomen' => $treinoAlunosAbdomen,
    ])
                    ->setPaper('a4', 'landscape')
                //->download('treino.pdf');
                ->stream(); //EXCLUIR DPS DE FINALIZAR A TELA DE DOWNLOAD
    }

    public function PDFTreinoDivisoesD()
    {
        $authUser = auth::user();
        $authAluID = $authUser->alu_id;
        $aluno = Aluno::where('id', '=', $authAluID)->first();
        $treinoGeralAluno = TreinoGeral::where('alu_id', '=', $aluno->id)->first();
        $treinoGeralDivisoes = $treinoGeralAluno->tg_divisoes;

        $treinoAlunosPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'D')
        ->where('exe_membro', '=', 'peito')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'D')
            ->where('exe_membro', '=', 'peito')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhPeito)){
                $treinoAlunosPeito = null;
            }

        $treinoAlunosCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'D')
        ->where('exe_membro', '=', 'costas')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'D')
            ->where('exe_membro', '=', 'costas')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhCostas)){
                $treinoAlunosCostas = null;
            }

        $treinoAlunosBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'D')
        ->where('exe_membro', '=', 'biceps')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'D')
            ->where('exe_membro', '=', 'biceps')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhBiceps)){
                $treinoAlunosBiceps = null;
            }

        $treinoAlunosTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'D')
        ->where('exe_membro', '=', 'triceps')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'D')
            ->where('exe_membro', '=', 'triceps')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhTriceps)){
                $treinoAlunosTriceps = null;
            }

        $treinoAlunosAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'D')
        ->where('exe_membro', '=', 'antebraco')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'D')
            ->where('exe_membro', '=', 'antebraco')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhAntebraco)){
                $treinoAlunosAntebraco = null;
            }

        $treinoAlunosOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'D')
        ->where('exe_membro', '=', 'ombro')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'D')
            ->where('exe_membro', '=', 'ombro')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhOmbro)){
                $treinoAlunosOmbro = null;
            }

        $treinoAlunosTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'D')
        ->where('exe_membro', '=', 'trapezio')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'D')
            ->where('exe_membro', '=', 'trapezio')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhTrapezio)){
                $treinoAlunosTrapezio = null;
            }

        $treinoAlunosInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'D')
        ->where('exe_membro', '=', 'inferior')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'D')
            ->where('exe_membro', '=', 'inferior')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhInferior)){
                $treinoAlunosInferior = null;
            }

        $treinoAlunosLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'D')
        ->where('exe_membro', '=', 'lombar')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'D')
            ->where('exe_membro', '=', 'lombar')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhLombar)){
                $treinoAlunosLombar = null;
            }

        $treinoAlunosAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'D')
        ->where('exe_membro', '=', 'abdomen')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'D')
            ->where('exe_membro', '=', 'abdomen')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhAbdomen)){
                $treinoAlunosAbdomen = null;
            }

    return PDF::loadView('aluno.viewsTreino.baixarTreino.PDFtreinoDivisaoD', [
        'treinoGeralDivisoes' => $treinoGeralDivisoes,
        'treinoAlunosPeito' => $treinoAlunosPeito,
        'treinoAlunosCostas' => $treinoAlunosCostas,
        'treinoAlunosBiceps' => $treinoAlunosBiceps,
        'treinoAlunosTriceps' => $treinoAlunosTriceps,
        'treinoAlunosAntebraco' => $treinoAlunosAntebraco,
        'treinoAlunosOmbro' => $treinoAlunosOmbro,
        'treinoAlunosTrapezio' => $treinoAlunosTrapezio,
        'treinoAlunosInferior' => $treinoAlunosInferior,
        'treinoAlunosLombar' => $treinoAlunosLombar,
        'treinoAlunosAbdomen' => $treinoAlunosAbdomen,
    ])
                    ->setPaper('a4', 'landscape')
                //->download('treino.pdf');
                ->stream(); //EXCLUIR DPS DE FINALIZAR A TELA DE DOWNLOAD
    }

        public function PDFTreinoDivisoesE()
    {
        $authUser = auth::user();
        $authAluID = $authUser->alu_id;
        $aluno = Aluno::where('id', '=', $authAluID)->first();
        $treinoGeralAluno = TreinoGeral::where('alu_id', '=', $aluno->id)->first();
        $treinoGeralDivisoes = $treinoGeralAluno->tg_divisoes;

        $treinoAlunosPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'E')
        ->where('exe_membro', '=', 'peito')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'E')
            ->where('exe_membro', '=', 'peito')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhPeito)){
                $treinoAlunosPeito = null;
            }

        $treinoAlunosCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'E')
        ->where('exe_membro', '=', 'costas')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'E')
            ->where('exe_membro', '=', 'costas')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhCostas)){
                $treinoAlunosCostas = null;
            }

        $treinoAlunosBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'E')
        ->where('exe_membro', '=', 'biceps')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'E')
            ->where('exe_membro', '=', 'biceps')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhBiceps)){
                $treinoAlunosBiceps = null;
            }

        $treinoAlunosTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'E')
        ->where('exe_membro', '=', 'triceps')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'E')
            ->where('exe_membro', '=', 'triceps')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhTriceps)){
                $treinoAlunosTriceps = null;
            }

        $treinoAlunosAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'E')
        ->where('exe_membro', '=', 'antebraco')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'E')
            ->where('exe_membro', '=', 'antebraco')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhAntebraco)){
                $treinoAlunosAntebraco = null;
            }

        $treinoAlunosOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'E')
        ->where('exe_membro', '=', 'ombro')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'E')
            ->where('exe_membro', '=', 'ombro')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhOmbro)){
                $treinoAlunosOmbro = null;
            }

        $treinoAlunosTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'E')
        ->where('exe_membro', '=', 'trapezio')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'E')
            ->where('exe_membro', '=', 'trapezio')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhTrapezio)){
                $treinoAlunosTrapezio = null;
            }

        $treinoAlunosInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'E')
        ->where('exe_membro', '=', 'inferior')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'E')
            ->where('exe_membro', '=', 'inferior')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhInferior)){
                $treinoAlunosInferior = null;
            }

        $treinoAlunosLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'E')
        ->where('exe_membro', '=', 'lombar')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'E')
            ->where('exe_membro', '=', 'lombar')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhLombar)){
                $treinoAlunosLombar = null;
            }

        $treinoAlunosAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'E')
        ->where('exe_membro', '=', 'abdomen')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'E')
            ->where('exe_membro', '=', 'abdomen')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhAbdomen)){
                $treinoAlunosAbdomen = null;
            }

    return PDF::loadView('aluno.viewsTreino.baixarTreino.PDFtreinoDivisaoE', [
        'treinoGeralDivisoes' => $treinoGeralDivisoes,
        'treinoAlunosPeito' => $treinoAlunosPeito,
        'treinoAlunosCostas' => $treinoAlunosCostas,
        'treinoAlunosBiceps' => $treinoAlunosBiceps,
        'treinoAlunosTriceps' => $treinoAlunosTriceps,
        'treinoAlunosAntebraco' => $treinoAlunosAntebraco,
        'treinoAlunosOmbro' => $treinoAlunosOmbro,
        'treinoAlunosTrapezio' => $treinoAlunosTrapezio,
        'treinoAlunosInferior' => $treinoAlunosInferior,
        'treinoAlunosLombar' => $treinoAlunosLombar,
        'treinoAlunosAbdomen' => $treinoAlunosAbdomen,
    ])
                    ->setPaper('a4', 'landscape')
                //->download('treino.pdf');
                ->stream(); //EXCLUIR DPS DE FINALIZAR A TELA DE DOWNLOAD
    }

        public function PDFTreinoDivisoesF()
    {
        $authUser = auth::user();
        $authAluID = $authUser->alu_id;
        $aluno = Aluno::where('id', '=', $authAluID)->first();
        $treinoGeralAluno = TreinoGeral::where('alu_id', '=', $aluno->id)->first();
        $treinoGeralDivisoes = $treinoGeralAluno->tg_divisoes;

        $treinoAlunosPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'F')
        ->where('exe_membro', '=', 'peito')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'F')
            ->where('exe_membro', '=', 'peito')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhPeito)){
                $treinoAlunosPeito = null;
            }

        $treinoAlunosCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'F')
        ->where('exe_membro', '=', 'costas')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'F')
            ->where('exe_membro', '=', 'costas')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhCostas)){
                $treinoAlunosCostas = null;
            }

        $treinoAlunosBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'F')
        ->where('exe_membro', '=', 'biceps')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'F')
            ->where('exe_membro', '=', 'biceps')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhBiceps)){
                $treinoAlunosBiceps = null;
            }

        $treinoAlunosTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'F')
        ->where('exe_membro', '=', 'triceps')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'F')
            ->where('exe_membro', '=', 'triceps')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhTriceps)){
                $treinoAlunosTriceps = null;
            }

        $treinoAlunosAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'F')
        ->where('exe_membro', '=', 'antebraco')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'F')
            ->where('exe_membro', '=', 'antebraco')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhAntebraco)){
                $treinoAlunosAntebraco = null;
            }

        $treinoAlunosOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'F')
        ->where('exe_membro', '=', 'ombro')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'F')
            ->where('exe_membro', '=', 'ombro')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhOmbro)){
                $treinoAlunosOmbro = null;
            }

        $treinoAlunosTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'F')
        ->where('exe_membro', '=', 'trapezio')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'F')
            ->where('exe_membro', '=', 'trapezio')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhTrapezio)){
                $treinoAlunosTrapezio = null;
            }

        $treinoAlunosInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'F')
        ->where('exe_membro', '=', 'inferior')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'F')
            ->where('exe_membro', '=', 'inferior')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhInferior)){
                $treinoAlunosInferior = null;
            }

        $treinoAlunosLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'F')
        ->where('exe_membro', '=', 'lombar')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'F')
            ->where('exe_membro', '=', 'lombar')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhLombar)){
                $treinoAlunosLombar = null;
            }

        $treinoAlunosAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'F')
        ->where('exe_membro', '=', 'abdomen')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'F')
            ->where('exe_membro', '=', 'abdomen')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhAbdomen)){
                $treinoAlunosAbdomen = null;
            }

    return PDF::loadView('aluno.viewsTreino.baixarTreino.PDFtreinoDivisaoF', [
        'treinoGeralDivisoes' => $treinoGeralDivisoes,
        'treinoAlunosPeito' => $treinoAlunosPeito,
        'treinoAlunosCostas' => $treinoAlunosCostas,
        'treinoAlunosBiceps' => $treinoAlunosBiceps,
        'treinoAlunosTriceps' => $treinoAlunosTriceps,
        'treinoAlunosAntebraco' => $treinoAlunosAntebraco,
        'treinoAlunosOmbro' => $treinoAlunosOmbro,
        'treinoAlunosTrapezio' => $treinoAlunosTrapezio,
        'treinoAlunosInferior' => $treinoAlunosInferior,
        'treinoAlunosLombar' => $treinoAlunosLombar,
        'treinoAlunosAbdomen' => $treinoAlunosAbdomen,
    ])
                    ->setPaper('a4', 'landscape')
                //->download('treino.pdf');
                ->stream(); //EXCLUIR DPS DE FINALIZAR A TELA DE DOWNLOAD
    }

    public function PDFTreinoDivisoesATreinador(TreinoGeral $treinoGeral)
    {
        $treinoGeralAluno = TreinoGeral::where('alu_id', '=', $treinoGeral->alu_id)->first();
        //dd($treinoGeralAluno);
        $treinoAlunosPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'A')
        ->where('exe_membro', '=', 'peito')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'A')
            ->where('exe_membro', '=', 'peito')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhPeito)){
                $treinoAlunosPeito = null;
            }

        $treinoAlunosCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'A')
        ->where('exe_membro', '=', 'costas')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'A')
            ->where('exe_membro', '=', 'costas')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhCostas)){
                $treinoAlunosCostas = null;
            }

        $treinoAlunosBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'A')
        ->where('exe_membro', '=', 'biceps')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'A')
            ->where('exe_membro', '=', 'biceps')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhBiceps)){
                $treinoAlunosBiceps = null;
            }

        $treinoAlunosTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'A')
        ->where('exe_membro', '=', 'triceps')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'A')
            ->where('exe_membro', '=', 'triceps')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhTriceps)){
                $treinoAlunosTriceps = null;
            }

        $treinoAlunosAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'A')
        ->where('exe_membro', '=', 'antebraco')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'A')
            ->where('exe_membro', '=', 'antebraco')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhAntebraco)){
                $treinoAlunosAntebraco = null;
            }

        $treinoAlunosOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'A')
        ->where('exe_membro', '=', 'ombro')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'A')
            ->where('exe_membro', '=', 'ombro')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhOmbro)){
                $treinoAlunosOmbro = null;
            }

        $treinoAlunosTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'A')
        ->where('exe_membro', '=', 'trapezio')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'A')
            ->where('exe_membro', '=', 'trapezio')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhTrapezio)){
                $treinoAlunosTrapezio = null;
            }

        $treinoAlunosInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'A')
        ->where('exe_membro', '=', 'inferior')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'A')
            ->where('exe_membro', '=', 'inferior')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhInferior)){
                $treinoAlunosInferior = null;
            }

        $treinoAlunosLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'A')
        ->where('exe_membro', '=', 'lombar')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'A')
            ->where('exe_membro', '=', 'lombar')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhLombar)){
                $treinoAlunosLombar = null;
            }

        $treinoAlunosAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'A')
        ->where('exe_membro', '=', 'abdomen')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'A')
            ->where('exe_membro', '=', 'abdomen')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhAbdomen)){
                $treinoAlunosAbdomen = null;
            }

    return PDF::loadView('aluno.viewsTreino.baixarTreino.PDFtreinoDivisaoA', [
        'treinoAlunosPeito' => $treinoAlunosPeito,
        'treinoAlunosCostas' => $treinoAlunosCostas,
        'treinoAlunosBiceps' => $treinoAlunosBiceps,
        'treinoAlunosTriceps' => $treinoAlunosTriceps,
        'treinoAlunosAntebraco' => $treinoAlunosAntebraco,
        'treinoAlunosOmbro' => $treinoAlunosOmbro,
        'treinoAlunosTrapezio' => $treinoAlunosTrapezio,
        'treinoAlunosInferior' => $treinoAlunosInferior,
        'treinoAlunosLombar' => $treinoAlunosLombar,
        'treinoAlunosAbdomen' => $treinoAlunosAbdomen,
    ])
                //->download('treino.pdf');
                ->stream(); //EXCLUIR DPS DE FINALIZAR A TELA DE DOWNLOAD
    }

    public function PDFTreinoDivisoesBTreinador(TreinoGeral $treinoGeral)
    {
        $treinoGeralAluno = TreinoGeral::where('alu_id', '=', $treinoGeral->alu_id)->first();
        //dd($treinoGeralAluno);
        $treinoAlunosPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'B')
        ->where('exe_membro', '=', 'peito')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'B')
            ->where('exe_membro', '=', 'peito')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhPeito)){
                $treinoAlunosPeito = null;
            }

        $treinoAlunosCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'B')
        ->where('exe_membro', '=', 'costas')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'B')
            ->where('exe_membro', '=', 'costas')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhCostas)){
                $treinoAlunosCostas = null;
            }

        $treinoAlunosBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'B')
        ->where('exe_membro', '=', 'biceps')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'B')
            ->where('exe_membro', '=', 'biceps')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhBiceps)){
                $treinoAlunosBiceps = null;
            }

        $treinoAlunosTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'B')
        ->where('exe_membro', '=', 'triceps')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'B')
            ->where('exe_membro', '=', 'triceps')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhTriceps)){
                $treinoAlunosTriceps = null;
            }

        $treinoAlunosAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'B')
        ->where('exe_membro', '=', 'antebraco')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'B')
            ->where('exe_membro', '=', 'antebraco')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhAntebraco)){
                $treinoAlunosAntebraco = null;
            }

        $treinoAlunosOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'B')
        ->where('exe_membro', '=', 'ombro')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'B')
            ->where('exe_membro', '=', 'ombro')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhOmbro)){
                $treinoAlunosOmbro = null;
            }

        $treinoAlunosTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'B')
        ->where('exe_membro', '=', 'trapezio')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'B')
            ->where('exe_membro', '=', 'trapezio')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhTrapezio)){
                $treinoAlunosTrapezio = null;
            }

        $treinoAlunosInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'B')
        ->where('exe_membro', '=', 'inferior')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'B')
            ->where('exe_membro', '=', 'inferior')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhInferior)){
                $treinoAlunosInferior = null;
            }

        $treinoAlunosLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'B')
        ->where('exe_membro', '=', 'lombar')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'B')
            ->where('exe_membro', '=', 'lombar')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhLombar)){
                $treinoAlunosLombar = null;
            }

        $treinoAlunosAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'B')
        ->where('exe_membro', '=', 'abdomen')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'B')
            ->where('exe_membro', '=', 'abdomen')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhAbdomen)){
                $treinoAlunosAbdomen = null;
            }

    return PDF::loadView('aluno.viewsTreino.baixarTreino.PDFtreinoDivisaoB', [
        'treinoAlunosPeito' => $treinoAlunosPeito,
        'treinoAlunosCostas' => $treinoAlunosCostas,
        'treinoAlunosBiceps' => $treinoAlunosBiceps,
        'treinoAlunosTriceps' => $treinoAlunosTriceps,
        'treinoAlunosAntebraco' => $treinoAlunosAntebraco,
        'treinoAlunosOmbro' => $treinoAlunosOmbro,
        'treinoAlunosTrapezio' => $treinoAlunosTrapezio,
        'treinoAlunosInferior' => $treinoAlunosInferior,
        'treinoAlunosLombar' => $treinoAlunosLombar,
        'treinoAlunosAbdomen' => $treinoAlunosAbdomen,
    ])
                //->download('treino.pdf');
                ->stream(); //EXCLUIR DPS DE FINALIZAR A TELA DE DOWNLOAD
    }

    public function PDFTreinoDivisoesCTreinador(TreinoGeral $treinoGeral)
    {
        $treinoGeralAluno = TreinoGeral::where('alu_id', '=', $treinoGeral->alu_id)->first();
        //dd($treinoGeralAluno);
        $treinoAlunosPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'C')
        ->where('exe_membro', '=', 'peito')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'C')
            ->where('exe_membro', '=', 'peito')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhPeito)){
                $treinoAlunosPeito = null;
            }

        $treinoAlunosCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'C')
        ->where('exe_membro', '=', 'costas')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'C')
            ->where('exe_membro', '=', 'costas')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhCostas)){
                $treinoAlunosCostas = null;
            }

        $treinoAlunosBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'C')
        ->where('exe_membro', '=', 'biceps')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'C')
            ->where('exe_membro', '=', 'biceps')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhBiceps)){
                $treinoAlunosBiceps = null;
            }

        $treinoAlunosTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'C')
        ->where('exe_membro', '=', 'triceps')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'C')
            ->where('exe_membro', '=', 'triceps')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhTriceps)){
                $treinoAlunosTriceps = null;
            }

        $treinoAlunosAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'C')
        ->where('exe_membro', '=', 'antebraco')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'C')
            ->where('exe_membro', '=', 'antebraco')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhAntebraco)){
                $treinoAlunosAntebraco = null;
            }

        $treinoAlunosOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'C')
        ->where('exe_membro', '=', 'ombro')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'C')
            ->where('exe_membro', '=', 'ombro')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhOmbro)){
                $treinoAlunosOmbro = null;
            }

        $treinoAlunosTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'C')
        ->where('exe_membro', '=', 'trapezio')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'C')
            ->where('exe_membro', '=', 'trapezio')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhTrapezio)){
                $treinoAlunosTrapezio = null;
            }

        $treinoAlunosInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'C')
        ->where('exe_membro', '=', 'inferior')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'C')
            ->where('exe_membro', '=', 'inferior')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhInferior)){
                $treinoAlunosInferior = null;
            }

        $treinoAlunosLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'C')
        ->where('exe_membro', '=', 'lombar')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'C')
            ->where('exe_membro', '=', 'lombar')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhLombar)){
                $treinoAlunosLombar = null;
            }

        $treinoAlunosAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'C')
        ->where('exe_membro', '=', 'abdomen')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'C')
            ->where('exe_membro', '=', 'abdomen')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhAbdomen)){
                $treinoAlunosAbdomen = null;
            }

    return PDF::loadView('aluno.viewsTreino.baixarTreino.PDFtreinoDivisaoC', [
        'treinoAlunosPeito' => $treinoAlunosPeito,
        'treinoAlunosCostas' => $treinoAlunosCostas,
        'treinoAlunosBiceps' => $treinoAlunosBiceps,
        'treinoAlunosTriceps' => $treinoAlunosTriceps,
        'treinoAlunosAntebraco' => $treinoAlunosAntebraco,
        'treinoAlunosOmbro' => $treinoAlunosOmbro,
        'treinoAlunosTrapezio' => $treinoAlunosTrapezio,
        'treinoAlunosInferior' => $treinoAlunosInferior,
        'treinoAlunosLombar' => $treinoAlunosLombar,
        'treinoAlunosAbdomen' => $treinoAlunosAbdomen,
    ])
                //->download('treino.pdf');
                ->stream(); //EXCLUIR DPS DE FINALIZAR A TELA DE DOWNLOAD
    }

    public function PDFTreinoDivisoesDTreinador(TreinoGeral $treinoGeral)
    {
        $treinoGeralAluno = TreinoGeral::where('alu_id', '=', $treinoGeral->alu_id)->first();
        //dd($treinoGeralAluno);
        $treinoAlunosPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'D')
        ->where('exe_membro', '=', 'peito')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'D')
            ->where('exe_membro', '=', 'peito')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhPeito)){
                $treinoAlunosPeito = null;
            }

        $treinoAlunosCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'D')
        ->where('exe_membro', '=', 'costas')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'D')
            ->where('exe_membro', '=', 'costas')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhCostas)){
                $treinoAlunosCostas = null;
            }

        $treinoAlunosBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'D')
        ->where('exe_membro', '=', 'biceps')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'D')
            ->where('exe_membro', '=', 'biceps')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhBiceps)){
                $treinoAlunosBiceps = null;
            }

        $treinoAlunosTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'D')
        ->where('exe_membro', '=', 'triceps')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'D')
            ->where('exe_membro', '=', 'triceps')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhTriceps)){
                $treinoAlunosTriceps = null;
            }

        $treinoAlunosAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'D')
        ->where('exe_membro', '=', 'antebraco')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'D')
            ->where('exe_membro', '=', 'antebraco')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhAntebraco)){
                $treinoAlunosAntebraco = null;
            }

        $treinoAlunosOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'D')
        ->where('exe_membro', '=', 'ombro')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'D')
            ->where('exe_membro', '=', 'ombro')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhOmbro)){
                $treinoAlunosOmbro = null;
            }

        $treinoAlunosTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'D')
        ->where('exe_membro', '=', 'trapezio')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'D')
            ->where('exe_membro', '=', 'trapezio')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhTrapezio)){
                $treinoAlunosTrapezio = null;
            }

        $treinoAlunosInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'D')
        ->where('exe_membro', '=', 'inferior')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'D')
            ->where('exe_membro', '=', 'inferior')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhInferior)){
                $treinoAlunosInferior = null;
            }

        $treinoAlunosLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'D')
        ->where('exe_membro', '=', 'lombar')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'D')
            ->where('exe_membro', '=', 'lombar')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhLombar)){
                $treinoAlunosLombar = null;
            }

        $treinoAlunosAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'D')
        ->where('exe_membro', '=', 'abdomen')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'D')
            ->where('exe_membro', '=', 'abdomen')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhAbdomen)){
                $treinoAlunosAbdomen = null;
            }

    return PDF::loadView('aluno.viewsTreino.baixarTreino.PDFtreinoDivisaoD', [
        'treinoAlunosPeito' => $treinoAlunosPeito,
        'treinoAlunosCostas' => $treinoAlunosCostas,
        'treinoAlunosBiceps' => $treinoAlunosBiceps,
        'treinoAlunosTriceps' => $treinoAlunosTriceps,
        'treinoAlunosAntebraco' => $treinoAlunosAntebraco,
        'treinoAlunosOmbro' => $treinoAlunosOmbro,
        'treinoAlunosTrapezio' => $treinoAlunosTrapezio,
        'treinoAlunosInferior' => $treinoAlunosInferior,
        'treinoAlunosLombar' => $treinoAlunosLombar,
        'treinoAlunosAbdomen' => $treinoAlunosAbdomen,
    ])
                //->download('treino.pdf');
                ->stream(); //EXCLUIR DPS DE FINALIZAR A TELA DE DOWNLOAD
    }

    public function PDFTreinoDivisoesETreinador(TreinoGeral $treinoGeral)
    {
        $treinoGeralAluno = TreinoGeral::where('alu_id', '=', $treinoGeral->alu_id)->first();
        //dd($treinoGeralAluno);
        $treinoAlunosPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'E')
        ->where('exe_membro', '=', 'peito')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'E')
            ->where('exe_membro', '=', 'peito')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhPeito)){
                $treinoAlunosPeito = null;
            }

        $treinoAlunosCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'E')
        ->where('exe_membro', '=', 'costas')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'E')
            ->where('exe_membro', '=', 'costas')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhCostas)){
                $treinoAlunosCostas = null;
            }

        $treinoAlunosBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'E')
        ->where('exe_membro', '=', 'biceps')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'E')
            ->where('exe_membro', '=', 'biceps')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhBiceps)){
                $treinoAlunosBiceps = null;
            }

        $treinoAlunosTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'E')
        ->where('exe_membro', '=', 'triceps')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'E')
            ->where('exe_membro', '=', 'triceps')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhTriceps)){
                $treinoAlunosTriceps = null;
            }

        $treinoAlunosAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'E')
        ->where('exe_membro', '=', 'antebraco')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'E')
            ->where('exe_membro', '=', 'antebraco')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhAntebraco)){
                $treinoAlunosAntebraco = null;
            }

        $treinoAlunosOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'E')
        ->where('exe_membro', '=', 'ombro')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'E')
            ->where('exe_membro', '=', 'ombro')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhOmbro)){
                $treinoAlunosOmbro = null;
            }

        $treinoAlunosTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'E')
        ->where('exe_membro', '=', 'trapezio')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'E')
            ->where('exe_membro', '=', 'trapezio')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhTrapezio)){
                $treinoAlunosTrapezio = null;
            }

        $treinoAlunosInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'E')
        ->where('exe_membro', '=', 'inferior')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'E')
            ->where('exe_membro', '=', 'inferior')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhInferior)){
                $treinoAlunosInferior = null;
            }

        $treinoAlunosLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'E')
        ->where('exe_membro', '=', 'lombar')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'E')
            ->where('exe_membro', '=', 'lombar')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhLombar)){
                $treinoAlunosLombar = null;
            }

        $treinoAlunosAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'E')
        ->where('exe_membro', '=', 'abdomen')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'E')
            ->where('exe_membro', '=', 'abdomen')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhAbdomen)){
                $treinoAlunosAbdomen = null;
            }

    return PDF::loadView('aluno.viewsTreino.baixarTreino.PDFtreinoDivisaoE', [
        'treinoAlunosPeito' => $treinoAlunosPeito,
        'treinoAlunosCostas' => $treinoAlunosCostas,
        'treinoAlunosBiceps' => $treinoAlunosBiceps,
        'treinoAlunosTriceps' => $treinoAlunosTriceps,
        'treinoAlunosAntebraco' => $treinoAlunosAntebraco,
        'treinoAlunosOmbro' => $treinoAlunosOmbro,
        'treinoAlunosTrapezio' => $treinoAlunosTrapezio,
        'treinoAlunosInferior' => $treinoAlunosInferior,
        'treinoAlunosLombar' => $treinoAlunosLombar,
        'treinoAlunosAbdomen' => $treinoAlunosAbdomen,
    ])
                //->download('treino.pdf');
                ->stream(); //EXCLUIR DPS DE FINALIZAR A TELA DE DOWNLOAD
    }

    public function PDFTreinoDivisoesFTreinador(TreinoGeral $treinoGeral)
    {
        $treinoGeralAluno = TreinoGeral::where('alu_id', '=', $treinoGeral->alu_id)->first();
        //dd($treinoGeralAluno);
        $treinoAlunosPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'F')
        ->where('exe_membro', '=', 'peito')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'F')
            ->where('exe_membro', '=', 'peito')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhPeito)){
                $treinoAlunosPeito = null;
            }

        $treinoAlunosCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'F')
        ->where('exe_membro', '=', 'costas')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'F')
            ->where('exe_membro', '=', 'costas')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhCostas)){
                $treinoAlunosCostas = null;
            }

        $treinoAlunosBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'F')
        ->where('exe_membro', '=', 'biceps')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'F')
            ->where('exe_membro', '=', 'biceps')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhBiceps)){
                $treinoAlunosBiceps = null;
            }

        $treinoAlunosTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'F')
        ->where('exe_membro', '=', 'triceps')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'F')
            ->where('exe_membro', '=', 'triceps')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhTriceps)){
                $treinoAlunosTriceps = null;
            }

        $treinoAlunosAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'F')
        ->where('exe_membro', '=', 'antebraco')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'F')
            ->where('exe_membro', '=', 'antebraco')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhAntebraco)){
                $treinoAlunosAntebraco = null;
            }

        $treinoAlunosOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'F')
        ->where('exe_membro', '=', 'ombro')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'F')
            ->where('exe_membro', '=', 'ombro')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhOmbro)){
                $treinoAlunosOmbro = null;
            }

        $treinoAlunosTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'F')
        ->where('exe_membro', '=', 'trapezio')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'F')
            ->where('exe_membro', '=', 'trapezio')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhTrapezio)){
                $treinoAlunosTrapezio = null;
            }

        $treinoAlunosInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'F')
        ->where('exe_membro', '=', 'inferior')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'F')
            ->where('exe_membro', '=', 'inferior')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhInferior)){
                $treinoAlunosInferior = null;
            }

        $treinoAlunosLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'F')
        ->where('exe_membro', '=', 'lombar')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'F')
            ->where('exe_membro', '=', 'lombar')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhLombar)){
                $treinoAlunosLombar = null;
            }

        $treinoAlunosAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
        ->where('td_divisao', '=', 'F')
        ->where('exe_membro', '=', 'abdomen')
        ->where('tg_id', '=', $treinoGeralAluno->id)
        ->orderBy('td_numero', 'ASC')
        ->get();
            $verificarSeEhAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
            ->where('td_divisao', '=', 'F')
            ->where('exe_membro', '=', 'abdomen')
            ->where('tg_id', '=', $treinoGeralAluno->id)
            ->first();
            if(empty($verificarSeEhAbdomen)){
                $treinoAlunosAbdomen = null;
            }

    return PDF::loadView('aluno.viewsTreino.baixarTreino.PDFtreinoDivisaoF', [
        'treinoAlunosPeito' => $treinoAlunosPeito,
        'treinoAlunosCostas' => $treinoAlunosCostas,
        'treinoAlunosBiceps' => $treinoAlunosBiceps,
        'treinoAlunosTriceps' => $treinoAlunosTriceps,
        'treinoAlunosAntebraco' => $treinoAlunosAntebraco,
        'treinoAlunosOmbro' => $treinoAlunosOmbro,
        'treinoAlunosTrapezio' => $treinoAlunosTrapezio,
        'treinoAlunosInferior' => $treinoAlunosInferior,
        'treinoAlunosLombar' => $treinoAlunosLombar,
        'treinoAlunosAbdomen' => $treinoAlunosAbdomen,
    ])
                //->download('treino.pdf');
                ->stream(); //EXCLUIR DPS DE FINALIZAR A TELA DE DOWNLOAD
    }

    public function conclusaoTreinoA()
    {
        $authUser = auth::user();
        $authAluID = $authUser->alu_id;
        $aluno = Aluno::where('id', '=', $authAluID)->first();
        $treinoGeralAluno = TreinoGeral::where('alu_id', '=', $aluno->id)->first();
        $treinoGeralDivisoes = $treinoGeralAluno->tg_divisoes;

        $historicoTreino = new historicoTreino();
        $historicoTreino->alu_id = $authAluID;
        $historicoTreino->tg_id = $treinoGeralAluno->id;
        $historicoTreino->ht_divisao = "A";
        $historicoTreino->ht_data_concluido = Carbon::today();
        $historicoTreino->save();

        return redirect()->route('aluno.PDFTreinoDivisoes')
        ->with('success','Concluído com sucesso!');

    }

    public function conclusaoTreinoB()
    {
        $authUser = auth::user();
        $authAluID = $authUser->alu_id;
        $aluno = Aluno::where('id', '=', $authAluID)->first();
        $treinoGeralAluno = TreinoGeral::where('alu_id', '=', $aluno->id)->first();
        $treinoGeralDivisoes = $treinoGeralAluno->tg_divisoes;

        $historicoTreino = new historicoTreino();
        $historicoTreino->alu_id = $authAluID;
        $historicoTreino->tg_id = $treinoGeralAluno->id;
        $historicoTreino->ht_divisao = "B";
        $historicoTreino->ht_data_concluido = Carbon::today();
        $historicoTreino->save();

        return redirect()->route('aluno.PDFTreinoDivisoes')
        ->with('success','Concluído com sucesso!');

    }

    public function conclusaoTreinoC()
    {
        $authUser = auth::user();
        $authAluID = $authUser->alu_id;
        $aluno = Aluno::where('id', '=', $authAluID)->first();
        $treinoGeralAluno = TreinoGeral::where('alu_id', '=', $aluno->id)->first();
        $treinoGeralDivisoes = $treinoGeralAluno->tg_divisoes;

        $historicoTreino = new historicoTreino();
        $historicoTreino->alu_id = $authAluID;
        $historicoTreino->tg_id = $treinoGeralAluno->id;
        $historicoTreino->ht_divisao = "C";
        $historicoTreino->ht_data_concluido = Carbon::today();
        $historicoTreino->save();

        return redirect()->route('aluno.PDFTreinoDivisoes')
        ->with('success','Concluído com sucesso!');

    }

    public function conclusaoTreinoD()
    {
        $authUser = auth::user();
        $authAluID = $authUser->alu_id;
        $aluno = Aluno::where('id', '=', $authAluID)->first();
        $treinoGeralAluno = TreinoGeral::where('alu_id', '=', $aluno->id)->first();
        $treinoGeralDivisoes = $treinoGeralAluno->tg_divisoes;

        $historicoTreino = new historicoTreino();
        $historicoTreino->alu_id = $authAluID;
        $historicoTreino->tg_id = $treinoGeralAluno->id;
        $historicoTreino->ht_divisao = "D";
        $historicoTreino->ht_data_concluido = Carbon::today();
        $historicoTreino->save();

        return redirect()->route('aluno.PDFTreinoDivisoes')
        ->with('success','Concluído com sucesso!');

    }

    public function conclusaoTreinoE()
    {
        $authUser = auth::user();
        $authAluID = $authUser->alu_id;
        $aluno = Aluno::where('id', '=', $authAluID)->first();
        $treinoGeralAluno = TreinoGeral::where('alu_id', '=', $aluno->id)->first();
        $treinoGeralDivisoes = $treinoGeralAluno->tg_divisoes;

        $historicoTreino = new historicoTreino();
        $historicoTreino->alu_id = $authAluID;
        $historicoTreino->tg_id = $treinoGeralAluno->id;
        $historicoTreino->ht_divisao = "E";
        $historicoTreino->ht_data_concluido = Carbon::today();
        $historicoTreino->save();

        return redirect()->route('aluno.PDFTreinoDivisoes')
        ->with('success','Concluído com sucesso!');

    }

    public function conclusaoTreinoF()
    {
        $authUser = auth::user();
        $authAluID = $authUser->alu_id;
        $aluno = Aluno::where('id', '=', $authAluID)->first();
        $treinoGeralAluno = TreinoGeral::where('alu_id', '=', $aluno->id)->first();
        $treinoGeralDivisoes = $treinoGeralAluno->tg_divisoes;

        $historicoTreino = new historicoTreino();
        $historicoTreino->alu_id = $authAluID;
        $historicoTreino->tg_id = $treinoGeralAluno->id;
        $historicoTreino->ht_divisao = "F";
        $historicoTreino->ht_data_concluido = Carbon::today();
        $historicoTreino->save();

        return redirect()->route('aluno.PDFTreinoDivisoes')
        ->with('success','Concluído com sucesso!');

    }

    public function limparHistorico()
    {
        $authUser = auth::user();
        $authAluID = $authUser->alu_id;
        $aluno = Aluno::where('id', '=', $authAluID)->first();
        $treinoGeralAluno = TreinoGeral::where('alu_id', '=', $aluno->id)->first();
        $treinoGeralDivisoes = $treinoGeralAluno->tg_divisoes;

        $historicoTreino = historicoTreino::where('tg_id', '=', $treinoGeralAluno->id)->get();
        $historicoTreino->each->delete();

        return redirect()->route('aluno.treino')
        ->with('success','Histórico limpo com sucesso!');

    }

    public function ImprimirTreino()
    {
        $authUser = auth::user();
        $authAluID = $authUser->alu_id;
        $aluno = Aluno::where('id', '=', $authAluID)->first();
        $treinoGeralAluno = TreinoGeral::where('alu_id', '=', $aluno->id)->first();
        $treinoGeralAlunoProfessorID = $treinoGeralAluno->per_id;
        $treinoGeralAlunoProfessorQuery = Personal::where('id', $treinoGeralAlunoProfessorID)->first();
        $treinoGeralAlunoProfessor = $treinoGeralAlunoProfessorQuery->per_nome;
        $treinoGeralDivisoes = $treinoGeralAluno->tg_divisoes;

        $historicoTreino = historicoTreino::where('tg_id', '=', $treinoGeralAluno->id)->orderBy('created_at', 'desc')->first();

        if (empty($historicoTreino)){
            return redirect()->route('aluno.treino')
            ->with('error','Não foi concluído nenhum treino ainda!');
        } else {
            $historicoTreino = $historicoTreino->ht_divisao;
            if ($treinoGeralDivisoes === 'A'){
                if($historicoTreino === 'A'){
                    $historicoTreino = new historicoTreino();
                    $historicoTreino->alu_id = $authAluID;
                    $historicoTreino->tg_id = $treinoGeralAluno->id;
                    $historicoTreino->ht_divisao = "A";
                    $historicoTreino->ht_data_concluido = Carbon::today();
                    $historicoTreino->save();

                    $treinoAlunosPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'peito')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'peito')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhPeito)){
                            $treinoAlunosPeito = null;
                        }

                    $treinoAlunosCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'costas')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'costas')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhCostas)){
                            $treinoAlunosCostas = null;
                        }

                    $treinoAlunosBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'biceps')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'biceps')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhBiceps)){
                            $treinoAlunosBiceps = null;
                        }

                    $treinoAlunosTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'triceps')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'triceps')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhTriceps)){
                            $treinoAlunosTriceps = null;
                        }

                    $treinoAlunosAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'antebraco')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'antebraco')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhAntebraco)){
                            $treinoAlunosAntebraco = null;
                        }

                    $treinoAlunosOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'ombro')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'ombro')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhOmbro)){
                            $treinoAlunosOmbro = null;
                        }

                    $treinoAlunosTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'trapezio')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'trapezio')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhTrapezio)){
                            $treinoAlunosTrapezio = null;
                        }

                    $treinoAlunosInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'inferior')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'inferior')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhInferior)){
                            $treinoAlunosInferior = null;
                        }

                    $treinoAlunosLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'lombar')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'lombar')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhLombar)){
                            $treinoAlunosLombar = null;
                        }

                    $treinoAlunosAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'abdomen')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'abdomen')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhAbdomen)){
                            $treinoAlunosAbdomen = null;
                        }

                return PDF::loadView('aluno.viewsTreino.imprimirTreino.imprimirTreinoA', [
                    'treinoGeralAlunoProfessor' => $treinoGeralAlunoProfessor,
                    'treinoGeralDivisoes' => $treinoGeralDivisoes,
                    'treinoAlunosPeito' => $treinoAlunosPeito,
                    'treinoAlunosCostas' => $treinoAlunosCostas,
                    'treinoAlunosBiceps' => $treinoAlunosBiceps,
                    'treinoAlunosTriceps' => $treinoAlunosTriceps,
                    'treinoAlunosAntebraco' => $treinoAlunosAntebraco,
                    'treinoAlunosOmbro' => $treinoAlunosOmbro,
                    'treinoAlunosTrapezio' => $treinoAlunosTrapezio,
                    'treinoAlunosInferior' => $treinoAlunosInferior,
                    'treinoAlunosLombar' => $treinoAlunosLombar,
                    'treinoAlunosAbdomen' => $treinoAlunosAbdomen,
                ])
                                ->setPaper('a4', 'landscape')
                            //->download('treino.pdf');
                            ->stream(); //EXCLUIR DPS DE FINALIZAR A TELA DE DOWNLOAD
                }
            }
            if ($treinoGeralDivisoes === 'AB'){
                if ($historicoTreino === 'A') {

                    $historicoTreino = new historicoTreino();
                    $historicoTreino->alu_id = $authAluID;
                    $historicoTreino->tg_id = $treinoGeralAluno->id;
                    $historicoTreino->ht_divisao = "B";
                    $historicoTreino->ht_data_concluido = Carbon::today();
                    $historicoTreino->save();

                    $treinoAlunosPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'peito')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'peito')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhPeito)){
                            $treinoAlunosPeito = null;
                        }

                    $treinoAlunosCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'costas')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'costas')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhCostas)){
                            $treinoAlunosCostas = null;
                        }

                    $treinoAlunosBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'biceps')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'biceps')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhBiceps)){
                            $treinoAlunosBiceps = null;
                        }

                    $treinoAlunosTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'triceps')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'triceps')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhTriceps)){
                            $treinoAlunosTriceps = null;
                        }

                    $treinoAlunosAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'antebraco')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'antebraco')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhAntebraco)){
                            $treinoAlunosAntebraco = null;
                        }

                    $treinoAlunosOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'ombro')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'ombro')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhOmbro)){
                            $treinoAlunosOmbro = null;
                        }

                    $treinoAlunosTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'trapezio')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'trapezio')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhTrapezio)){
                            $treinoAlunosTrapezio = null;
                        }

                    $treinoAlunosInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'inferior')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'inferior')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhInferior)){
                            $treinoAlunosInferior = null;
                        }

                    $treinoAlunosLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'lombar')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'lombar')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhLombar)){
                            $treinoAlunosLombar = null;
                        }

                    $treinoAlunosAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'abdomen')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'abdomen')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhAbdomen)){
                            $treinoAlunosAbdomen = null;
                        }

                return PDF::loadView('aluno.viewsTreino.ImprimirTreino.imprimirTreinoB', [
                    'treinoGeralAlunoProfessor' => $treinoGeralAlunoProfessor,
                    'treinoGeralDivisoes' => $treinoGeralDivisoes,
                    'treinoAlunosPeito' => $treinoAlunosPeito,
                    'treinoAlunosCostas' => $treinoAlunosCostas,
                    'treinoAlunosBiceps' => $treinoAlunosBiceps,
                    'treinoAlunosTriceps' => $treinoAlunosTriceps,
                    'treinoAlunosAntebraco' => $treinoAlunosAntebraco,
                    'treinoAlunosOmbro' => $treinoAlunosOmbro,
                    'treinoAlunosTrapezio' => $treinoAlunosTrapezio,
                    'treinoAlunosInferior' => $treinoAlunosInferior,
                    'treinoAlunosLombar' => $treinoAlunosLombar,
                    'treinoAlunosAbdomen' => $treinoAlunosAbdomen,
                ])
                            ->setPaper([0, 0, 807.874, 221.102], 'landscape')
                            //->download('treino.pdf');
                            ->stream(); //EXCLUIR DPS DE FINALIZAR A TELA DE DOWNLOAD
                }
                if ($historicoTreino === 'B') {

                    $historicoTreino = new historicoTreino();
                    $historicoTreino->alu_id = $authAluID;
                    $historicoTreino->tg_id = $treinoGeralAluno->id;
                    $historicoTreino->ht_divisao = "A";
                    $historicoTreino->ht_data_concluido = Carbon::today();
                    $historicoTreino->save();

                    $treinoAlunosPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'peito')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'peito')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhPeito)){
                            $treinoAlunosPeito = null;
                        }

                    $treinoAlunosCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'costas')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'costas')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhCostas)){
                            $treinoAlunosCostas = null;
                        }

                    $treinoAlunosBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'biceps')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'biceps')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhBiceps)){
                            $treinoAlunosBiceps = null;
                        }

                    $treinoAlunosTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'triceps')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'triceps')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhTriceps)){
                            $treinoAlunosTriceps = null;
                        }

                    $treinoAlunosAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'antebraco')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'antebraco')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhAntebraco)){
                            $treinoAlunosAntebraco = null;
                        }

                    $treinoAlunosOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'ombro')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'ombro')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhOmbro)){
                            $treinoAlunosOmbro = null;
                        }

                    $treinoAlunosTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'trapezio')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'trapezio')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhTrapezio)){
                            $treinoAlunosTrapezio = null;
                        }

                    $treinoAlunosInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'inferior')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'inferior')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhInferior)){
                            $treinoAlunosInferior = null;
                        }

                    $treinoAlunosLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'lombar')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'lombar')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhLombar)){
                            $treinoAlunosLombar = null;
                        }

                    $treinoAlunosAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'abdomen')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'abdomen')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhAbdomen)){
                            $treinoAlunosAbdomen = null;
                        }

                return PDF::loadView('aluno.viewsTreino.imprimirTreino.imprimirTreinoA', [
                    'treinoGeralAlunoProfessor' => $treinoGeralAlunoProfessor,
                    'treinoGeralDivisoes' => $treinoGeralDivisoes,
                    'treinoAlunosPeito' => $treinoAlunosPeito,
                    'treinoAlunosCostas' => $treinoAlunosCostas,
                    'treinoAlunosBiceps' => $treinoAlunosBiceps,
                    'treinoAlunosTriceps' => $treinoAlunosTriceps,
                    'treinoAlunosAntebraco' => $treinoAlunosAntebraco,
                    'treinoAlunosOmbro' => $treinoAlunosOmbro,
                    'treinoAlunosTrapezio' => $treinoAlunosTrapezio,
                    'treinoAlunosInferior' => $treinoAlunosInferior,
                    'treinoAlunosLombar' => $treinoAlunosLombar,
                    'treinoAlunosAbdomen' => $treinoAlunosAbdomen,
                ])
                                ->setPaper('a4', 'landscape')
                            //->download('treino.pdf');
                            ->stream(); //EXCLUIR DPS DE FINALIZAR A TELA DE DOWNLOAD
                }
            }
            if ($treinoGeralDivisoes === 'ABC'){
                if ($historicoTreino === 'A'){

                    $historicoTreino = new historicoTreino();
                    $historicoTreino->alu_id = $authAluID;
                    $historicoTreino->tg_id = $treinoGeralAluno->id;
                    $historicoTreino->ht_divisao = "B";
                    $historicoTreino->ht_data_concluido = Carbon::today();
                    $historicoTreino->save();

                    $treinoAlunosPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'peito')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'peito')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhPeito)){
                            $treinoAlunosPeito = null;
                        }

                    $treinoAlunosCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'costas')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'costas')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhCostas)){
                            $treinoAlunosCostas = null;
                        }

                    $treinoAlunosBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'biceps')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'biceps')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhBiceps)){
                            $treinoAlunosBiceps = null;
                        }

                    $treinoAlunosTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'triceps')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'triceps')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhTriceps)){
                            $treinoAlunosTriceps = null;
                        }

                    $treinoAlunosAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'antebraco')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'antebraco')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhAntebraco)){
                            $treinoAlunosAntebraco = null;
                        }

                    $treinoAlunosOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'ombro')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'ombro')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhOmbro)){
                            $treinoAlunosOmbro = null;
                        }

                    $treinoAlunosTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'trapezio')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'trapezio')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhTrapezio)){
                            $treinoAlunosTrapezio = null;
                        }

                    $treinoAlunosInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'inferior')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'inferior')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhInferior)){
                            $treinoAlunosInferior = null;
                        }

                    $treinoAlunosLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'lombar')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'lombar')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhLombar)){
                            $treinoAlunosLombar = null;
                        }

                    $treinoAlunosAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'abdomen')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'abdomen')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhAbdomen)){
                            $treinoAlunosAbdomen = null;
                        }

                return PDF::loadView('aluno.viewsTreino.ImprimirTreino.imprimirTreinoB', [
                    'treinoGeralAlunoProfessor' => $treinoGeralAlunoProfessor,
                    'treinoGeralDivisoes' => $treinoGeralDivisoes,
                    'treinoAlunosPeito' => $treinoAlunosPeito,
                    'treinoAlunosCostas' => $treinoAlunosCostas,
                    'treinoAlunosBiceps' => $treinoAlunosBiceps,
                    'treinoAlunosTriceps' => $treinoAlunosTriceps,
                    'treinoAlunosAntebraco' => $treinoAlunosAntebraco,
                    'treinoAlunosOmbro' => $treinoAlunosOmbro,
                    'treinoAlunosTrapezio' => $treinoAlunosTrapezio,
                    'treinoAlunosInferior' => $treinoAlunosInferior,
                    'treinoAlunosLombar' => $treinoAlunosLombar,
                    'treinoAlunosAbdomen' => $treinoAlunosAbdomen,
                ])
                            ->setPaper([0, 0, 807.874, 221.102], 'landscape')
                            //->download('treino.pdf');
                            ->stream(); //EXCLUIR DPS DE FINALIZAR A TELA DE DOWNLOAD
                }
                if ($historicoTreino === 'B') {

                    $historicoTreino = new historicoTreino();
                    $historicoTreino->alu_id = $authAluID;
                    $historicoTreino->tg_id = $treinoGeralAluno->id;
                    $historicoTreino->ht_divisao = "C";
                    $historicoTreino->ht_data_concluido = Carbon::today();
                    $historicoTreino->save();

                    $treinoAlunosPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'C')
                    ->where('exe_membro', '=', 'peito')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'C')
                        ->where('exe_membro', '=', 'peito')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhPeito)){
                            $treinoAlunosPeito = null;
                        }

                    $treinoAlunosCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'C')
                    ->where('exe_membro', '=', 'costas')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'C')
                        ->where('exe_membro', '=', 'costas')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhCostas)){
                            $treinoAlunosCostas = null;
                        }

                    $treinoAlunosBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'C')
                    ->where('exe_membro', '=', 'biceps')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'C')
                        ->where('exe_membro', '=', 'biceps')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhBiceps)){
                            $treinoAlunosBiceps = null;
                        }

                    $treinoAlunosTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'C')
                    ->where('exe_membro', '=', 'triceps')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'C')
                        ->where('exe_membro', '=', 'triceps')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhTriceps)){
                            $treinoAlunosTriceps = null;
                        }

                    $treinoAlunosAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'C')
                    ->where('exe_membro', '=', 'antebraco')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'C')
                        ->where('exe_membro', '=', 'antebraco')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhAntebraco)){
                            $treinoAlunosAntebraco = null;
                        }

                    $treinoAlunosOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'C')
                    ->where('exe_membro', '=', 'ombro')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'C')
                        ->where('exe_membro', '=', 'ombro')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhOmbro)){
                            $treinoAlunosOmbro = null;
                        }

                    $treinoAlunosTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'C')
                    ->where('exe_membro', '=', 'trapezio')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'C')
                        ->where('exe_membro', '=', 'trapezio')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhTrapezio)){
                            $treinoAlunosTrapezio = null;
                        }

                    $treinoAlunosInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'C')
                    ->where('exe_membro', '=', 'inferior')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'C')
                        ->where('exe_membro', '=', 'inferior')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhInferior)){
                            $treinoAlunosInferior = null;
                        }

                    $treinoAlunosLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'C')
                    ->where('exe_membro', '=', 'lombar')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'C')
                        ->where('exe_membro', '=', 'lombar')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhLombar)){
                            $treinoAlunosLombar = null;
                        }

                    $treinoAlunosAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'C')
                    ->where('exe_membro', '=', 'abdomen')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'C')
                        ->where('exe_membro', '=', 'abdomen')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhAbdomen)){
                            $treinoAlunosAbdomen = null;
                        }

                return PDF::loadView('aluno.viewsTreino.ImprimirTreino.imprimirTreinoC', [
                    'treinoGeralAlunoProfessor' => $treinoGeralAlunoProfessor,
                    'treinoGeralDivisoes' => $treinoGeralDivisoes,
                    'treinoAlunosPeito' => $treinoAlunosPeito,
                    'treinoAlunosCostas' => $treinoAlunosCostas,
                    'treinoAlunosBiceps' => $treinoAlunosBiceps,
                    'treinoAlunosTriceps' => $treinoAlunosTriceps,
                    'treinoAlunosAntebraco' => $treinoAlunosAntebraco,
                    'treinoAlunosOmbro' => $treinoAlunosOmbro,
                    'treinoAlunosTrapezio' => $treinoAlunosTrapezio,
                    'treinoAlunosInferior' => $treinoAlunosInferior,
                    'treinoAlunosLombar' => $treinoAlunosLombar,
                    'treinoAlunosAbdomen' => $treinoAlunosAbdomen,
                ])
                                ->setPaper('a4', 'landscape')
                            //->download('treino.pdf');
                            ->stream(); //EXCLUIR DPS DE FINALIZAR A TELA DE DOWNLOAD
                }
                if ($historicoTreino === 'C') {

                    $historicoTreino = new historicoTreino();
                    $historicoTreino->alu_id = $authAluID;
                    $historicoTreino->tg_id = $treinoGeralAluno->id;
                    $historicoTreino->ht_divisao = "A";
                    $historicoTreino->ht_data_concluido = Carbon::today();
                    $historicoTreino->save();

                    $treinoAlunosPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'peito')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'peito')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhPeito)){
                            $treinoAlunosPeito = null;
                        }

                    $treinoAlunosCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'costas')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'costas')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhCostas)){
                            $treinoAlunosCostas = null;
                        }

                    $treinoAlunosBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'biceps')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'biceps')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhBiceps)){
                            $treinoAlunosBiceps = null;
                        }

                    $treinoAlunosTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'triceps')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'triceps')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhTriceps)){
                            $treinoAlunosTriceps = null;
                        }

                    $treinoAlunosAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'antebraco')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'antebraco')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhAntebraco)){
                            $treinoAlunosAntebraco = null;
                        }

                    $treinoAlunosOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'ombro')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'ombro')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhOmbro)){
                            $treinoAlunosOmbro = null;
                        }

                    $treinoAlunosTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'trapezio')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'trapezio')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhTrapezio)){
                            $treinoAlunosTrapezio = null;
                        }

                    $treinoAlunosInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'inferior')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'inferior')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhInferior)){
                            $treinoAlunosInferior = null;
                        }

                    $treinoAlunosLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'lombar')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'lombar')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhLombar)){
                            $treinoAlunosLombar = null;
                        }

                    $treinoAlunosAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'abdomen')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'abdomen')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhAbdomen)){
                            $treinoAlunosAbdomen = null;
                        }

                return PDF::loadView('aluno.viewsTreino.imprimirTreino.imprimirTreinoA', [
                    'treinoGeralAlunoProfessor' => $treinoGeralAlunoProfessor,
                    'treinoGeralDivisoes' => $treinoGeralDivisoes,
                    'treinoAlunosPeito' => $treinoAlunosPeito,
                    'treinoAlunosCostas' => $treinoAlunosCostas,
                    'treinoAlunosBiceps' => $treinoAlunosBiceps,
                    'treinoAlunosTriceps' => $treinoAlunosTriceps,
                    'treinoAlunosAntebraco' => $treinoAlunosAntebraco,
                    'treinoAlunosOmbro' => $treinoAlunosOmbro,
                    'treinoAlunosTrapezio' => $treinoAlunosTrapezio,
                    'treinoAlunosInferior' => $treinoAlunosInferior,
                    'treinoAlunosLombar' => $treinoAlunosLombar,
                    'treinoAlunosAbdomen' => $treinoAlunosAbdomen,
                ])
                                ->setPaper('a4', 'landscape')
                            //->download('treino.pdf');
                            ->stream(); //EXCLUIR DPS DE FINALIZAR A TELA DE DOWNLOAD
                }
            }
            if ($treinoGeralDivisoes === 'ABCD') {
                if ($historicoTreino === 'A') {

                    $historicoTreino = new historicoTreino();
                    $historicoTreino->alu_id = $authAluID;
                    $historicoTreino->tg_id = $treinoGeralAluno->id;
                    $historicoTreino->ht_divisao = "B";
                    $historicoTreino->ht_data_concluido = Carbon::today();
                    $historicoTreino->save();

                    $treinoAlunosPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'peito')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'peito')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhPeito)){
                            $treinoAlunosPeito = null;
                        }

                    $treinoAlunosCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'costas')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'costas')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhCostas)){
                            $treinoAlunosCostas = null;
                        }

                    $treinoAlunosBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'biceps')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'biceps')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhBiceps)){
                            $treinoAlunosBiceps = null;
                        }

                    $treinoAlunosTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'triceps')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'triceps')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhTriceps)){
                            $treinoAlunosTriceps = null;
                        }

                    $treinoAlunosAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'antebraco')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'antebraco')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhAntebraco)){
                            $treinoAlunosAntebraco = null;
                        }

                    $treinoAlunosOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'ombro')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'ombro')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhOmbro)){
                            $treinoAlunosOmbro = null;
                        }

                    $treinoAlunosTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'trapezio')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'trapezio')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhTrapezio)){
                            $treinoAlunosTrapezio = null;
                        }

                    $treinoAlunosInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'inferior')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'inferior')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhInferior)){
                            $treinoAlunosInferior = null;
                        }

                    $treinoAlunosLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'lombar')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'lombar')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhLombar)){
                            $treinoAlunosLombar = null;
                        }

                    $treinoAlunosAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'abdomen')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'abdomen')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhAbdomen)){
                            $treinoAlunosAbdomen = null;
                        }

                return PDF::loadView('aluno.viewsTreino.ImprimirTreino.imprimirTreinoB', [
                    'treinoGeralAlunoProfessor' => $treinoGeralAlunoProfessor,
                    'treinoGeralDivisoes' => $treinoGeralDivisoes,
                    'treinoAlunosPeito' => $treinoAlunosPeito,
                    'treinoAlunosCostas' => $treinoAlunosCostas,
                    'treinoAlunosBiceps' => $treinoAlunosBiceps,
                    'treinoAlunosTriceps' => $treinoAlunosTriceps,
                    'treinoAlunosAntebraco' => $treinoAlunosAntebraco,
                    'treinoAlunosOmbro' => $treinoAlunosOmbro,
                    'treinoAlunosTrapezio' => $treinoAlunosTrapezio,
                    'treinoAlunosInferior' => $treinoAlunosInferior,
                    'treinoAlunosLombar' => $treinoAlunosLombar,
                    'treinoAlunosAbdomen' => $treinoAlunosAbdomen,
                ])
                            ->setPaper([0, 0, 807.874, 221.102], 'landscape')
                            //->download('treino.pdf');
                            ->stream(); //EXCLUIR DPS DE FINALIZAR A TELA DE DOWNLOAD
                }
                if ($historicoTreino === 'B') {

                    $historicoTreino = new historicoTreino();
                    $historicoTreino->alu_id = $authAluID;
                    $historicoTreino->tg_id = $treinoGeralAluno->id;
                    $historicoTreino->ht_divisao = "C";
                    $historicoTreino->ht_data_concluido = Carbon::today();
                    $historicoTreino->save();

                    $treinoAlunosPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'C')
                    ->where('exe_membro', '=', 'peito')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'C')
                        ->where('exe_membro', '=', 'peito')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhPeito)){
                            $treinoAlunosPeito = null;
                        }

                    $treinoAlunosCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'C')
                    ->where('exe_membro', '=', 'costas')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'C')
                        ->where('exe_membro', '=', 'costas')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhCostas)){
                            $treinoAlunosCostas = null;
                        }

                    $treinoAlunosBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'C')
                    ->where('exe_membro', '=', 'biceps')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'C')
                        ->where('exe_membro', '=', 'biceps')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhBiceps)){
                            $treinoAlunosBiceps = null;
                        }

                    $treinoAlunosTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'C')
                    ->where('exe_membro', '=', 'triceps')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'C')
                        ->where('exe_membro', '=', 'triceps')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhTriceps)){
                            $treinoAlunosTriceps = null;
                        }

                    $treinoAlunosAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'C')
                    ->where('exe_membro', '=', 'antebraco')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'C')
                        ->where('exe_membro', '=', 'antebraco')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhAntebraco)){
                            $treinoAlunosAntebraco = null;
                        }

                    $treinoAlunosOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'C')
                    ->where('exe_membro', '=', 'ombro')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'C')
                        ->where('exe_membro', '=', 'ombro')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhOmbro)){
                            $treinoAlunosOmbro = null;
                        }

                    $treinoAlunosTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'C')
                    ->where('exe_membro', '=', 'trapezio')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'C')
                        ->where('exe_membro', '=', 'trapezio')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhTrapezio)){
                            $treinoAlunosTrapezio = null;
                        }

                    $treinoAlunosInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'C')
                    ->where('exe_membro', '=', 'inferior')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'C')
                        ->where('exe_membro', '=', 'inferior')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhInferior)){
                            $treinoAlunosInferior = null;
                        }

                    $treinoAlunosLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'C')
                    ->where('exe_membro', '=', 'lombar')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'C')
                        ->where('exe_membro', '=', 'lombar')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhLombar)){
                            $treinoAlunosLombar = null;
                        }

                    $treinoAlunosAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'C')
                    ->where('exe_membro', '=', 'abdomen')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'C')
                        ->where('exe_membro', '=', 'abdomen')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhAbdomen)){
                            $treinoAlunosAbdomen = null;
                        }

                return PDF::loadView('aluno.viewsTreino.ImprimirTreino.imprimirTreinoC', [
                    'treinoGeralAlunoProfessor' => $treinoGeralAlunoProfessor,
                    'treinoGeralDivisoes' => $treinoGeralDivisoes,
                    'treinoAlunosPeito' => $treinoAlunosPeito,
                    'treinoAlunosCostas' => $treinoAlunosCostas,
                    'treinoAlunosBiceps' => $treinoAlunosBiceps,
                    'treinoAlunosTriceps' => $treinoAlunosTriceps,
                    'treinoAlunosAntebraco' => $treinoAlunosAntebraco,
                    'treinoAlunosOmbro' => $treinoAlunosOmbro,
                    'treinoAlunosTrapezio' => $treinoAlunosTrapezio,
                    'treinoAlunosInferior' => $treinoAlunosInferior,
                    'treinoAlunosLombar' => $treinoAlunosLombar,
                    'treinoAlunosAbdomen' => $treinoAlunosAbdomen,
                ])
                                ->setPaper('a4', 'landscape')
                            //->download('treino.pdf');
                            ->stream(); //EXCLUIR DPS DE FINALIZAR A TELA DE DOWNLOAD
                }
                if ($historicoTreino === 'C'){

                    $historicoTreino = new historicoTreino();
                    $historicoTreino->alu_id = $authAluID;
                    $historicoTreino->tg_id = $treinoGeralAluno->id;
                    $historicoTreino->ht_divisao = "D";
                    $historicoTreino->ht_data_concluido = Carbon::today();
                    $historicoTreino->save();

                    $treinoAlunosPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'D')
                    ->where('exe_membro', '=', 'peito')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'D')
                        ->where('exe_membro', '=', 'peito')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhPeito)){
                            $treinoAlunosPeito = null;
                        }

                    $treinoAlunosCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'D')
                    ->where('exe_membro', '=', 'costas')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'D')
                        ->where('exe_membro', '=', 'costas')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhCostas)){
                            $treinoAlunosCostas = null;
                        }

                    $treinoAlunosBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'D')
                    ->where('exe_membro', '=', 'biceps')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'D')
                        ->where('exe_membro', '=', 'biceps')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhBiceps)){
                            $treinoAlunosBiceps = null;
                        }

                    $treinoAlunosTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'D')
                    ->where('exe_membro', '=', 'triceps')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'D')
                        ->where('exe_membro', '=', 'triceps')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhTriceps)){
                            $treinoAlunosTriceps = null;
                        }

                    $treinoAlunosAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'D')
                    ->where('exe_membro', '=', 'antebraco')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'D')
                        ->where('exe_membro', '=', 'antebraco')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhAntebraco)){
                            $treinoAlunosAntebraco = null;
                        }

                    $treinoAlunosOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'D')
                    ->where('exe_membro', '=', 'ombro')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'D')
                        ->where('exe_membro', '=', 'ombro')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhOmbro)){
                            $treinoAlunosOmbro = null;
                        }

                    $treinoAlunosTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'D')
                    ->where('exe_membro', '=', 'trapezio')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'D')
                        ->where('exe_membro', '=', 'trapezio')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhTrapezio)){
                            $treinoAlunosTrapezio = null;
                        }

                    $treinoAlunosInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'D')
                    ->where('exe_membro', '=', 'inferior')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'D')
                        ->where('exe_membro', '=', 'inferior')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhInferior)){
                            $treinoAlunosInferior = null;
                        }

                    $treinoAlunosLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'D')
                    ->where('exe_membro', '=', 'lombar')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'D')
                        ->where('exe_membro', '=', 'lombar')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhLombar)){
                            $treinoAlunosLombar = null;
                        }

                    $treinoAlunosAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'D')
                    ->where('exe_membro', '=', 'abdomen')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'D')
                        ->where('exe_membro', '=', 'abdomen')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhAbdomen)){
                            $treinoAlunosAbdomen = null;
                        }

                return PDF::loadView('aluno.viewsTreino.imprimirTreino.imprimirTreinoD', [
                    'treinoGeralAlunoProfessor' => $treinoGeralAlunoProfessor,
                    'treinoGeralDivisoes' => $treinoGeralDivisoes,
                    'treinoAlunosPeito' => $treinoAlunosPeito,
                    'treinoAlunosCostas' => $treinoAlunosCostas,
                    'treinoAlunosBiceps' => $treinoAlunosBiceps,
                    'treinoAlunosTriceps' => $treinoAlunosTriceps,
                    'treinoAlunosAntebraco' => $treinoAlunosAntebraco,
                    'treinoAlunosOmbro' => $treinoAlunosOmbro,
                    'treinoAlunosTrapezio' => $treinoAlunosTrapezio,
                    'treinoAlunosInferior' => $treinoAlunosInferior,
                    'treinoAlunosLombar' => $treinoAlunosLombar,
                    'treinoAlunosAbdomen' => $treinoAlunosAbdomen,
                ])
                                ->setPaper('a4', 'landscape')
                            //->download('treino.pdf');
                            ->stream(); //EXCLUIR DPS DE FINALIZAR A TELA DE DOWNLOAD
                }
                if ($historicoTreino === 'D'){
                    $historicoTreino = new historicoTreino();
                    $historicoTreino->alu_id = $authAluID;
                    $historicoTreino->tg_id = $treinoGeralAluno->id;
                    $historicoTreino->ht_divisao = "A";
                    $historicoTreino->ht_data_concluido = Carbon::today();
                    $historicoTreino->save();

                    $treinoAlunosPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'peito')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'peito')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhPeito)){
                            $treinoAlunosPeito = null;
                        }

                    $treinoAlunosCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'costas')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'costas')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhCostas)){
                            $treinoAlunosCostas = null;
                        }

                    $treinoAlunosBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'biceps')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'biceps')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhBiceps)){
                            $treinoAlunosBiceps = null;
                        }

                    $treinoAlunosTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'triceps')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'triceps')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhTriceps)){
                            $treinoAlunosTriceps = null;
                        }

                    $treinoAlunosAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'antebraco')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'antebraco')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhAntebraco)){
                            $treinoAlunosAntebraco = null;
                        }

                    $treinoAlunosOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'ombro')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'ombro')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhOmbro)){
                            $treinoAlunosOmbro = null;
                        }

                    $treinoAlunosTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'trapezio')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'trapezio')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhTrapezio)){
                            $treinoAlunosTrapezio = null;
                        }

                    $treinoAlunosInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'inferior')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'inferior')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhInferior)){
                            $treinoAlunosInferior = null;
                        }

                    $treinoAlunosLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'lombar')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'lombar')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhLombar)){
                            $treinoAlunosLombar = null;
                        }

                    $treinoAlunosAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'abdomen')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'abdomen')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhAbdomen)){
                            $treinoAlunosAbdomen = null;
                        }

                return PDF::loadView('aluno.viewsTreino.imprimirTreino.imprimirTreinoA', [
                    'treinoGeralAlunoProfessor' => $treinoGeralAlunoProfessor,
                    'treinoGeralDivisoes' => $treinoGeralDivisoes,
                    'treinoAlunosPeito' => $treinoAlunosPeito,
                    'treinoAlunosCostas' => $treinoAlunosCostas,
                    'treinoAlunosBiceps' => $treinoAlunosBiceps,
                    'treinoAlunosTriceps' => $treinoAlunosTriceps,
                    'treinoAlunosAntebraco' => $treinoAlunosAntebraco,
                    'treinoAlunosOmbro' => $treinoAlunosOmbro,
                    'treinoAlunosTrapezio' => $treinoAlunosTrapezio,
                    'treinoAlunosInferior' => $treinoAlunosInferior,
                    'treinoAlunosLombar' => $treinoAlunosLombar,
                    'treinoAlunosAbdomen' => $treinoAlunosAbdomen,
                ])
                                ->setPaper('a4', 'landscape')
                            //->download('treino.pdf');
                            ->stream(); //EXCLUIR DPS DE FINALIZAR A TELA DE DOWNLOAD
                }
            }
            if ($treinoGeralDivisoes === 'ABCDE'){
                if ($historicoTreino === 'A') {

                    $historicoTreino = new historicoTreino();
                    $historicoTreino->alu_id = $authAluID;
                    $historicoTreino->tg_id = $treinoGeralAluno->id;
                    $historicoTreino->ht_divisao = "B";
                    $historicoTreino->ht_data_concluido = Carbon::today();
                    $historicoTreino->save();

                    $treinoAlunosPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'peito')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'peito')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhPeito)){
                            $treinoAlunosPeito = null;
                        }

                    $treinoAlunosCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'costas')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'costas')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhCostas)){
                            $treinoAlunosCostas = null;
                        }

                    $treinoAlunosBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'biceps')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'biceps')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhBiceps)){
                            $treinoAlunosBiceps = null;
                        }

                    $treinoAlunosTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'triceps')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'triceps')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhTriceps)){
                            $treinoAlunosTriceps = null;
                        }

                    $treinoAlunosAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'antebraco')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'antebraco')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhAntebraco)){
                            $treinoAlunosAntebraco = null;
                        }

                    $treinoAlunosOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'ombro')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'ombro')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhOmbro)){
                            $treinoAlunosOmbro = null;
                        }

                    $treinoAlunosTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'trapezio')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'trapezio')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhTrapezio)){
                            $treinoAlunosTrapezio = null;
                        }

                    $treinoAlunosInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'inferior')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'inferior')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhInferior)){
                            $treinoAlunosInferior = null;
                        }

                    $treinoAlunosLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'lombar')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'lombar')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhLombar)){
                            $treinoAlunosLombar = null;
                        }

                    $treinoAlunosAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'abdomen')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'abdomen')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhAbdomen)){
                            $treinoAlunosAbdomen = null;
                        }

                return PDF::loadView('aluno.viewsTreino.ImprimirTreino.imprimirTreinoB', [
                    'treinoGeralAlunoProfessor' => $treinoGeralAlunoProfessor,
                    'treinoGeralDivisoes' => $treinoGeralDivisoes,
                    'treinoAlunosPeito' => $treinoAlunosPeito,
                    'treinoAlunosCostas' => $treinoAlunosCostas,
                    'treinoAlunosBiceps' => $treinoAlunosBiceps,
                    'treinoAlunosTriceps' => $treinoAlunosTriceps,
                    'treinoAlunosAntebraco' => $treinoAlunosAntebraco,
                    'treinoAlunosOmbro' => $treinoAlunosOmbro,
                    'treinoAlunosTrapezio' => $treinoAlunosTrapezio,
                    'treinoAlunosInferior' => $treinoAlunosInferior,
                    'treinoAlunosLombar' => $treinoAlunosLombar,
                    'treinoAlunosAbdomen' => $treinoAlunosAbdomen,
                ])
                            ->setPaper([0, 0, 807.874, 221.102], 'landscape')
                            //->download('treino.pdf');
                            ->stream(); //EXCLUIR DPS DE FINALIZAR A TELA DE DOWNLOAD
                }
                if ($historicoTreino === 'B') {

                    $historicoTreino = new historicoTreino();
                    $historicoTreino->alu_id = $authAluID;
                    $historicoTreino->tg_id = $treinoGeralAluno->id;
                    $historicoTreino->ht_divisao = "C";
                    $historicoTreino->ht_data_concluido = Carbon::today();
                    $historicoTreino->save();

                    $treinoAlunosPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'C')
                    ->where('exe_membro', '=', 'peito')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'C')
                        ->where('exe_membro', '=', 'peito')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhPeito)){
                            $treinoAlunosPeito = null;
                        }

                    $treinoAlunosCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'C')
                    ->where('exe_membro', '=', 'costas')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'C')
                        ->where('exe_membro', '=', 'costas')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhCostas)){
                            $treinoAlunosCostas = null;
                        }

                    $treinoAlunosBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'C')
                    ->where('exe_membro', '=', 'biceps')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'C')
                        ->where('exe_membro', '=', 'biceps')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhBiceps)){
                            $treinoAlunosBiceps = null;
                        }

                    $treinoAlunosTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'C')
                    ->where('exe_membro', '=', 'triceps')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'C')
                        ->where('exe_membro', '=', 'triceps')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhTriceps)){
                            $treinoAlunosTriceps = null;
                        }

                    $treinoAlunosAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'C')
                    ->where('exe_membro', '=', 'antebraco')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'C')
                        ->where('exe_membro', '=', 'antebraco')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhAntebraco)){
                            $treinoAlunosAntebraco = null;
                        }

                    $treinoAlunosOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'C')
                    ->where('exe_membro', '=', 'ombro')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'C')
                        ->where('exe_membro', '=', 'ombro')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhOmbro)){
                            $treinoAlunosOmbro = null;
                        }

                    $treinoAlunosTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'C')
                    ->where('exe_membro', '=', 'trapezio')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'C')
                        ->where('exe_membro', '=', 'trapezio')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhTrapezio)){
                            $treinoAlunosTrapezio = null;
                        }

                    $treinoAlunosInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'C')
                    ->where('exe_membro', '=', 'inferior')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'C')
                        ->where('exe_membro', '=', 'inferior')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhInferior)){
                            $treinoAlunosInferior = null;
                        }

                    $treinoAlunosLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'C')
                    ->where('exe_membro', '=', 'lombar')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'C')
                        ->where('exe_membro', '=', 'lombar')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhLombar)){
                            $treinoAlunosLombar = null;
                        }

                    $treinoAlunosAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'C')
                    ->where('exe_membro', '=', 'abdomen')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'C')
                        ->where('exe_membro', '=', 'abdomen')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhAbdomen)){
                            $treinoAlunosAbdomen = null;
                        }

                return PDF::loadView('aluno.viewsTreino.ImprimirTreino.imprimirTreinoC', [
                    'treinoGeralAlunoProfessor' => $treinoGeralAlunoProfessor,
                    'treinoGeralDivisoes' => $treinoGeralDivisoes,
                    'treinoAlunosPeito' => $treinoAlunosPeito,
                    'treinoAlunosCostas' => $treinoAlunosCostas,
                    'treinoAlunosBiceps' => $treinoAlunosBiceps,
                    'treinoAlunosTriceps' => $treinoAlunosTriceps,
                    'treinoAlunosAntebraco' => $treinoAlunosAntebraco,
                    'treinoAlunosOmbro' => $treinoAlunosOmbro,
                    'treinoAlunosTrapezio' => $treinoAlunosTrapezio,
                    'treinoAlunosInferior' => $treinoAlunosInferior,
                    'treinoAlunosLombar' => $treinoAlunosLombar,
                    'treinoAlunosAbdomen' => $treinoAlunosAbdomen,
                ])
                                ->setPaper('a4', 'landscape')
                            //->download('treino.pdf');
                            ->stream(); //EXCLUIR DPS DE FINALIZAR A TELA DE DOWNLOAD
                }
                if ($historicoTreino === 'C'){

                    $historicoTreino = new historicoTreino();
                    $historicoTreino->alu_id = $authAluID;
                    $historicoTreino->tg_id = $treinoGeralAluno->id;
                    $historicoTreino->ht_divisao = "D";
                    $historicoTreino->ht_data_concluido = Carbon::today();
                    $historicoTreino->save();

                    $treinoAlunosPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'D')
                    ->where('exe_membro', '=', 'peito')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'D')
                        ->where('exe_membro', '=', 'peito')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhPeito)){
                            $treinoAlunosPeito = null;
                        }

                    $treinoAlunosCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'D')
                    ->where('exe_membro', '=', 'costas')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'D')
                        ->where('exe_membro', '=', 'costas')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhCostas)){
                            $treinoAlunosCostas = null;
                        }

                    $treinoAlunosBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'D')
                    ->where('exe_membro', '=', 'biceps')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'D')
                        ->where('exe_membro', '=', 'biceps')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhBiceps)){
                            $treinoAlunosBiceps = null;
                        }

                    $treinoAlunosTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'D')
                    ->where('exe_membro', '=', 'triceps')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'D')
                        ->where('exe_membro', '=', 'triceps')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhTriceps)){
                            $treinoAlunosTriceps = null;
                        }

                    $treinoAlunosAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'D')
                    ->where('exe_membro', '=', 'antebraco')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'D')
                        ->where('exe_membro', '=', 'antebraco')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhAntebraco)){
                            $treinoAlunosAntebraco = null;
                        }

                    $treinoAlunosOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'D')
                    ->where('exe_membro', '=', 'ombro')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'D')
                        ->where('exe_membro', '=', 'ombro')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhOmbro)){
                            $treinoAlunosOmbro = null;
                        }

                    $treinoAlunosTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'D')
                    ->where('exe_membro', '=', 'trapezio')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'D')
                        ->where('exe_membro', '=', 'trapezio')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhTrapezio)){
                            $treinoAlunosTrapezio = null;
                        }

                    $treinoAlunosInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'D')
                    ->where('exe_membro', '=', 'inferior')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'D')
                        ->where('exe_membro', '=', 'inferior')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhInferior)){
                            $treinoAlunosInferior = null;
                        }

                    $treinoAlunosLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'D')
                    ->where('exe_membro', '=', 'lombar')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'D')
                        ->where('exe_membro', '=', 'lombar')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhLombar)){
                            $treinoAlunosLombar = null;
                        }

                    $treinoAlunosAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'D')
                    ->where('exe_membro', '=', 'abdomen')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'D')
                        ->where('exe_membro', '=', 'abdomen')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhAbdomen)){
                            $treinoAlunosAbdomen = null;
                        }

                return PDF::loadView('aluno.viewsTreino.imprimirTreino.imprimirTreinoD', [
                    'treinoGeralAlunoProfessor' => $treinoGeralAlunoProfessor,
                    'treinoGeralDivisoes' => $treinoGeralDivisoes,
                    'treinoAlunosPeito' => $treinoAlunosPeito,
                    'treinoAlunosCostas' => $treinoAlunosCostas,
                    'treinoAlunosBiceps' => $treinoAlunosBiceps,
                    'treinoAlunosTriceps' => $treinoAlunosTriceps,
                    'treinoAlunosAntebraco' => $treinoAlunosAntebraco,
                    'treinoAlunosOmbro' => $treinoAlunosOmbro,
                    'treinoAlunosTrapezio' => $treinoAlunosTrapezio,
                    'treinoAlunosInferior' => $treinoAlunosInferior,
                    'treinoAlunosLombar' => $treinoAlunosLombar,
                    'treinoAlunosAbdomen' => $treinoAlunosAbdomen,
                ])
                                ->setPaper('a4', 'landscape')
                            //->download('treino.pdf');
                            ->stream(); //EXCLUIR DPS DE FINALIZAR A TELA DE DOWNLOAD
                }
                if ($historicoTreino === 'D'){

                    $historicoTreino = new historicoTreino();
                    $historicoTreino->alu_id = $authAluID;
                    $historicoTreino->tg_id = $treinoGeralAluno->id;
                    $historicoTreino->ht_divisao = "E";
                    $historicoTreino->ht_data_concluido = Carbon::today();
                    $historicoTreino->save();

                    $treinoAlunosPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'E')
                        ->where('exe_membro', '=', 'peito')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->orderBy('td_numero', 'ASC')
                        ->get();
                            $verificarSeEhPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                            ->where('td_divisao', '=', 'E')
                            ->where('exe_membro', '=', 'peito')
                            ->where('tg_id', '=', $treinoGeralAluno->id)
                            ->first();
                            if(empty($verificarSeEhPeito)){
                                $treinoAlunosPeito = null;
                            }

                        $treinoAlunosCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'E')
                        ->where('exe_membro', '=', 'costas')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->orderBy('td_numero', 'ASC')
                        ->get();
                            $verificarSeEhCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                            ->where('td_divisao', '=', 'E')
                            ->where('exe_membro', '=', 'costas')
                            ->where('tg_id', '=', $treinoGeralAluno->id)
                            ->first();
                            if(empty($verificarSeEhCostas)){
                                $treinoAlunosCostas = null;
                            }

                        $treinoAlunosBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'E')
                        ->where('exe_membro', '=', 'biceps')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->orderBy('td_numero', 'ASC')
                        ->get();
                            $verificarSeEhBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                            ->where('td_divisao', '=', 'E')
                            ->where('exe_membro', '=', 'biceps')
                            ->where('tg_id', '=', $treinoGeralAluno->id)
                            ->first();
                            if(empty($verificarSeEhBiceps)){
                                $treinoAlunosBiceps = null;
                            }

                        $treinoAlunosTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'E')
                        ->where('exe_membro', '=', 'triceps')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->orderBy('td_numero', 'ASC')
                        ->get();
                            $verificarSeEhTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                            ->where('td_divisao', '=', 'E')
                            ->where('exe_membro', '=', 'triceps')
                            ->where('tg_id', '=', $treinoGeralAluno->id)
                            ->first();
                            if(empty($verificarSeEhTriceps)){
                                $treinoAlunosTriceps = null;
                            }

                        $treinoAlunosAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'E')
                        ->where('exe_membro', '=', 'antebraco')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->orderBy('td_numero', 'ASC')
                        ->get();
                            $verificarSeEhAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                            ->where('td_divisao', '=', 'E')
                            ->where('exe_membro', '=', 'antebraco')
                            ->where('tg_id', '=', $treinoGeralAluno->id)
                            ->first();
                            if(empty($verificarSeEhAntebraco)){
                                $treinoAlunosAntebraco = null;
                            }

                        $treinoAlunosOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'E')
                        ->where('exe_membro', '=', 'ombro')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->orderBy('td_numero', 'ASC')
                        ->get();
                            $verificarSeEhOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                            ->where('td_divisao', '=', 'E')
                            ->where('exe_membro', '=', 'ombro')
                            ->where('tg_id', '=', $treinoGeralAluno->id)
                            ->first();
                            if(empty($verificarSeEhOmbro)){
                                $treinoAlunosOmbro = null;
                            }

                        $treinoAlunosTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'E')
                        ->where('exe_membro', '=', 'trapezio')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->orderBy('td_numero', 'ASC')
                        ->get();
                            $verificarSeEhTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                            ->where('td_divisao', '=', 'E')
                            ->where('exe_membro', '=', 'trapezio')
                            ->where('tg_id', '=', $treinoGeralAluno->id)
                            ->first();
                            if(empty($verificarSeEhTrapezio)){
                                $treinoAlunosTrapezio = null;
                            }

                        $treinoAlunosInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'E')
                        ->where('exe_membro', '=', 'inferior')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->orderBy('td_numero', 'ASC')
                        ->get();
                            $verificarSeEhInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                            ->where('td_divisao', '=', 'E')
                            ->where('exe_membro', '=', 'inferior')
                            ->where('tg_id', '=', $treinoGeralAluno->id)
                            ->first();
                            if(empty($verificarSeEhInferior)){
                                $treinoAlunosInferior = null;
                            }

                        $treinoAlunosLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'E')
                        ->where('exe_membro', '=', 'lombar')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->orderBy('td_numero', 'ASC')
                        ->get();
                            $verificarSeEhLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                            ->where('td_divisao', '=', 'E')
                            ->where('exe_membro', '=', 'lombar')
                            ->where('tg_id', '=', $treinoGeralAluno->id)
                            ->first();
                            if(empty($verificarSeEhLombar)){
                                $treinoAlunosLombar = null;
                            }

                        $treinoAlunosAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'E')
                        ->where('exe_membro', '=', 'abdomen')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->orderBy('td_numero', 'ASC')
                        ->get();
                            $verificarSeEhAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                            ->where('td_divisao', '=', 'E')
                            ->where('exe_membro', '=', 'abdomen')
                            ->where('tg_id', '=', $treinoGeralAluno->id)
                            ->first();
                            if(empty($verificarSeEhAbdomen)){
                                $treinoAlunosAbdomen = null;
                            }

                    return PDF::loadView('aluno.viewsTreino.imprimirTreino.imprimirTreinoE', [
                        'treinoGeralAlunoProfessor' => $treinoGeralAlunoProfessor,
                        'treinoGeralDivisoes' => $treinoGeralDivisoes,
                        'treinoAlunosPeito' => $treinoAlunosPeito,
                        'treinoAlunosCostas' => $treinoAlunosCostas,
                        'treinoAlunosBiceps' => $treinoAlunosBiceps,
                        'treinoAlunosTriceps' => $treinoAlunosTriceps,
                        'treinoAlunosAntebraco' => $treinoAlunosAntebraco,
                        'treinoAlunosOmbro' => $treinoAlunosOmbro,
                        'treinoAlunosTrapezio' => $treinoAlunosTrapezio,
                        'treinoAlunosInferior' => $treinoAlunosInferior,
                        'treinoAlunosLombar' => $treinoAlunosLombar,
                        'treinoAlunosAbdomen' => $treinoAlunosAbdomen,
                    ])
                                    ->setPaper('a4', 'landscape')
                                //->download('treino.pdf');
                                ->stream(); //EXCLUIR DPS DE FINALIZAR A TELA DE DOWNLOAD
                }
                if ($historicoTreino === 'E'){
                    $historicoTreino = new historicoTreino();
                    $historicoTreino->alu_id = $authAluID;
                    $historicoTreino->tg_id = $treinoGeralAluno->id;
                    $historicoTreino->ht_divisao = "A";
                    $historicoTreino->ht_data_concluido = Carbon::today();
                    $historicoTreino->save();

                    $treinoAlunosPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'peito')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'peito')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhPeito)){
                            $treinoAlunosPeito = null;
                        }

                    $treinoAlunosCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'costas')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'costas')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhCostas)){
                            $treinoAlunosCostas = null;
                        }

                    $treinoAlunosBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'biceps')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'biceps')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhBiceps)){
                            $treinoAlunosBiceps = null;
                        }

                    $treinoAlunosTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'triceps')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'triceps')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhTriceps)){
                            $treinoAlunosTriceps = null;
                        }

                    $treinoAlunosAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'antebraco')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'antebraco')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhAntebraco)){
                            $treinoAlunosAntebraco = null;
                        }

                    $treinoAlunosOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'ombro')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'ombro')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhOmbro)){
                            $treinoAlunosOmbro = null;
                        }

                    $treinoAlunosTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'trapezio')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'trapezio')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhTrapezio)){
                            $treinoAlunosTrapezio = null;
                        }

                    $treinoAlunosInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'inferior')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'inferior')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhInferior)){
                            $treinoAlunosInferior = null;
                        }

                    $treinoAlunosLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'lombar')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'lombar')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhLombar)){
                            $treinoAlunosLombar = null;
                        }

                    $treinoAlunosAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'abdomen')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'abdomen')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhAbdomen)){
                            $treinoAlunosAbdomen = null;
                        }

                return PDF::loadView('aluno.viewsTreino.imprimirTreino.imprimirTreinoA', [
                    'treinoGeralAlunoProfessor' => $treinoGeralAlunoProfessor,
                    'treinoGeralDivisoes' => $treinoGeralDivisoes,
                    'treinoAlunosPeito' => $treinoAlunosPeito,
                    'treinoAlunosCostas' => $treinoAlunosCostas,
                    'treinoAlunosBiceps' => $treinoAlunosBiceps,
                    'treinoAlunosTriceps' => $treinoAlunosTriceps,
                    'treinoAlunosAntebraco' => $treinoAlunosAntebraco,
                    'treinoAlunosOmbro' => $treinoAlunosOmbro,
                    'treinoAlunosTrapezio' => $treinoAlunosTrapezio,
                    'treinoAlunosInferior' => $treinoAlunosInferior,
                    'treinoAlunosLombar' => $treinoAlunosLombar,
                    'treinoAlunosAbdomen' => $treinoAlunosAbdomen,
                ])
                                ->setPaper('a4', 'landscape')
                            //->download('treino.pdf');
                            ->stream(); //EXCLUIR DPS DE FINALIZAR A TELA DE DOWNLOAD
                }
            }
            if ($treinoGeralDivisoes === 'ABCDEF') {
                if ($historicoTreino === 'A') {

                    $historicoTreino = new historicoTreino();
                    $historicoTreino->alu_id = $authAluID;
                    $historicoTreino->tg_id = $treinoGeralAluno->id;
                    $historicoTreino->ht_divisao = "B";
                    $historicoTreino->ht_data_concluido = Carbon::today();
                    $historicoTreino->save();

                    $treinoAlunosPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'peito')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'peito')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhPeito)){
                            $treinoAlunosPeito = null;
                        }

                    $treinoAlunosCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'costas')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'costas')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhCostas)){
                            $treinoAlunosCostas = null;
                        }

                    $treinoAlunosBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'biceps')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'biceps')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhBiceps)){
                            $treinoAlunosBiceps = null;
                        }

                    $treinoAlunosTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'triceps')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'triceps')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhTriceps)){
                            $treinoAlunosTriceps = null;
                        }

                    $treinoAlunosAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'antebraco')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'antebraco')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhAntebraco)){
                            $treinoAlunosAntebraco = null;
                        }

                    $treinoAlunosOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'ombro')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'ombro')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhOmbro)){
                            $treinoAlunosOmbro = null;
                        }

                    $treinoAlunosTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'trapezio')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'trapezio')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhTrapezio)){
                            $treinoAlunosTrapezio = null;
                        }

                    $treinoAlunosInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'inferior')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'inferior')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhInferior)){
                            $treinoAlunosInferior = null;
                        }

                    $treinoAlunosLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'lombar')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'lombar')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhLombar)){
                            $treinoAlunosLombar = null;
                        }

                    $treinoAlunosAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'B')
                    ->where('exe_membro', '=', 'abdomen')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'B')
                        ->where('exe_membro', '=', 'abdomen')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhAbdomen)){
                            $treinoAlunosAbdomen = null;
                        }

                return PDF::loadView('aluno.viewsTreino.ImprimirTreino.imprimirTreinoB', [
                    'treinoGeralAlunoProfessor' => $treinoGeralAlunoProfessor,
                    'treinoGeralDivisoes' => $treinoGeralDivisoes,
                    'treinoAlunosPeito' => $treinoAlunosPeito,
                    'treinoAlunosCostas' => $treinoAlunosCostas,
                    'treinoAlunosBiceps' => $treinoAlunosBiceps,
                    'treinoAlunosTriceps' => $treinoAlunosTriceps,
                    'treinoAlunosAntebraco' => $treinoAlunosAntebraco,
                    'treinoAlunosOmbro' => $treinoAlunosOmbro,
                    'treinoAlunosTrapezio' => $treinoAlunosTrapezio,
                    'treinoAlunosInferior' => $treinoAlunosInferior,
                    'treinoAlunosLombar' => $treinoAlunosLombar,
                    'treinoAlunosAbdomen' => $treinoAlunosAbdomen,
                ])
                            ->setPaper([0, 0, 807.874, 221.102], 'landscape')
                            //->download('treino.pdf');
                            ->stream(); //EXCLUIR DPS DE FINALIZAR A TELA DE DOWNLOAD
                }
                if ($historicoTreino === 'B') {

                    $historicoTreino = new historicoTreino();
                    $historicoTreino->alu_id = $authAluID;
                    $historicoTreino->tg_id = $treinoGeralAluno->id;
                    $historicoTreino->ht_divisao = "C";
                    $historicoTreino->ht_data_concluido = Carbon::today();
                    $historicoTreino->save();

                    $treinoAlunosPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'C')
                    ->where('exe_membro', '=', 'peito')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'C')
                        ->where('exe_membro', '=', 'peito')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhPeito)){
                            $treinoAlunosPeito = null;
                        }

                    $treinoAlunosCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'C')
                    ->where('exe_membro', '=', 'costas')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'C')
                        ->where('exe_membro', '=', 'costas')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhCostas)){
                            $treinoAlunosCostas = null;
                        }

                    $treinoAlunosBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'C')
                    ->where('exe_membro', '=', 'biceps')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'C')
                        ->where('exe_membro', '=', 'biceps')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhBiceps)){
                            $treinoAlunosBiceps = null;
                        }

                    $treinoAlunosTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'C')
                    ->where('exe_membro', '=', 'triceps')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'C')
                        ->where('exe_membro', '=', 'triceps')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhTriceps)){
                            $treinoAlunosTriceps = null;
                        }

                    $treinoAlunosAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'C')
                    ->where('exe_membro', '=', 'antebraco')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'C')
                        ->where('exe_membro', '=', 'antebraco')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhAntebraco)){
                            $treinoAlunosAntebraco = null;
                        }

                    $treinoAlunosOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'C')
                    ->where('exe_membro', '=', 'ombro')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'C')
                        ->where('exe_membro', '=', 'ombro')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhOmbro)){
                            $treinoAlunosOmbro = null;
                        }

                    $treinoAlunosTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'C')
                    ->where('exe_membro', '=', 'trapezio')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'C')
                        ->where('exe_membro', '=', 'trapezio')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhTrapezio)){
                            $treinoAlunosTrapezio = null;
                        }

                    $treinoAlunosInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'C')
                    ->where('exe_membro', '=', 'inferior')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'C')
                        ->where('exe_membro', '=', 'inferior')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhInferior)){
                            $treinoAlunosInferior = null;
                        }

                    $treinoAlunosLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'C')
                    ->where('exe_membro', '=', 'lombar')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'C')
                        ->where('exe_membro', '=', 'lombar')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhLombar)){
                            $treinoAlunosLombar = null;
                        }

                    $treinoAlunosAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'C')
                    ->where('exe_membro', '=', 'abdomen')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'C')
                        ->where('exe_membro', '=', 'abdomen')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhAbdomen)){
                            $treinoAlunosAbdomen = null;
                        }

                return PDF::loadView('aluno.viewsTreino.ImprimirTreino.imprimirTreinoC', [
                    'treinoGeralAlunoProfessor' => $treinoGeralAlunoProfessor,
                    'treinoGeralDivisoes' => $treinoGeralDivisoes,
                    'treinoAlunosPeito' => $treinoAlunosPeito,
                    'treinoAlunosCostas' => $treinoAlunosCostas,
                    'treinoAlunosBiceps' => $treinoAlunosBiceps,
                    'treinoAlunosTriceps' => $treinoAlunosTriceps,
                    'treinoAlunosAntebraco' => $treinoAlunosAntebraco,
                    'treinoAlunosOmbro' => $treinoAlunosOmbro,
                    'treinoAlunosTrapezio' => $treinoAlunosTrapezio,
                    'treinoAlunosInferior' => $treinoAlunosInferior,
                    'treinoAlunosLombar' => $treinoAlunosLombar,
                    'treinoAlunosAbdomen' => $treinoAlunosAbdomen,
                ])
                                ->setPaper('a4', 'landscape')
                            //->download('treino.pdf');
                            ->stream(); //EXCLUIR DPS DE FINALIZAR A TELA DE DOWNLOAD
                }
                if ($historicoTreino === 'C'){

                    $historicoTreino = new historicoTreino();
                    $historicoTreino->alu_id = $authAluID;
                    $historicoTreino->tg_id = $treinoGeralAluno->id;
                    $historicoTreino->ht_divisao = "D";
                    $historicoTreino->ht_data_concluido = Carbon::today();
                    $historicoTreino->save();

                    $treinoAlunosPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'D')
                    ->where('exe_membro', '=', 'peito')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'D')
                        ->where('exe_membro', '=', 'peito')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhPeito)){
                            $treinoAlunosPeito = null;
                        }

                    $treinoAlunosCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'D')
                    ->where('exe_membro', '=', 'costas')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'D')
                        ->where('exe_membro', '=', 'costas')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhCostas)){
                            $treinoAlunosCostas = null;
                        }

                    $treinoAlunosBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'D')
                    ->where('exe_membro', '=', 'biceps')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'D')
                        ->where('exe_membro', '=', 'biceps')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhBiceps)){
                            $treinoAlunosBiceps = null;
                        }

                    $treinoAlunosTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'D')
                    ->where('exe_membro', '=', 'triceps')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'D')
                        ->where('exe_membro', '=', 'triceps')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhTriceps)){
                            $treinoAlunosTriceps = null;
                        }

                    $treinoAlunosAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'D')
                    ->where('exe_membro', '=', 'antebraco')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'D')
                        ->where('exe_membro', '=', 'antebraco')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhAntebraco)){
                            $treinoAlunosAntebraco = null;
                        }

                    $treinoAlunosOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'D')
                    ->where('exe_membro', '=', 'ombro')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'D')
                        ->where('exe_membro', '=', 'ombro')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhOmbro)){
                            $treinoAlunosOmbro = null;
                        }

                    $treinoAlunosTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'D')
                    ->where('exe_membro', '=', 'trapezio')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'D')
                        ->where('exe_membro', '=', 'trapezio')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhTrapezio)){
                            $treinoAlunosTrapezio = null;
                        }

                    $treinoAlunosInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'D')
                    ->where('exe_membro', '=', 'inferior')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'D')
                        ->where('exe_membro', '=', 'inferior')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhInferior)){
                            $treinoAlunosInferior = null;
                        }

                    $treinoAlunosLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'D')
                    ->where('exe_membro', '=', 'lombar')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'D')
                        ->where('exe_membro', '=', 'lombar')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhLombar)){
                            $treinoAlunosLombar = null;
                        }

                    $treinoAlunosAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'D')
                    ->where('exe_membro', '=', 'abdomen')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'D')
                        ->where('exe_membro', '=', 'abdomen')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhAbdomen)){
                            $treinoAlunosAbdomen = null;
                        }

                return PDF::loadView('aluno.viewsTreino.imprimirTreino.imprimirTreinoD', [
                    'treinoGeralAlunoProfessor' => $treinoGeralAlunoProfessor,
                    'treinoGeralDivisoes' => $treinoGeralDivisoes,
                    'treinoAlunosPeito' => $treinoAlunosPeito,
                    'treinoAlunosCostas' => $treinoAlunosCostas,
                    'treinoAlunosBiceps' => $treinoAlunosBiceps,
                    'treinoAlunosTriceps' => $treinoAlunosTriceps,
                    'treinoAlunosAntebraco' => $treinoAlunosAntebraco,
                    'treinoAlunosOmbro' => $treinoAlunosOmbro,
                    'treinoAlunosTrapezio' => $treinoAlunosTrapezio,
                    'treinoAlunosInferior' => $treinoAlunosInferior,
                    'treinoAlunosLombar' => $treinoAlunosLombar,
                    'treinoAlunosAbdomen' => $treinoAlunosAbdomen,
                ])
                                ->setPaper('a4', 'landscape')
                            //->download('treino.pdf');
                            ->stream(); //EXCLUIR DPS DE FINALIZAR A TELA DE DOWNLOAD
                }
                if ($historicoTreino === 'D'){

                    $historicoTreino = new historicoTreino();
                    $historicoTreino->alu_id = $authAluID;
                    $historicoTreino->tg_id = $treinoGeralAluno->id;
                    $historicoTreino->ht_divisao = "E";
                    $historicoTreino->ht_data_concluido = Carbon::today();
                    $historicoTreino->save();

                    $treinoAlunosPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'E')
                        ->where('exe_membro', '=', 'peito')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->orderBy('td_numero', 'ASC')
                        ->get();
                            $verificarSeEhPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                            ->where('td_divisao', '=', 'E')
                            ->where('exe_membro', '=', 'peito')
                            ->where('tg_id', '=', $treinoGeralAluno->id)
                            ->first();
                            if(empty($verificarSeEhPeito)){
                                $treinoAlunosPeito = null;
                            }

                        $treinoAlunosCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'E')
                        ->where('exe_membro', '=', 'costas')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->orderBy('td_numero', 'ASC')
                        ->get();
                            $verificarSeEhCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                            ->where('td_divisao', '=', 'E')
                            ->where('exe_membro', '=', 'costas')
                            ->where('tg_id', '=', $treinoGeralAluno->id)
                            ->first();
                            if(empty($verificarSeEhCostas)){
                                $treinoAlunosCostas = null;
                            }

                        $treinoAlunosBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'E')
                        ->where('exe_membro', '=', 'biceps')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->orderBy('td_numero', 'ASC')
                        ->get();
                            $verificarSeEhBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                            ->where('td_divisao', '=', 'E')
                            ->where('exe_membro', '=', 'biceps')
                            ->where('tg_id', '=', $treinoGeralAluno->id)
                            ->first();
                            if(empty($verificarSeEhBiceps)){
                                $treinoAlunosBiceps = null;
                            }

                        $treinoAlunosTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'E')
                        ->where('exe_membro', '=', 'triceps')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->orderBy('td_numero', 'ASC')
                        ->get();
                            $verificarSeEhTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                            ->where('td_divisao', '=', 'E')
                            ->where('exe_membro', '=', 'triceps')
                            ->where('tg_id', '=', $treinoGeralAluno->id)
                            ->first();
                            if(empty($verificarSeEhTriceps)){
                                $treinoAlunosTriceps = null;
                            }

                        $treinoAlunosAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'E')
                        ->where('exe_membro', '=', 'antebraco')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->orderBy('td_numero', 'ASC')
                        ->get();
                            $verificarSeEhAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                            ->where('td_divisao', '=', 'E')
                            ->where('exe_membro', '=', 'antebraco')
                            ->where('tg_id', '=', $treinoGeralAluno->id)
                            ->first();
                            if(empty($verificarSeEhAntebraco)){
                                $treinoAlunosAntebraco = null;
                            }

                        $treinoAlunosOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'E')
                        ->where('exe_membro', '=', 'ombro')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->orderBy('td_numero', 'ASC')
                        ->get();
                            $verificarSeEhOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                            ->where('td_divisao', '=', 'E')
                            ->where('exe_membro', '=', 'ombro')
                            ->where('tg_id', '=', $treinoGeralAluno->id)
                            ->first();
                            if(empty($verificarSeEhOmbro)){
                                $treinoAlunosOmbro = null;
                            }

                        $treinoAlunosTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'E')
                        ->where('exe_membro', '=', 'trapezio')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->orderBy('td_numero', 'ASC')
                        ->get();
                            $verificarSeEhTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                            ->where('td_divisao', '=', 'E')
                            ->where('exe_membro', '=', 'trapezio')
                            ->where('tg_id', '=', $treinoGeralAluno->id)
                            ->first();
                            if(empty($verificarSeEhTrapezio)){
                                $treinoAlunosTrapezio = null;
                            }

                        $treinoAlunosInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'E')
                        ->where('exe_membro', '=', 'inferior')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->orderBy('td_numero', 'ASC')
                        ->get();
                            $verificarSeEhInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                            ->where('td_divisao', '=', 'E')
                            ->where('exe_membro', '=', 'inferior')
                            ->where('tg_id', '=', $treinoGeralAluno->id)
                            ->first();
                            if(empty($verificarSeEhInferior)){
                                $treinoAlunosInferior = null;
                            }

                        $treinoAlunosLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'E')
                        ->where('exe_membro', '=', 'lombar')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->orderBy('td_numero', 'ASC')
                        ->get();
                            $verificarSeEhLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                            ->where('td_divisao', '=', 'E')
                            ->where('exe_membro', '=', 'lombar')
                            ->where('tg_id', '=', $treinoGeralAluno->id)
                            ->first();
                            if(empty($verificarSeEhLombar)){
                                $treinoAlunosLombar = null;
                            }

                        $treinoAlunosAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'E')
                        ->where('exe_membro', '=', 'abdomen')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->orderBy('td_numero', 'ASC')
                        ->get();
                            $verificarSeEhAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                            ->where('td_divisao', '=', 'E')
                            ->where('exe_membro', '=', 'abdomen')
                            ->where('tg_id', '=', $treinoGeralAluno->id)
                            ->first();
                            if(empty($verificarSeEhAbdomen)){
                                $treinoAlunosAbdomen = null;
                            }

                    return PDF::loadView('aluno.viewsTreino.imprimirTreino.imprimirTreinoE', [
                        'treinoGeralAlunoProfessor' => $treinoGeralAlunoProfessor,
                        'treinoGeralDivisoes' => $treinoGeralDivisoes,
                        'treinoAlunosPeito' => $treinoAlunosPeito,
                        'treinoAlunosCostas' => $treinoAlunosCostas,
                        'treinoAlunosBiceps' => $treinoAlunosBiceps,
                        'treinoAlunosTriceps' => $treinoAlunosTriceps,
                        'treinoAlunosAntebraco' => $treinoAlunosAntebraco,
                        'treinoAlunosOmbro' => $treinoAlunosOmbro,
                        'treinoAlunosTrapezio' => $treinoAlunosTrapezio,
                        'treinoAlunosInferior' => $treinoAlunosInferior,
                        'treinoAlunosLombar' => $treinoAlunosLombar,
                        'treinoAlunosAbdomen' => $treinoAlunosAbdomen,
                    ])
                                    ->setPaper('a4', 'landscape')
                                //->download('treino.pdf');
                                ->stream(); //EXCLUIR DPS DE FINALIZAR A TELA DE DOWNLOAD
                }
                if ($historicoTreino === 'E'){

                    $historicoTreino = new historicoTreino();
                    $historicoTreino->alu_id = $authAluID;
                    $historicoTreino->tg_id = $treinoGeralAluno->id;
                    $historicoTreino->ht_divisao = "F";
                    $historicoTreino->ht_data_concluido = Carbon::today();
                    $historicoTreino->save();

                    $treinoAlunosPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                            ->where('td_divisao', '=', 'F')
                            ->where('exe_membro', '=', 'peito')
                            ->where('tg_id', '=', $treinoGeralAluno->id)
                            ->orderBy('td_numero', 'ASC')
                            ->get();
                                $verificarSeEhPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                                ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                                ->where('td_divisao', '=', 'F')
                                ->where('exe_membro', '=', 'peito')
                                ->where('tg_id', '=', $treinoGeralAluno->id)
                                ->first();
                                if(empty($verificarSeEhPeito)){
                                    $treinoAlunosPeito = null;
                                }

                            $treinoAlunosCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                            ->where('td_divisao', '=', 'F')
                            ->where('exe_membro', '=', 'costas')
                            ->where('tg_id', '=', $treinoGeralAluno->id)
                            ->orderBy('td_numero', 'ASC')
                            ->get();
                                $verificarSeEhCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                                ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                                ->where('td_divisao', '=', 'F')
                                ->where('exe_membro', '=', 'costas')
                                ->where('tg_id', '=', $treinoGeralAluno->id)
                                ->first();
                                if(empty($verificarSeEhCostas)){
                                    $treinoAlunosCostas = null;
                                }

                            $treinoAlunosBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                            ->where('td_divisao', '=', 'F')
                            ->where('exe_membro', '=', 'biceps')
                            ->where('tg_id', '=', $treinoGeralAluno->id)
                            ->orderBy('td_numero', 'ASC')
                            ->get();
                                $verificarSeEhBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                                ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                                ->where('td_divisao', '=', 'F')
                                ->where('exe_membro', '=', 'biceps')
                                ->where('tg_id', '=', $treinoGeralAluno->id)
                                ->first();
                                if(empty($verificarSeEhBiceps)){
                                    $treinoAlunosBiceps = null;
                                }

                            $treinoAlunosTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                            ->where('td_divisao', '=', 'F')
                            ->where('exe_membro', '=', 'triceps')
                            ->where('tg_id', '=', $treinoGeralAluno->id)
                            ->orderBy('td_numero', 'ASC')
                            ->get();
                                $verificarSeEhTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                                ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                                ->where('td_divisao', '=', 'F')
                                ->where('exe_membro', '=', 'triceps')
                                ->where('tg_id', '=', $treinoGeralAluno->id)
                                ->first();
                                if(empty($verificarSeEhTriceps)){
                                    $treinoAlunosTriceps = null;
                                }

                            $treinoAlunosAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                            ->where('td_divisao', '=', 'F')
                            ->where('exe_membro', '=', 'antebraco')
                            ->where('tg_id', '=', $treinoGeralAluno->id)
                            ->orderBy('td_numero', 'ASC')
                            ->get();
                                $verificarSeEhAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                                ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                                ->where('td_divisao', '=', 'F')
                                ->where('exe_membro', '=', 'antebraco')
                                ->where('tg_id', '=', $treinoGeralAluno->id)
                                ->first();
                                if(empty($verificarSeEhAntebraco)){
                                    $treinoAlunosAntebraco = null;
                                }

                            $treinoAlunosOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                            ->where('td_divisao', '=', 'F')
                            ->where('exe_membro', '=', 'ombro')
                            ->where('tg_id', '=', $treinoGeralAluno->id)
                            ->orderBy('td_numero', 'ASC')
                            ->get();
                                $verificarSeEhOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                                ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                                ->where('td_divisao', '=', 'F')
                                ->where('exe_membro', '=', 'ombro')
                                ->where('tg_id', '=', $treinoGeralAluno->id)
                                ->first();
                                if(empty($verificarSeEhOmbro)){
                                    $treinoAlunosOmbro = null;
                                }

                            $treinoAlunosTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                            ->where('td_divisao', '=', 'F')
                            ->where('exe_membro', '=', 'trapezio')
                            ->where('tg_id', '=', $treinoGeralAluno->id)
                            ->orderBy('td_numero', 'ASC')
                            ->get();
                                $verificarSeEhTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                                ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                                ->where('td_divisao', '=', 'F')
                                ->where('exe_membro', '=', 'trapezio')
                                ->where('tg_id', '=', $treinoGeralAluno->id)
                                ->first();
                                if(empty($verificarSeEhTrapezio)){
                                    $treinoAlunosTrapezio = null;
                                }

                            $treinoAlunosInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                            ->where('td_divisao', '=', 'F')
                            ->where('exe_membro', '=', 'inferior')
                            ->where('tg_id', '=', $treinoGeralAluno->id)
                            ->orderBy('td_numero', 'ASC')
                            ->get();
                                $verificarSeEhInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                                ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                                ->where('td_divisao', '=', 'F')
                                ->where('exe_membro', '=', 'inferior')
                                ->where('tg_id', '=', $treinoGeralAluno->id)
                                ->first();
                                if(empty($verificarSeEhInferior)){
                                    $treinoAlunosInferior = null;
                                }

                            $treinoAlunosLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                            ->where('td_divisao', '=', 'F')
                            ->where('exe_membro', '=', 'lombar')
                            ->where('tg_id', '=', $treinoGeralAluno->id)
                            ->orderBy('td_numero', 'ASC')
                            ->get();
                                $verificarSeEhLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                                ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                                ->where('td_divisao', '=', 'F')
                                ->where('exe_membro', '=', 'lombar')
                                ->where('tg_id', '=', $treinoGeralAluno->id)
                                ->first();
                                if(empty($verificarSeEhLombar)){
                                    $treinoAlunosLombar = null;
                                }

                            $treinoAlunosAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                            ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                            ->where('td_divisao', '=', 'F')
                            ->where('exe_membro', '=', 'abdomen')
                            ->where('tg_id', '=', $treinoGeralAluno->id)
                            ->orderBy('td_numero', 'ASC')
                            ->get();
                                $verificarSeEhAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                                ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                                ->where('td_divisao', '=', 'F')
                                ->where('exe_membro', '=', 'abdomen')
                                ->where('tg_id', '=', $treinoGeralAluno->id)
                                ->first();
                                if(empty($verificarSeEhAbdomen)){
                                    $treinoAlunosAbdomen = null;
                                }

                        return PDF::loadView('aluno.viewsTreino.imprimirTreino.imprimirTreinoF', [
                            'treinoGeralAlunoProfessor' => $treinoGeralAlunoProfessor,
                            'treinoGeralDivisoes' => $treinoGeralDivisoes,
                            'treinoAlunosPeito' => $treinoAlunosPeito,
                            'treinoAlunosCostas' => $treinoAlunosCostas,
                            'treinoAlunosBiceps' => $treinoAlunosBiceps,
                            'treinoAlunosTriceps' => $treinoAlunosTriceps,
                            'treinoAlunosAntebraco' => $treinoAlunosAntebraco,
                            'treinoAlunosOmbro' => $treinoAlunosOmbro,
                            'treinoAlunosTrapezio' => $treinoAlunosTrapezio,
                            'treinoAlunosInferior' => $treinoAlunosInferior,
                            'treinoAlunosLombar' => $treinoAlunosLombar,
                            'treinoAlunosAbdomen' => $treinoAlunosAbdomen,
                        ])
                                        ->setPaper('a4', 'landscape')
                                    //->download('treino.pdf');
                                    ->stream(); //EXCLUIR DPS DE FINALIZAR A TELA DE DOWNLOAD
                }
                if ($historicoTreino === 'F'){
                    $historicoTreino = new historicoTreino();
                    $historicoTreino->alu_id = $authAluID;
                    $historicoTreino->tg_id = $treinoGeralAluno->id;
                    $historicoTreino->ht_divisao = "A";
                    $historicoTreino->ht_data_concluido = Carbon::today();
                    $historicoTreino->save();

                    $treinoAlunosPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'peito')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhPeito = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'peito')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhPeito)){
                            $treinoAlunosPeito = null;
                        }

                    $treinoAlunosCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'costas')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhCostas = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'costas')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhCostas)){
                            $treinoAlunosCostas = null;
                        }

                    $treinoAlunosBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'biceps')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhBiceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'biceps')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhBiceps)){
                            $treinoAlunosBiceps = null;
                        }

                    $treinoAlunosTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'triceps')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhTriceps = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'triceps')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhTriceps)){
                            $treinoAlunosTriceps = null;
                        }

                    $treinoAlunosAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'antebraco')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhAntebraco = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'antebraco')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhAntebraco)){
                            $treinoAlunosAntebraco = null;
                        }

                    $treinoAlunosOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'ombro')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhOmbro = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'ombro')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhOmbro)){
                            $treinoAlunosOmbro = null;
                        }

                    $treinoAlunosTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'trapezio')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhTrapezio = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'trapezio')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhTrapezio)){
                            $treinoAlunosTrapezio = null;
                        }

                    $treinoAlunosInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'inferior')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhInferior = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'inferior')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhInferior)){
                            $treinoAlunosInferior = null;
                        }

                    $treinoAlunosLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'lombar')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhLombar = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'lombar')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhLombar)){
                            $treinoAlunosLombar = null;
                        }

                    $treinoAlunosAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                    ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                    ->where('td_divisao', '=', 'A')
                    ->where('exe_membro', '=', 'abdomen')
                    ->where('tg_id', '=', $treinoGeralAluno->id)
                    ->orderBy('td_numero', 'ASC')
                    ->get();
                        $verificarSeEhAbdomen = TreinoDetalhe::join('exercicios', 'exercicios.id', '=', 'treino_detalhes.exe_id')
                        ->join('equipamentos', 'equipamentos.id', '=', 'treino_detalhes.eq_id')
                        ->where('td_divisao', '=', 'A')
                        ->where('exe_membro', '=', 'abdomen')
                        ->where('tg_id', '=', $treinoGeralAluno->id)
                        ->first();
                        if(empty($verificarSeEhAbdomen)){
                            $treinoAlunosAbdomen = null;
                        }

                return PDF::loadView('aluno.viewsTreino.imprimirTreino.imprimirTreinoA', [
                    'treinoGeralAlunoProfessor' => $treinoGeralAlunoProfessor,
                    'treinoGeralDivisoes' => $treinoGeralDivisoes,
                    'treinoAlunosPeito' => $treinoAlunosPeito,
                    'treinoAlunosCostas' => $treinoAlunosCostas,
                    'treinoAlunosBiceps' => $treinoAlunosBiceps,
                    'treinoAlunosTriceps' => $treinoAlunosTriceps,
                    'treinoAlunosAntebraco' => $treinoAlunosAntebraco,
                    'treinoAlunosOmbro' => $treinoAlunosOmbro,
                    'treinoAlunosTrapezio' => $treinoAlunosTrapezio,
                    'treinoAlunosInferior' => $treinoAlunosInferior,
                    'treinoAlunosLombar' => $treinoAlunosLombar,
                    'treinoAlunosAbdomen' => $treinoAlunosAbdomen,
                ])
                                ->setPaper('a4', 'landscape')
                            //->download('treino.pdf');
                            ->stream(); //EXCLUIR DPS DE FINALIZAR A TELA DE DOWNLOAD
                }
            }
        }
    }

}

