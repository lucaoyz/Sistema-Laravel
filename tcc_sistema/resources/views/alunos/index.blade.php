@extends('alunos.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 9 CRUD</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('alunos.create') }}"> Crie um novo aluno</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Idade</th>
            <th>Endereço</th>
            <th>Telefone ou Celular</th>
            <th>CPF</th>
            <th width="280px">Ação</th>
        </tr>
        @foreach ($alunos as $aluno)
        <tr>
            <td>{{ $aluno->id }}</td>
            <td>{{ $aluno->alu_nome }}</td>
            <td>{{ $aluno->alu_email }}</td>
            <td>{{ $aluno->alu_idade }}</td>
            <td>{{ $aluno->alu_endereco }}</td>
            <td>{{ $aluno->alu_celular }}</td>
            <td>{{ $aluno->alu_cpf }}</td>
            <td>
                <form action="{{ route('alunos.destroy',$aluno->id) }}" method="POST">

                    <a class="btn btn-info" href="{{ route('alunos.show',$aluno->id) }}">Mostrar</a>

                    <a class="btn btn-primary" href="{{ route('alunos.edit',$aluno->id) }}">Editar</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    {!! $alunos->links() !!}

@endsection
