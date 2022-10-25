@extends('admin.layoutsModals.layouts')
@section('title', 'Financeiro')
@section('financeiro', 'active bg-gradient-primary')
@section('pagina', 'Financeiro')
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
        <div class="col-lg-8">
          <div class="row">
            <div class="col-xl-6">
              <div class="row">
                <div class="col-md-6 col-6">
                  <div class="card">
                    <div class="card-header mx-4 p-3 text-center">
                      <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                        <i class="material-icons opacity-10">account_balance</i>
                      </div>
                    </div>
                    <div class="card-body pt-0 p-3 text-center">
                      <h6 class="text-center mb-0">Contas a receber</h6>
                      <span class="text-xs">Saldo de contas a receber</span>
                      <hr class="horizontal dark my-3">
                      <h5 class="mb-0">R$ {{$saldoContaAReceberNaoRecebidos}} a receber</h5>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-6">
                  <div class="card">
                    <div class="card-header mx-4 p-3 text-center">
                      <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                        <i class="material-icons opacity-10">account_balance_wallet</i>
                      </div>
                    </div>
                    <div class="card-body pt-0 p-3 text-center">
                      <h6 class="text-center mb-0">Contas a pagar</h6>
                      <span class="text-xs">Saldo de contas a pagar</span>
                      <hr class="horizontal dark my-3">
                      <h5 class="mb-0">aqui vai a variavel</h5>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <div class="col-md-12 mb-lg-0 mb-4">
              <div class="card mt-4">
                <div class="card-header pb-0 p-3">
                  <div class="row">
                    <div class="col-6 d-flex align-items-center">
                      <h6 class="mb-0">Contas</h6>
                    </div>
                    <div class="col-6 text-end">
                      <a class="btn bg-gradient-dark mb-0" data-bs-toggle="modal" data-bs-target="#selecionarContaModal"><i class="material-icons text-sm">add</i>&nbsp;&nbsp;Adicionar nova conta</a>
                    </div>
                  </div>
                </div>
                <div class="card-body p-3">
                  <div class="row">
                    <div class="col-md-6 mb-md-0 mb-4">
                        <h6 class="mb-0">Contas a receber</h6>
                        @foreach ($contaAReceberNaoRecebidos as $contaAReceberNaoRecebido)
                      <div class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                        <a href="" class="material-icons text-danger"><i class="material-icons text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir Conta">delete</i></a>
                        <a href="" class="material-icons text-dark cursor-pointer"><i class="material-icons text-dark cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar conta">edit</i></a>
                        &nbsp; <h6 class="mb-0">{{$contaAReceberNaoRecebido->rec_descricao}} | R$ {{$contaAReceberNaoRecebido->rec_valor}}</h6>
                        &nbsp; <a href="" class="material-icons text-success cursor-pointer" data-bs-toggle="modal" data-bs-target="#confirmacaoContaAReceber{{$contaAReceberNaoRecebido->id}}"><i class="material-icons text-success cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="Marcar como recebido">check_circle</i></a>
                        </div>
                        @endforeach
                    </div>
                    <div class="col-md-6">
                        <h6 class="mb-0">Contas a pagar</h6>
                      <div class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                        <h6 class="mb-0">CONTA | PREÇO</h6>
                        <a href="" class="material-icons ms-auto text-dark cursor-pointer"><i class="material-icons ms-auto text-dark cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar conta">edit</i></a>
                        <a href="" class="material-icons ms-auto text-danger"><i class="material-icons ms-auto text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir Conta">delete</i></a>
                      </div>
                    </div>
                  </div>
                </div>
            <!-- Paginação com e sem filtros -->
            @if (isset($filters))
            {{ $contasAReceber->appends($filters)->links() }}
              @else
            {{ $contasAReceber->links() }}
            @endif
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <div class="row">
                <div class="col-6 d-flex align-items-center">
                  <h6 class="mb-0">Histórico de contas pagas</h6>
                </div>
                <div class="col-6 text-end">
                  <button class="btn btn-outline-primary btn-sm mb-0">Ver tudo</button>
                </div>
              </div>
            </div>
            <div class="card-body p-3 pb-0">
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex flex-column">
                    <h6 class="mb-1 text-dark font-weight-bold text-sm">DATA</h6>
                    <span class="text-xs">CONTA</span>
                  </div>
                  <div class="d-flex align-items-center text-sm">
                    R$PREÇO
                    <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><i class="material-icons text-lg position-relative me-1">picture_as_pdf</i> PDF</button>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md mt-4">
          <div class="card h-100 mb-4">
            <div class="card-header pb-0 px-3">
              <div class="row">
                <div class="col-md-6">
                  <h6 class="mb-0">Entradas</h6>
                </div>
                <div class="col-md-6 d-flex justify-content-start justify-content-md-end align-items-center">
                  <i class="material-icons me-2 text-lg">date_range</i>
                  <small>DATA ATÉ QUE DATA</small>
                </div>
              </div>
            </div>
            <div class="card-body pt-4 p-3">
              <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">HISTÓRICO DE ENTRADAS</h6>
              <ul class="list-group">
                @foreach ($contaAReceberRecebidos as $contaAReceberRecebido)
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                    <div class="d-flex align-items-center">
                      <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i class="material-icons text-lg">expand_less</i></button>
                      <div class="d-flex flex-column">
                        <h6 class="mb-1 text-dark text-sm">{{$contaAReceberRecebido->rec_descricao}}</h6>
                        <span class="text-xs">{{$contaAReceberRecebido->rec_data->format('d/m/Y')}}</span>
                      </div>
                    </div>
                    <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                      + R$ {{$contaAReceberRecebido->rec_valor}}
                    </div>
                  </li>
                  @endforeach
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

          <!-- Modal -->
          @include('admin.layoutsModals.modalsFinanceiro')

    @endsection
