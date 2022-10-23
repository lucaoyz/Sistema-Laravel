@extends('admin.layoutsModals.layouts')
@section('title', 'Equipamentos')
@section('treino', 'active bg-gradient-primary')
@section('pagina', 'Treino - Equipamentos')
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
        <!-- Equipamentos -->
      <div class="row">
        <div class="col-12">
            <a class="btn btn-outline-primary" href="{{route('admin.financeiro')}}">Voltar</a>
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Tipos de pagamentos</h6>
              </div>
              <br>
              <!-- Botão de criar -->
            <div class="pull-right">
                <h5 class="mb-0"><a href="" data-bs-toggle="modal" data-bs-target="#criarTipoPagto" class="btn btn-success">Registre um novo tipo de pagamento</a></h5>
            </div>
            </div>

            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <!-- Dados que vão ser coletados -->
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tipo de pagamento</th>
                            <th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7">Ações</th>
                        </tr>
                    </thead>

                  <tbody>
                    <!-- Laço de repetição dos tipos de pagamentos -->
                    @foreach ($tipopagtos as $tipopagto)
                    <tr>

                        <!-- tpg_descricao -->
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $tipopagto->tpg_descricao }}</h6>
                          </div>
                        </div>
                      </td>

                      <!-- Botoes de ação -->
                      <td class="align-middle">
                            <!-- Editar -->
                            <a class="btn btn-secondary" href="" data-bs-toggle="modal" data-bs-target="#editarTipoPagto{{$tipopagto->id}}">Editar</a>

                            <!-- Remover -->
                            <a href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#excluirTipoPagto{{$tipopagto->id}}">Excluir</a>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <!-- Paginação com e sem filtros -->

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>



<!-- Modal -->


@endsection
