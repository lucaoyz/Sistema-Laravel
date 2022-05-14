<!-- NOTAS
    FROND-END/BACK-END
        ALUNOS/ALUNO    S
    PROFESSORES/PERSONALS
-->
@extends('admin.layouts')
@section('title', 'Usuarios')
@section('usuarios', 'active bg-gradient-primary')
@section('pagina', 'Usuarios')
@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

    <div class="container-fluid py-4">
        <!-- Alunos -->
      <div class="row">
        <div class="col-12">
            <!-- Filtro -->
            <div class="card-header-tabs p-0 mt-n4 mx-3 border-radius-lg" style="background-color: #fff;">
            <form action="{{route('usuarios.search')}}" method="post">
                @csrf
                <div class="input-group input-group-outline my-3">
                    <!-- Campo de texto para digitar oque será filtrado -->
                    <input type="text" name="search" class="form-control" style="max-height: 42.5px" placeholder="Filtrar por nome, email ou cpf">
                    <!-- Botão para filtrar -->
                    <button class="btn btn-primary" type="submit">Filtrar</button>
                    <!-- Botão para limpar filtro -->
                    <a class="btn btn-outline-secondary" href="{{route('admin.usuarios')}}">Limpar filtro</a>
                  </div>
            </form>
            </div>
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Alunos</h6>
              </div>
              <br>
              <!-- Botão de criar -->
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('alunos.create') }}" data-bs-toggle="modal" data-bs-target="#criarAlunoModal"> Crie um novo aluno</a>
            </div>
            </div>

            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <!-- Dados que vão ser coletados -->
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nome</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">CPF</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Celular</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mensalidade</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Data de nascimento</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Endereço</th>
                            <th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7">Ações</th>
                        </tr>
                    </thead>

                  <tbody>
                    <!-- Laço de repetição dos alunos -->
                    @foreach ($alunos as $aluno)
                    <tr>

                        <!-- Nome e Email -->
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $aluno->alu_nome }}</h6>
                            <p class="text-xs text-secondary mb-0">{{ $aluno->alu_email }}</p>
                          </div>
                        </div>
                      </td>

                      <!-- Cpf -->
                      <td>
                        <p class="text-xs font-weight-bold mb-0">{{ $aluno->alu_cpf }}</p>
                      </td>

                      <!-- Telefone ou celular -->
                      <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0">{{ $aluno->alu_celular }}</p>
                      </td>

                      <!-- Mensalidade -->
                      <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0">{{('R$ ')}}{{ $aluno->alu_mensalidade }}</p>
                      </td>

                      <!-- Data de nascimento -->
                      <td class="align-middle text-center">
                        <span class="text-xs font-weight-bold mb-0">{{ $aluno->alu_data_nascimento->format('d/m/Y')}}</span>
                      </td>

                      <!-- Endereço -->
                      <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0">{{ $aluno->alu_endereco }}</p>
                      </td>

                      <!-- Botoes de ação -->
                      <td class="align-middle ">

                        <form action="{{ route('alunos.destroy',$aluno->id) }}" method="POST">

                            <!-- Mostrar -->
                            <a class="btn btn-info" href="{{ route('alunos.show',$aluno->id) }}" data-bs-toggle="modal" data-bs-target="#mostrarAlunoModal{{$aluno->id}}">Mostrar</a>

                            <!-- Editar -->
                            <a class="btn btn-primary" href="{{ route('alunos.edit',$aluno->id) }}"" data-bs-toggle="modal" data-bs-target="#editarAlunoModal{{$aluno->id}}">Editar</a>

                            <!-- Excluir -->
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <!-- Paginação com e sem filtros -->
                @if (isset($filters))
                        {{ $alunos->appends($filters)->links() }}
                    @else
                        {{ $alunos->links() }}
                    @endif
              </div>
            </div>
          </div>
        </div>
      </div>

<!-- Professores -->
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Professores</h6>
              </div>
              <br>
              <!-- Botão de criar -->
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('personals.create') }}" data-bs-toggle="modal" data-bs-target="#criarPersonalModal"> Crie um novo professor</a>
            </div>
            </div>

            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <!-- Tipos de dados que vão ser coletados -->
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nome</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">CPF</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Celular</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Data de nascimento</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Endereço</th>
                            <th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7">Ações</th>
                        </tr>
                    </thead>
                  <tbody>
                    <!-- Laço de repetição dos personals -->
                    @foreach ($personals as $personal)
                    <tr>
                        <!-- Nome e email -->
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $personal->per_nome }}</h6>
                            <p class="text-xs text-secondary mb-0">{{ $personal->per_email }}</p>
                          </div>
                        </div>
                      </td>

                      <!-- CPF -->
                      <td>
                        <p class="text-xs font-weight-bold mb-0">{{ $personal->per_cpf }}</p>
                      </td>

                      <!-- Celular -->
                      <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0">{{ $personal->per_celular }}</p>
                      </td>

                      <!-- Data de nascimento -->
                      <td class="align-middle text-center">
                        <span class="text-xs font-weight-bold mb-0">{{ $personal->per_data_nascimento->format('d/m/Y')}}</span>
                      </td>

                      <!-- Endereço -->
                      <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0">{{ $personal->per_endereco }}</p>
                      </td>

                      <!-- Botoes de ações -->
                      <td class="align-middle">

                        <form action="{{ route('personals.destroy',$personal->id) }}" method="POST">

                            <!-- Mostrar -->
                            <a class="btn btn-info" href="{{ route('personals.show',$personal->id) }}" data-bs-toggle="modal" data-bs-target="#mostrarPersonalModal{{$personal->id}}">Mostrar</a>

                            <!-- Editar -->
                            <a class="btn btn-primary" href="{{ route('personals.edit',$personal->id) }}" data-bs-toggle="modal" data-bs-target="#editarPersonalModal{{$personal->id}}">Editar</a>

                            <!-- Excluir -->
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <!-- Paginação com e sem filtros -->
                @if (isset($filters))
                        {{ $personals->appends($filters)->links() }}
                    @else
                        {{ $personals->links() }}
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endsection
  </main>

  <!-- Modal -->
  @extends('admin.modals')
</body>

</html>
