@extends('admin.layoutsModals.layouts')
@section('title', 'Treino D')
@section('treino', 'active bg-gradient-primary')
@section('pagina', 'Treino - Treino D')
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
        <!-- Treino D -->
      <div class="row">
        <div class="col-12">
            <!-- Filtro -->
            <div class="card-header-tabs p-0 mt-n4 mx-3 border-radius-lg" style="background-color: #fff;">
            <form action="{{route('treinos.searchDetalhesDivisaoD', $treinoGeral->id)}}" method="post">
                @csrf
                <div class="input-group input-group-outline">
                    <a class="btn btn-outline-primary" href="{{ route('treinos.indexDetalhes',$treinoGeral->id) }}">Voltar</a>
                    <!-- Campo de texto para digitar oque será filtrado -->
                    <!-- <input type="text" name="search" class="form-control" style="max-height: 42.5px" placeholder="Filtrar por nome de exercício ou membro muscular"> -->
                    <select name="search" id="search"
                            class="form-control" style="height: 100%"
                            required autocomplete="search">
                                <option value="">Selecione o membro muscular aqui...</option>
                                <option value="peito">Peito</option>
                                <option value="costas">Costas</option>
                                <option value="biceps">Biceps</option>
                                <option value="triceps">Triceps</option>
                                <option value="antebraco">Antebraço</option>
                                <option value="ombro">Ombro</option>
                                <option value="trapezio">Trapezio</option>
                                <option value="inferior">Inferior</option>
                                <option value="lombar">Lombar</option>
                                <option value="abdomen">Abdomen</option>
                            </select>
                    <!-- Botão para filtrar -->
                    <button class="btn btn-primary" type="submit">Filtrar</button>
                    <!-- Botão para limpar filtro -->
                    <a class="btn btn-outline-secondary" href="">Limpar filtro</a>
                  </div>
            </form>
            </div>
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Treino D</h6>
              </div>
              <br>
              <!-- Botão de criar -->
            <div class="pull-right">
                <h5 class="mb-0"><a href="" data-bs-toggle="modal" data-bs-target="#criarTreinoDetalhesDivisaoD" class="btn btn-success">Registre um exercício</a>
                    <a href="{{route('aluno.PDFTreinoDivisoesDTreinador', $treinoGeral->id)}}" class="btn btn-primary">Visualize como o aluno baixará o treino</a>
                    <a href="" data-bs-toggle="modal" data-bs-target="#selecionarExcel" class="btn btn-success" style="background-color:darkgreen">Excel</a></h5>
            </div>
            </div>

            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <!-- Dados que vão ser coletados -->
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nº</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Equipamento</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nome do exercício</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Membro Muscular</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Series</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Repetições</th>
                            <th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7">Ações</th>
                        </tr>
                    </thead>

                  <tbody>
                    <!-- Laço de repetição do treino geral -->
                    @foreach ($treinoDetalhes as $treinoDetalhe)
                    <tr>

                        <!-- td_numero -->
                        <td>
                            <div class="d-flex px-2 py-1">
                              <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">{{ $treinoDetalhe->td_numero }}</h6>
                              </div>
                            </div>
                          </td>

                       <!-- eq_nome -->
                       <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $treinoDetalhe->eq_nome }}{{--COLOCAR O NOME AO INVES DO ID PARA APARECER--}}</h6>
                          </div>
                        </div>
                      </td>

                      <!-- exe_nome -->
                      <td>
                        <p class="text-sm font-weight-bold mb-0">{{ $treinoDetalhe->exe_nome }}{{--COLOCAR O NOME AO INVES DO ID PARA APARECER--}}</p>
                      </td>

                      <!-- exe_membro -->
                      <td>
                        <p class="text-sm font-weight-bold mb-0">{{ $treinoDetalhe->exe_membro }}{{--COLOCAR O NOME AO INVES DO ID PARA APARECER--}}</p>
                      </td>

                      <!-- td_series -->
                      <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0">{{ $treinoDetalhe->td_series }}</p>
                      </td>

                      <!-- td_repeticoes -->
                      <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0">{{ $treinoDetalhe->td_repeticoes }}</p>
                      </td>

                      <!-- Botoes de ação -->
                      <td class="align-middle">



                            <!-- Editar -->
                            <a class="btn btn-secondary" href="" data-bs-toggle="modal" data-bs-target="#editarTreinoDetalhesDivisaoD{{$treinoDetalhe->id}}{{$treinoGeral->id}}">Editar</a>

                            <!-- Remover -->
                            <a href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#excluirTreinoDetalhesDivisaoD{{$treinoGeral->id}}{{$treinoDetalhe->id}}">Excluir</a>

                            @if ($treinoDetalhe->exe_descricao == null)
                            @else
                                <!-- Detalhes -->
                                <a class="btn btn-info" href="" data-bs-toggle="modal" data-bs-target="#obsTreinoDetalhesDivisaoD{{$treinoDetalhe->id}}{{$treinoGeral->id}}">Observações</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <!-- Paginação com e sem filtros -->
                @if (isset($filters))
                {{ $treinoDetalhes->appends($filters)->links() }}
            @else
                {{ $treinoDetalhes->links() }}
            @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

<!-- Modal -->
@include('admin.layoutsModals.modalsDivisoes')
@include('admin.layoutsModals.modalsExcel')

@endsection
