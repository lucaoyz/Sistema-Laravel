@extends('aluno.layoutsModals.layouts')
@section('title', 'Treino')
@section('treino', 'active bg-gradient-primary')
@section('pagina', 'Treino - Visualizar')
@section('content')

    @foreach ($treinoAAlunos as $treinoAAluno)
        {{$treinoAAluno->exe_nome}}
    @endforeach

    @foreach ($treinoBAlunos as $treinoAAluno)
        {{$treinoAAluno->exe_nome}}
    @endforeach

    @foreach ($treinoCAlunos as $treinoAAluno)
        {{$treinoAAluno->exe_nome}}
    @endforeach

    @foreach ($treinoDAlunos as $treinoAAluno)
        {{$treinoAAluno->exe_nome}}
    @endforeach

    @foreach ($treinoEAlunos as $treinoAAluno)
        {{$treinoAAluno->exe_nome}}
    @endforeach

    @foreach ($treinoFAlunos as $treinoAAluno)
        {{$treinoAAluno->exe_nome}}
    @endforeach
@endsection


