@extends('admin.layoutsModals.layouts')
@section('title', 'Início - Alterar informações')
@section('dashboard', 'active bg-gradient-primary')
@section('pagina', 'Início - Alterar informações')
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
            <span class="ps-3">Plano mensal: @if ($plano1 === null)
                Sem planos cadastrados.
            @else
                {{$plano1->pl_plano1}}
            @endif</span>
          </div>

          <div class="d-flex justify-content-lg-start justify-content-center p-2">
            <i class="material-icons my-auto">remove</i>
            <span class="ps-3">Plano trimestral: @if ($plano2 === null)
                Sem planos cadastrados.
            @else
                {{$plano2->pl_plano2}}
            @endif</span>
          </div>

          <div class="d-flex justify-content-lg-start justify-content-center p-2">
            <i class="material-icons my-auto">remove</i>
            <span class="ps-3">Plano semestral: @if ($plano3 === null)
                Sem planos cadastrados.
            @else
                {{$plano3->pl_plano3}}
            @endif</span>
          </div>

          <div class="d-flex justify-content-lg-start justify-content-center p-2">
            <i class="material-icons my-auto">remove</i>
            <span class="ps-3">Plano anual recorrente: @if ($plano4 === null)
                Sem planos cadastrados.
            @else
                {{$plano4->pl_plano4}}
            @endif</span>
          </div>

          <a data-bs-toggle="modal" data-bs-target="#alterarPlanos" class="btn btn-icon bg-gradient-dark d-lg-block mt-3 mb-0">
            Alterar Planos
            <i class="fas fa-arrow-right ms-1"></i>
          </a>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card bg-gradient-dark shadow-lg">
        <span class="badge rounded-pill bg-primary w-40 mt-n2 mx-auto">Painel Administrativo</span>
        <div class="card-header text-center pt-4 pb-3 bg-transparent">
        </div>
        <div class="card-body text-lg-start text-center pt-0">
          <div class="d-flex justify-content-lg-start justify-content-center p-2">

            <span class="ps-3 text-white">Altere os membros da equipe e a tabela de preços pelo painel administrativo</span>
          </div>

          <a href="https://site-gv2-painel-adm.herokuapp.com/login" class="btn btn-icon bg-gradient-primary d-lg-block mt-3 mb-0">
            Acesse o painel administrativo por aqui
            <i class="fas fa-arrow-right ms-1"></i>
          </a>
        </div>
      </div>
    </div>
  </div>

        <!-- Modal -->
        @include('admin.layoutsModals.modalsAlterarInfos')

@endsection
