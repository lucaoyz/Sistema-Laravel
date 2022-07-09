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
            <!-- Filtro -->
            <div class="card-header-tabs p-0 mt-n4 mx-3 border-radius-lg" style="background-color: #fff;">
            <form action="{{route('equipamentos.search')}}" method="post">
                @csrf
                <div class="input-group input-group-outline my-3">
                    <a class="btn btn-outline-primary" href="{{route('treinos.index')}}">Voltar</a>
                    <!-- Campo de texto para digitar oque será filtrado -->
                    <input type="text" name="search" class="form-control" style="max-height: 42.5px" placeholder="Filtrar pelo nome do equipamento">
                    <!-- Botão para filtrar -->
                    <button class="btn btn-primary" type="submit">Filtrar</button>
                    <!-- Botão para limpar filtro -->
                    <a class="btn btn-outline-secondary" href="{{route('equipamentos.index')}}">Limpar filtro</a>
                  </div>
            </form>
            </div>
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Equipamentos</h6>
              </div>
              <br>
              <!-- Botão de criar -->
            <div class="pull-right">
                <h5 class="mb-0"><a href="" data-bs-toggle="modal" data-bs-target="#criarEquipamentoModal" class="btn btn-success">Registre um novo equipamento</a></h5>
            </div>
            </div>

            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <!-- Dados que vão ser coletados -->
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nome do equipamento</th>
                            <th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7">Ações</th>
                        </tr>
                    </thead>

                  <tbody>
                    <!-- Laço de repetição dos alunos -->
                    @foreach ($equipamentos as $equipamento)
                    <tr>

                        <!-- eq_nome -->
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $equipamento->eq_nome }}</h6>
                          </div>
                        </div>
                      </td>

                      <!-- Botoes de ação -->
                      <td class="align-middle">
                            <!-- Editar -->
                            <a class="btn btn-primary" href="{{ route('equipamentos.edit',$equipamento->id) }}" data-bs-toggle="modal" data-bs-target="#editarEquipamentoModal{{$equipamento->id}}">Editar</a>

                            <!-- Remover -->
                            <a href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#excluirEquipamentoModal{{$equipamento->id}}">Excluir</a>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <!-- Paginação com e sem filtros -->
                @if (isset($filters))
                        {{ $equipamentos->appends($filters)->links() }}
                    @else
                        {{ $equipamentos->links() }}
                    @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>



<!-- Modal -->
@include('admin.layoutsModals.modalsEquipamento')

@endsection
