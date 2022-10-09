@extends('professor.layoutsModals.layouts')
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
              <p class="text-sm mb-0 text-capitalize">Exercícios</p>
              <h5 class="mb-0"><a href="{{route('professor.exercicios.index')}}" class="text-success">Tela de Exercícios</a></h5>
            </div>
          </div>
          <hr class="dark horizontal my-0">
          <div class="card-footer p-3">
            <p class="mb-0"><span class="text-sm font-weight-bolder">
                Acesse a tela de exercícios.
                </span></p>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-header p-3 pt-2">
            <div class="pt-1">
              <p class="text-sm mb-0 text-capitalize">Equipamentos</p>
              <h5 class="mb-0"><a href="{{route('professor.equipamentos.index')}}" class="text-success">Tela de Equipamentos</a></h5>
            </div>
          </div>
          <hr class="dark horizontal my-0">
          <div class="card-footer p-3">
            <p class="mb-0"><span class="text-sm font-weight-bolder">
                Acesse a tela de equipamentos.
                </span></p>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-header p-3 pt-2">
            <div class="pt-1">
              <p class="text-sm mb-0 text-capitalize">Treinos</p>
              <h5 class="mb-0"><a href="{{route('professor.treinos.indexGeral')}}" class="text-success">Tela de Treinos</a></h5>
            </div>
          </div>
          <hr class="dark horizontal my-0">
          <div class="card-footer p-3">
            <p class="mb-0"><span class="text-sm font-weight-bolder">
                Acesse a tela de treinos.
                </span></p>
          </div>
        </div>
      </div>
      </div>
    </div>
  </div>
  @endsection


