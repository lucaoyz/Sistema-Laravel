@extends('aluno.layoutsModals.layouts')
@section('title', 'Treino')
@section('treino', 'active bg-gradient-primary')
@section('pagina', 'Treino - Visualizar')
@section('content')

    @foreach ($treinoAAlunos as $treinoAAluno)
        {{$treinoAAluno->exe_nome}}
    @endforeach

@endsection


