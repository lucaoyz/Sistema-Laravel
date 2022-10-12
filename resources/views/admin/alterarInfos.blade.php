@extends('admin.layoutsModals.layouts')
@section('title', 'Dashboard - Alterar informações')
@section('dashboard', 'active bg-gradient-primary')
@section('pagina', 'Dashboard - Alterar informações')
@section('content')

<div class="row">
    <div class="col-md-4 mb-4">
      <div class="card shadow-lg">
        <span class="badge rounded-pill bg-light text-dark w-30 mt-n2 mx-auto">PLANOS</span>
        <div class="card-header text-center pt-4 pb-3">
        </div>
        <div class="card-body text-lg-start text-center pt-0">
          <div class="d-flex justify-content-lg-start justify-content-center p-2">
            <i class="material-icons my-auto">remove</i>
            <span class="ps-3">Plano 1:</span>
          </div>

          <div class="d-flex justify-content-lg-start justify-content-center p-2">
            <i class="material-icons my-auto">remove</i>
            <span class="ps-3">Plano 2:</span>
          </div>

          <div class="d-flex justify-content-lg-start justify-content-center p-2">
            <i class="material-icons my-auto">remove</i>
            <span class="ps-3">Plano 3:</span>
          </div>

          <div class="d-flex justify-content-lg-start justify-content-center p-2">
            <i class="material-icons my-auto">remove</i>
            <span class="ps-3">Plano 4:</span>
          </div>

          <a href="javascript:;" class="btn btn-icon bg-gradient-dark d-lg-block mt-3 mb-0">
            Alterar Preço
            <i class="fas fa-arrow-right ms-1"></i>
          </a>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card bg-gradient-dark shadow-lg">
        <span class="badge rounded-pill bg-primary w-30 mt-n2 mx-auto">TIME</span>
        <div class="card-header text-center pt-4 pb-3 bg-transparent">
        </div>
        <div class="card-body text-lg-start text-center pt-0">
          <div class="d-flex justify-content-lg-start justify-content-center p-2">
            <i class="material-icons my-auto text-white">remove</i>
            <span class="ps-3 text-white">nome do membro do time</span>
          </div>

          <a href="javascript:;" class="btn btn-icon bg-gradient-primary d-lg-block mt-3 mb-0">
            Adicionar ou editar membros do time
            <i class="fas fa-arrow-right ms-1"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
@endsection
