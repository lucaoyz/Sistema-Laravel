@extends('admin.layoutsModals.layouts')
@section('title', 'Informações Gerais do Treino')
@section('treino', 'active bg-gradient-primary')
@section('pagina', 'Treino - Informações Gerais do Treino')
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
        <!-- Treino geral -->
      <div class="row">
        <div class="col-12">
            <!-- Filtro -->
            <div class="card-header-tabs p-0 mt-n4 mx-3 border-radius-lg" style="background-color: #fff;">
            <form action="{{route('treinos.searchGeral')}}" method="post">
                @csrf
                <div class="input-group input-group-outline my-3">
                    <a class="btn btn-outline-primary" href="{{route('treinos.index')}}">Voltar</a>
                    <!-- Campo de texto para digitar oque será filtrado -->
                    <input type="text" name="search" class="form-control" style="max-height: 42.5px" placeholder="Filtrar por id de aluno">
                    <!-- Botão para filtrar -->
                    <button class="btn btn-primary" type="submit">Filtrar</button>
                    <!-- Botão para limpar filtro -->
                    <a class="btn btn-outline-secondary" href="{{route('treinos.indexGeral')}}">Limpar filtro</a>
                  </div>
            </form>
            </div>
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Informações Gerais do Treino</h6>
              </div>
              <br>
              <!-- Botão de criar -->
            <div class="pull-right">
                <h5 class="mb-0"><a href="" data-bs-toggle="modal" data-bs-target="#criarTreinoGeralModal" class="btn btn-success">Registre um novo treino</a></h5>
            </div>
            </div>

            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <!-- Dados que vão ser coletados -->
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nome do Professor</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nome do Aluno</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Data de início</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Dias por semana</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Data final</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Divisões</th>
                            <th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7">Ações</th>
                        </tr>
                    </thead>

                  <tbody>
                    <!-- Laço de repetição do treino geral -->
                    @foreach ($treinoGerals as $treinoGeral)
                    <tr>

                       <!-- per_id -->
                       <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $treinoGeral->per_nome }}{{--COLOCAR O NOME AO INVES DO ID PARA APARECER--}}</h6>
                          </div>
                        </div>
                      </td>

                      <!-- alu_id -->
                      <td>
                        <p class="text-sm font-weight-bold mb-0">{{ $treinoGeral->alu_nome }}{{--COLOCAR O NOME AO INVES DO ID PARA APARECER--}}</p>
                      </td>

                      <!-- tg_data_inicio -->
                      <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0">{{ $treinoGeral->tg_data_inicio->format('d/m/Y') }}</p>
                      </td>

                      <!-- tg_dias_semana -->
                      <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0">{{ $treinoGeral->tg_dias_semana }}</p>
                      </td>

                      <!-- tg_data_final -->
                      <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0">{{ $treinoGeral->tg_data_final->format('d/m/Y') }}</p>
                      </td>

                      <!-- tg_divisoes -->
                      <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0">{{ $treinoGeral->tg_divisoes }}</p>
                      </td>

                      <!-- Botoes de ação -->
                      <td class="align-middle">

                            <!-- Detalhes -->
                            <a class="btn btn-info" href="{{ route('treinos.indexDetalhes',$treinoGeral->id) }}">Detalhes</a>

                            <!-- Editar -->
                            <a class="btn btn-secondary" href="{{ route('treinos.editGeral',$treinoGeral->id) }}" data-bs-toggle="modal" data-bs-target="#editarTreinoGeralModal{{$treinoGeral->id}}">Editar</a>

                            <!-- Remover -->
                            <a href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#excluirTreinoGeralModal{{$treinoGeral->id}}">Excluir</a>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <!-- Paginação com e sem filtros -->
                @if (isset($filters))
                        {{ $treinoGerals->appends($filters)->links() }}
                    @else
                        {{ $treinoGerals->links() }}
                    @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>



<!-- Modal -->
@include('admin.layoutsModals.modalsTreino')

@endsection
