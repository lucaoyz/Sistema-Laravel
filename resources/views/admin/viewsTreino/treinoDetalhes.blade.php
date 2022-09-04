@extends('admin.layoutsModals.layouts')
@section('title', 'Detalhes do Treino')
@section('treino', 'active bg-gradient-primary')
@section('pagina', 'Treino - Detalhes do Treino')
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
            <a class="btn btn-outline-primary" href="{{route('treinos.indexGeral')}}">Voltar</a>
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Detalhes do Treino</h6>
          </div>
          <br>
        </div>

        <div class="card-body px-0 pb-2 position-relative mt-n4 mx-3">
            <div class="table-responsive p-0">
                @if ($treinoGeralDivisoes === 'A')
                    <div class="pull-right">
                        <h5 class="mb-0"><a href="{{route('treinos.createDetalhesDivisaoA', $treinoGeral->id)}}" class="btn btn-success">Treino A</a></h5>
                    </div>

                @endif

                @if ($treinoGeralDivisoes === 'AB')
                    <!-- Divisão A -->
                    <div class="pull-right">
                        <h5 class="mb-0"><a href="{{route('treinos.createDetalhesDivisaoA', $treinoGeral->id)}}" class="btn btn-success">Treino A</a></h5>
                    </div>

                    <!-- Divisão B -->
                    <div class="pull-right">
                        <h5 class="mb-0"><a href="{{route('treinos.createDetalhesDivisaoB', $treinoGeral->id)}}" class="btn btn-success">Treino B</a></h5>
                    </div>
                @endif

                @if ($treinoGeralDivisoes === 'ABC')
                    <!-- Divisão A -->
                    <div class="pull-right">
                        <h5 class="mb-0"><a href="{{route('treinos.createDetalhesDivisaoA', $treinoGeral->id)}}" class="btn btn-success">Treino A</a></h5>
                    </div>

                    <!-- Divisão B -->
                    <div class="pull-right">
                        <h5 class="mb-0"><a href="{{route('treinos.createDetalhesDivisaoB', $treinoGeral->id)}}" class="btn btn-success">Treino B</a></h5>
                    </div>

                    <!-- Divisão C -->
                    <div class="pull-right">
                        <h5 class="mb-0"><a href="" class="btn btn-success">Treino C</a></h5>
                    </div>
                @endif

                @if ($treinoGeralDivisoes === 'ABCD')
                    <!-- Divisão A -->
                    <div class="pull-right">
                        <h5 class="mb-0"><a href="{{route('treinos.createDetalhesDivisaoA', $treinoGeral->id)}}" class="btn btn-success">Treino A</a></h5>
                    </div>

                    <!-- Divisão B -->
                    <div class="pull-right">
                        <h5 class="mb-0"><a href="{{route('treinos.createDetalhesDivisaoB', $treinoGeral->id)}}" class="btn btn-success">Treino B</a></h5>
                    </div>

                    <!-- Divisão C -->
                    <div class="pull-right">
                        <h5 class="mb-0"><a href="" data-bs-toggle="modal" data-bs-target="#criarTreinoGeralModal" class="btn btn-success">Treino C</a></h5>
                    </div>

                    <!-- Divisão D -->
                    <div class="pull-right">
                        <h5 class="mb-0"><a href="" data-bs-toggle="modal" data-bs-target="#criarTreinoGeralModal" class="btn btn-success">Treino D</a></h5>
                    </div>
                @endif

                @if ($treinoGeralDivisoes === 'ABCDE')
                    <!-- Divisão A -->
                    <div class="pull-right">
                        <h5 class="mb-0"><a href="{{route('treinos.createDetalhesDivisaoA', $treinoGeral->id)}}" class="btn btn-success">Treino A</a></h5>
                    </div>

                    <!-- Divisão B -->
                    <div class="pull-right">
                        <h5 class="mb-0"><a href="{{route('treinos.createDetalhesDivisaoB', $treinoGeral->id)}}" class="btn btn-success">Treino B</a></h5>
                    </div>

                    <!-- Divisão C -->
                    <div class="pull-right">
                        <h5 class="mb-0"><a href="" data-bs-toggle="modal" data-bs-target="#criarTreinoGeralModal" class="btn btn-success">Treino C</a></h5>
                    </div>

                    <!-- Divisão D -->
                    <div class="pull-right">
                        <h5 class="mb-0"><a href="" data-bs-toggle="modal" data-bs-target="#criarTreinoGeralModal" class="btn btn-success">Treino D</a></h5>
                    </div>

                    <!-- Divisão E -->
                    <div class="pull-right">
                        <h5 class="mb-0"><a href="" data-bs-toggle="modal" data-bs-target="#criarTreinoGeralModal" class="btn btn-success">Treino E</a></h5>
                    </div>
                @endif

                @if ($treinoGeralDivisoes === 'ABCDEF')
                    <!-- Divisão A -->
                    <div class="pull-right">
                        <h5 class="mb-0"><a href="{{route('treinos.createDetalhesDivisaoA', $treinoGeral->id)}}" class="btn btn-success">Treino A</a></h5>
                    </div>

                    <!-- Divisão B -->
                    <div class="pull-right">
                        <h5 class="mb-0"><a href="{{route('treinos.createDetalhesDivisaoB', $treinoGeral->id)}}" class="btn btn-success">Treino B</a></h5>
                    </div>

                    <!-- Divisão C -->
                    <div class="pull-right">
                        <h5 class="mb-0"><a href="" data-bs-toggle="modal" data-bs-target="#criarTreinoGeralModal" class="btn btn-success">Treino C</a></h5>
                    </div>

                    <!-- Divisão D -->
                    <div class="pull-right">
                        <h5 class="mb-0"><a href="" data-bs-toggle="modal" data-bs-target="#criarTreinoGeralModal" class="btn btn-success">Treino D</a></h5>
                    </div>

                    <!-- Divisão E -->
                    <div class="pull-right">
                        <h5 class="mb-0"><a href="" data-bs-toggle="modal" data-bs-target="#criarTreinoGeralModal" class="btn btn-success">Treino E</a></h5>
                    </div>

                    <!-- Divisão F -->
                    <div class="pull-right">
                        <h5 class="mb-0"><a href="" data-bs-toggle="modal" data-bs-target="#criarTreinoGeralModal" class="btn btn-success">Treino F</a></h5>
                    </div>
                @endif
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
