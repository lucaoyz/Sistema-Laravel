@extends('aluno.layoutsModals.layouts')
@section('title', 'Treino')
@section('treino', 'active bg-gradient-primary')
@section('pagina', 'Treino - Imprimir - Divisões')
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
    <!-- Detalhes -->
  <div class="row">
    <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <a class="btn btn-outline-primary" href="{{route('aluno.treino')}}">Voltar</a>
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Treino Divisões</h6>
          </div>
          <br>
        </div>

        <div class="card-body px-0 pb-2 position-relative mt-n4 mx-3">
            <div class="table-responsive p-0">

                @if ($treinoGeralAlunoDivisoes == null)
                    <div class="pull-right">
                        <h5 class="mb-0">Você não possui treino ainda, peça para um de nossos professores registrar um treino à você!</h5>
                    </div>

                @endif

                @if ($treinoGeralAlunoDivisoes === 'A')
                    <div class="pull-right">
                        <h5 class="mb-0"><a href="{{route('aluno.ImprimirTreinoDivisoesA')}}" class="btn btn-success">Treino A</a></h5>
                    </div>

                @endif

                @if ($treinoGeralAlunoDivisoes === 'AB')
                    <!-- Divisão A -->
                    <div class="pull-right">
                        <h5 class="mb-0"><a href="{{route('aluno.ImprimirTreinoDivisoesA')}}" class="btn btn-success">Treino A</a> </h5>
                    </div>

                    <!-- Divisão B -->
                    <div class="pull-right">
                        <h5 class="mb-0"><a href="{{route('aluno.ImprimirTreinoDivisoesB')}}" class="btn btn-success">Treino B</a> </h5>
                    </div>
                @endif

                @if ($treinoGeralAlunoDivisoes === 'ABC')
                    <!-- Divisão A -->
                    <div class="pull-right">
                        <h5 class="mb-0"><a href="{{route('aluno.ImprimirTreinoDivisoesA')}}" class="btn btn-success">Treino A</a> </h5>
                    </div>

                    <!-- Divisão B -->
                    <div class="pull-right">
                        <h5 class="mb-0"><a href="{{route('aluno.ImprimirTreinoDivisoesB')}}" class="btn btn-success">Treino B</a> </h5>
                    </div>

                    <!-- Divisão C -->
                    <div class="pull-right">
                        <h5 class="mb-0"><a href="{{route('aluno.ImprimirTreinoDivisoesC')}}" class="btn btn-success">Treino C</a> </h5>
                    </div>
                @endif

                @if ($treinoGeralAlunoDivisoes === 'ABCD')
                    <!-- Divisão A -->
                    <div class="pull-right">
                        <h5 class="mb-0"><a href="{{route('aluno.ImprimirTreinoDivisoesA')}}" class="btn btn-success">Treino A</a> </h5>
                    </div>

                    <!-- Divisão B -->
                    <div class="pull-right">
                        <h5 class="mb-0"><a href="{{route('aluno.ImprimirTreinoDivisoesB')}}" class="btn btn-success">Treino B</a> </h5>
                    </div>

                    <!-- Divisão C -->
                    <div class="pull-right">
                        <h5 class="mb-0"><a href="{{route('aluno.ImprimirTreinoDivisoesC')}}" class="btn btn-success">Treino C</a> </h5>
                    </div>

                    <!-- Divisão D -->
                    <div class="pull-right">
                        <h5 class="mb-0"><a href="{{route('aluno.ImprimirTreinoDivisoesD')}}" class="btn btn-success">Treino D</a></h5>
                    </div>
                @endif

                @if ($treinoGeralAlunoDivisoes === 'ABCDE')
                    <!-- Divisão A -->
                    <div class="pull-right">
                        <h5 class="mb-0"><a href="{{route('aluno.ImprimirTreinoDivisoesA')}}" class="btn btn-success">Treino A</a> </h5>
                    </div>

                    <!-- Divisão B -->
                    <div class="pull-right">
                        <h5 class="mb-0"><a href="{{route('aluno.ImprimirTreinoDivisoesB')}}" class="btn btn-success">Treino B</a> </h5>
                    </div>

                    <!-- Divisão C -->
                    <div class="pull-right">
                        <h5 class="mb-0"><a href="{{route('aluno.ImprimirTreinoDivisoesC')}}" class="btn btn-success">Treino C</a> </h5>
                    </div>

                    <!-- Divisão D -->
                    <div class="pull-right">
                        <h5 class="mb-0"><a href="{{route('aluno.ImprimirTreinoDivisoesD')}}" class="btn btn-success">Treino D</a></h5>
                    </div>

                    <!-- Divisão E -->
                    <div class="pull-right">
                        <h5 class="mb-0"><a href="{{route('aluno.ImprimirTreinoDivisoesE')}}" class="btn btn-success">Treino E</a> </h5>
                    </div>
                @endif

                @if ($treinoGeralAlunoDivisoes === 'ABCDEF')
                    <!-- Divisão A -->
                    <div class="pull-right">
                        <h5 class="mb-0"><a href="{{route('aluno.ImprimirTreinoDivisoesA')}}" class="btn btn-success">Treino A</a> </h5>
                    </div>

                    <!-- Divisão B -->
                    <div class="pull-right">
                        <h5 class="mb-0"><a href="{{route('aluno.ImprimirTreinoDivisoesB')}}" class="btn btn-success">Treino B</a> </h5>
                    </div>

                    <!-- Divisão C -->
                    <div class="pull-right">
                        <h5 class="mb-0"><a href="{{route('aluno.ImprimirTreinoDivisoesC')}}" class="btn btn-success">Treino C</a> </h5>
                    </div>

                    <!-- Divisão D -->
                    <div class="pull-right">
                        <h5 class="mb-0"><a href="{{route('aluno.ImprimirTreinoDivisoesD')}}" class="btn btn-success">Treino D</a></h5>
                    </div>

                    <!-- Divisão E -->
                    <div class="pull-right">
                        <h5 class="mb-0"><a href="{{route('aluno.ImprimirTreinoDivisoesE')}}" class="btn btn-success">Treino E</a> </h5>
                    </div>

                    <!-- Divisão F -->
                    <div class="pull-right">
                        <h5 class="mb-0"><a href="{{route('aluno.ImprimirTreinoDivisoesF')}}" class="btn btn-success">Treino F</a></h5>
                    </div>
                @endif
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
