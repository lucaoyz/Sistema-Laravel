@extends('admin.layoutsModals.layouts')
@section('title', 'Avaliação Física')
@section('treino', 'active bg-gradient-primary')
@section('pagina', 'Usuários - Avaliação Física')
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
        <!-- Avaliação Física -->
      <div class="row">
        <div class="col-12">
            <a class="btn btn-outline-primary" href="{{route('admin.usuarios')}}">Voltar</a>

          <div class="card my-4">

            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Avaliação Física</h6>
              </div>
              <br>
              <!-- Botão de criar -->
            <div class="pull-right">
                <h5 class="mb-0"><a href="" data-bs-toggle="modal" data-bs-target="#criarAvaliacaoFisica" class="btn btn-success">Cadastre uma avaliação física</a>
            </div>
            </div>

            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <!-- Dados que vão ser coletados -->
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nome do aluno</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">KG</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">IMC</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Data da avaliação</th>
                            <th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7">Ações</th>
                        </tr>
                    </thead>

                  <tbody>
                    <!-- Laço de repetição da avaliação fisica -->
                    <tr>

                        <!--  -->
                       <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"></h6>
                          </div>
                        </div>
                      </td>

                       <!--  -->
                       <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"></h6>
                          </div>
                        </div>
                      </td>

                      <!--  -->
                      <td>
                        <p class="text-sm font-weight-bold mb-0"></p>
                      </td>

                      <!--  -->
                      <td>
                        <p class="text-sm font-weight-bold mb-0"></p>
                      </td>

                      <!-- Botoes de ação -->
                      <td class="align-middle">

                            <!-- Visualizar -->
                            <a class="btn btn-info" href="" data-bs-toggle="modal" data-bs-target="#">Visualizar</a>


                            <!-- Editar -->
                            <a class="btn btn-secondary" href="" data-bs-toggle="modal" data-bs-target="#">Editar</a>

                            <!-- Remover -->
                            <a href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#">Excluir</a>

                        </td>
                    </tr>

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
@include('admin.layoutsModals.modalsAvaliacao')

@endsection
