@extends('admin.layouts')
@section('title', 'Usuarios')
@section('usuarios', 'active bg-gradient-primary')
@section('pagina', 'Usuarios')
@section('content')

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Alunos</h6>
              </div>
              <form action="{{route('alunos.search')}}" method="post">
                @csrf
                <div class="input-group input-group-outline my-3">
                    <input type="text" name="search" class="form-control" style="max-height: 42.5px" placeholder="Filtrar por nome, email ou cpf">
                    <button class="btn btn-primary" type="submit">Filtrar</button>
                    <a class="btn btn-outline-secondary" href="{{route('admin.usuarios')}}">Limpar filtro</a>
                  </div>
            </form>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('alunos.create') }}"> Crie um novo aluno</a>
            </div>
            </div>

            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
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
                    @foreach ($alunos as $aluno)
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $aluno->alu_nome }}</h6>
                            <p class="text-xs text-secondary mb-0">{{ $aluno->alu_email }}</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">{{ $aluno->alu_cpf }}</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0">{{ $aluno->alu_celular }}</p>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-xs font-weight-bold mb-0">{{ $aluno->alu_data_nascimento->format('d/m/Y')}}</span>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0">{{ $aluno->alu_endereco }}</p>
                      </td>
                      <td class="align-middle ">

                        <form action="{{ route('alunos.destroy',$aluno->id) }}" method="POST">

                            <a class="btn btn-info" href="{{ route('alunos.show',$aluno->id) }}" data-bs-toggle="modal" data-bs-target="#editarAlunoModal{{$aluno->id}}">Mostrar</a>

                            <a class="btn btn-primary" href="{{ route('alunos.edit',$aluno->id) }}">Editar</a>

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                      </td>
                    </tr>
                    @endforeach

                  </tbody>
                </table>
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
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Professores</h6>
              </div>
            </div>

            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nome</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">CPF</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Celular</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Data de nascimento</th>
                      <th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7">Ações</th>
                    </tr>
                  </thead>
                  <tbody>

                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Nome</h6>
                            <p class="text-xs text-secondary mb-0">Email</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">CPF</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0">Celular</p>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-xs font-weight-bold mb-0">{{ $aluno->alu_data_nascimento->format('d/m/Y')}}</span>
                      </td>
                      <td class="align-middle">

                        <form action="{{ route('alunos.destroy',$aluno->id) }}" method="POST">

                            <a class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editarAlunoModal{{$aluno->id}}">Mostrar</a>

                            <a class="btn btn-primary" href="{{ route('alunos.edit',$aluno->id) }}">Editar</a>

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                      </td>
                    </tr>

                  </tbody>
                </table>
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
