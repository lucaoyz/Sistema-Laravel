@extends('aluno.layoutsModals.layouts')
@section('title', 'Treino')
@section('treino', 'active bg-gradient-primary')
@section('pagina', 'Treino - Visualizar - Treino C')
@section('content')


@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

@if ($message = Session::get('error'))
<div class="alert alert-danger">
    <p>{{ $message }}</p>
</div>
@endif

<div class="container-fluid py-4">
    <a class="btn btn-outline-primary" href="{{route('aluno.treino.visualizar')}}">Voltar</a>
    <div class="row">
        @foreach ($treinoCAlunos as $treinoCAluno)
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">&nbsp;
        <div class="card">
          <div class="card-header p-3 pt-2">
            <div class="pt-1">
              <h6 class="mb-0 text-secondary">Membro muscular: {{$treinoCAluno->exe_membro}}</h6>
              <h5 class="mb-0">Exercício: <span class="text-primary"> {{$treinoCAluno->exe_nome}}</span></h5>
              <h6 class="mb-0">Series: <span class="text-primary"> {{$treinoCAluno->td_series}}</span></h6>
              <h6 class="mb-0">Repetições: <span class="text-primary"> {{$treinoCAluno->td_repeticoes}}</span></h6>
            </div>
          </div>
          <hr class="dark horizontal my-0">
          <div class="card-footer p-3">
            <p class="mb-0"><span class="text-sm font-weight-bolder">
                <a href="" class="text-primary">Saiba mais.</a>
                </span></p>
          </div>
        </div>
      </div>
      @endforeach
      </div>
    </div>
  </div>
<!-- Modal -->
@include('aluno.layoutsModals.modalExercicios')

@endsection
