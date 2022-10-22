@extends('professor.layoutsModals.layouts')
@section('title', 'Exercicios')
@section('treino', 'active bg-gradient-primary')
@section('pagina', 'Treino - Exercícios')
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
        <!-- Exercícios -->
      <div class="row">
        <div class="col-12">
            <!-- Filtro -->
            <div class="card-header-tabs p-0 mt-n4 mx-3 border-radius-lg" style="background-color: #fff;">
            <form action="
                    @if (auth()->user()->type == 'admin')
                    {{route('exercicios.search')}}
                    @else
                    {{route('professor.exercicios.search')}}
                    @endif
                    " method="post">
                @csrf
                <div class="input-group input-group-outline my-3">
                    <a class="btn btn-outline-primary" href="
                    @if (auth()->user()->type == 'admin')
                    {{route('treinos.index')}}
                    @else
                    {{route('professor.treinos.index')}}
                    @endif
                    ">Voltar</a>
                    <!-- Campo de texto para digitar oque será filtrado -->
                    <input type="text" name="search" class="form-control" style="max-height: 42.5px" placeholder="Filtrar por nome, membro ou descrição">
                    <!-- Botão para filtrar -->
                    <button class="btn btn-primary" type="submit">Filtrar</button>
                    <!-- Botão para limpar filtro -->
                    <a class="btn btn-outline-secondary" href="
                    @if (auth()->user()->type == 'admin')
                    {{route('exercicios.index')}}
                    @else
                    {{route('professor.exercicios.index')}}
                    @endif
                    ">Limpar filtro</a>
                  </div>
            </form>
            </div>
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Exercicios</h6>
              </div>
              <br>
              <!-- Botão de criar -->
            <div class="pull-right">
                <h5 class="mb-0"><a href="" data-bs-toggle="modal" data-bs-target="#criarExercicioModal" class="btn btn-success">Registre um novo exercicio</a></h5>
            </div>
            </div>

            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <!-- Dados que vão ser coletados -->
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nome do Exercício</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Membro Muscular</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Descrição</th>
                            <th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7">Ações</th>
                        </tr>
                    </thead>

                  <tbody>
                    <!-- Laço de repetição dos alunos -->
                    @foreach ($exercicios as $exercicio)
                    <tr>

                        <!-- exe_nome -->
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $exercicio->exe_nome }}</h6>
                          </div>
                        </div>
                      </td>

                      <!-- exe_membro -->
                      <td>
                        <p class="text-xs font-weight-bold mb-0">{{ $exercicio->exe_membro }}</p>
                      </td>

                      <!-- exe_descricao -->
                      <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0">{{ $exercicio->exe_descricao }}</p>
                      </td>

                      <!-- Botoes de ação -->
                      <td class="align-middle">
                            <!-- Editar -->
                            <a class="btn btn-secondary" href="{{ route('exercicios.edit',$exercicio->id) }}" data-bs-toggle="modal" data-bs-target="#editarExercicioModal{{$exercicio->id}}">Editar</a>

                            <!-- Remover -->
                            <a href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#excluirExercicioModal{{$exercicio->id}}">Excluir</a>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <!-- Paginação com e sem filtros -->
                @if (isset($filters))
                        {{ $exercicios->appends($filters)->links() }}
                    @else
                        {{ $exercicios->links() }}
                    @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

<!-- Modal -->
@include('admin.layoutsModals.modalsExercicio')

@endsection
