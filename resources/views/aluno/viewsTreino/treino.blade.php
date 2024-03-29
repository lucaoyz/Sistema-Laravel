@extends('aluno.layoutsModals.layouts')
@section('title', 'Treino')
@section('treino', 'active bg-gradient-primary')
@section('pagina', 'Treino')
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
    <div class="row">
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-header p-3 pt-2">
            <div class="pt-1">
              <p class="text-sm mb-0 text-capitalize">Imprimir</p>
              <h5 class="mb-0"><a href="" class="text-primary" data-bs-toggle="modal" data-bs-target="#imprimirTreino">Imprimir treino</a></h5>
            </div>
          </div>
          <hr class="dark horizontal my-0">
          <div class="card-footer p-3">
            <p class="mb-0"><span class="text-sm font-weight-bolder">
                <a href="" data-bs-toggle="modal" data-bs-target="#imprimirTreino">Clique aqui para imprimir seu treino.</a>
                </span></p>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-header p-3 pt-2">
            <div class="pt-1">
              <p class="text-sm mb-0 text-capitalize">Baixar</p>
              <h5 class="mb-0"><a href="{{route('aluno.PDFTreinoDivisoes')}}" class="text">Baixar treino</a></h5>
            </div>
          </div>
          <hr class="dark horizontal my-0">
          <div class="card-footer p-3">
            <p class="mb-0"><span class="text-sm font-weight-bolder">
                <a href="{{route('aluno.PDFTreinoDivisoes')}}">Clique aqui para baixar seu treino.</a>
                </span></p>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-header p-3 pt-2">
            <div class="pt-1">
              <p class="text-sm mb-0 text-capitalize">Treino</p>
              <h5 class="mb-0"><a href="{{route('aluno.treino.visualizar')}}" class="text-success">Visualize seu treino</a></h5>
            </div>
          </div>
          <hr class="dark horizontal my-0">
          <div class="card-footer p-3">
            <p class="mb-0"><span class="text-sm font-weight-bolder">
                <a href="{{route('aluno.treino.visualizar')}}">Clique aqui para visualizar seu treino.</a>
                </span></p>
          </div>
        </div>
      </div>
      @if ($historicoTreinoFirst == null)

      @else
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-header p-3 pt-2">
            <div class="pt-1">
              <p class="text-sm mb-0 text-capitalize">Histórico de treino</p>
              <h5 class="mb-0"><a href="" class="text-secondary" data-bs-toggle="modal" data-bs-target="#historicoTreino">Ultimo treino: <span class="text-primary">{{$historicoTreinoFirst}}</span></a></h5>
            </div>
          </div>
          <hr class="dark horizontal my-0">
          <div class="card-footer p-3">
            <p class="mb-0"><span class="text-sm font-weight-bolder">
                <a href="" data-bs-toggle="modal" data-bs-target="#historicoTreino">Veja os últimos treinos realizados.</a>
                </span></p>
          </div>
        </div>
      </div>
      @endif
      </div>
    </div>
  </div>
  <!-- Modal -->
    @include('aluno.layoutsModals.modalTreinos')

  @endsection


