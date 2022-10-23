@extends('admin.layoutsModals.layouts')
@section('title', 'Tipo de pagamentos')
@section('financeiro', 'active bg-gradient-primary')
@section('pagina', 'Financeiro - Tipos de Pagamentos')
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
            <!-- Filtro -->
            <div class="card-header-tabs p-0 mt-n4 mx-3 border-radius-lg" style="background-color: #fff;">
                <form action="{{route('admin.financeiro.tipopagto.search')}}" method="post">
                    @csrf
                    <div class="input-group input-group-outline my-3">
                        <a class="btn btn-outline-primary" href="{{route('admin.financeiro')}}">Voltar</a>
                        <!-- Campo de texto para digitar oque será filtrado -->
                        <input type="text" name="search" class="form-control" style="max-height: 42.5px" placeholder="Filtrar por tipo de pagamento">
                        <!-- Botão para filtrar -->
                        <button class="btn btn-primary" type="submit">Filtrar</button>
                        <!-- Botão para limpar filtro -->
                        <a class="btn btn-outline-secondary" href="{{route('admin.financeiro.tipopagto.index')}}">Limpar filtro</a>
                      </div>
                </form>
                </div>
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
                    @foreach ($tipoPagtos as $tipoPagto)
                    <tr>

                        <!-- tpg_descricao -->
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $tipoPagto->tpg_descricao }}</h6>
                          </div>
                        </div>
                      </td>

                      <!-- Botoes de ação -->
                      <td class="align-middle">
                            <!-- Editar -->
                            <a class="btn btn-secondary" href="" data-bs-toggle="modal" data-bs-target="#editarTipoPagto{{$tipoPagto->id}}">Editar</a>

                            <!-- Remover -->
                            <a href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#excluirTipoPagto{{$tipoPagto->id}}">Excluir</a>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <!-- Paginação com e sem filtros -->
                @if (isset($filters))
                        {{ $tipoPagtos->appends($filters)->links() }}
                    @else
                        {{ $tipoPagtos->links() }}
                @endif

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>



      <!-- Modal -->
      @include('admin.layoutsModals.modalsTipoPagto')

@endsection
