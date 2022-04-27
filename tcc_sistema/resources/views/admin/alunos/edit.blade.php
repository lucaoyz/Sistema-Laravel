@extends('admin.alunos.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Editar alunos</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('alunos.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Pode haver problemas em seu formulário!<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('alunos.update',$aluno->id) }}" method="POST">
        @csrf
        @method('PUT')



            <div class="row mb-3">
                <label for="alu_nome" class="col-md-4 col-form-label text-md-end">{{ __('Nome') }}</label>

                <div class="col-md-6">
                    <input id="alu_nome" type="text"
                     class="form-control @error('alu_nome') is-invalid @enderror"
                      name="alu_nome" value="{{ $aluno->alu_nome }}" required autocomplete="alu_nome" autofocus>

                    @error('alu_nome')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Endereço de email do aluno') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email"
                    class="form-control @error('email') is-invalid @enderror"
                     name="alu_email" value="{{ $aluno->alu_email }}" required autocomplete="alu_email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="alu_data_nascimento" class="col-md-4 col-form-label text-md-end">{{ __('Data de Nascimento') }}</label>

                <div class="col-md-6">
                    <input id="alu_data_nascimento" type="date"
                    class="form-control @error('alu_data_nascimento') is-invalid @enderror"
                    name="alu_data_nascimento" value="{{ $aluno->alu_data_nascimento }}" required autocomplete="alu_data_nascimento" autofocus>

                    @error('alu_data_nascimento')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="alu_endereco" class="col-md-4 col-form-label text-md-end">{{ __('Endereço') }}</label>

                <div class="col-md-6">
                    <input id="alu_endereco" type="text"
                    class="form-control @error('alu_endereco') is-invalid @enderror"
                    name="alu_endereco" value="{{ $aluno->alu_endereco }}" required autocomplete="alu_endereco" autofocus>

                    @error('alu_endereco')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="alu_celular" class="col-md-4 col-form-label text-md-end">{{ __('Telefone ou Celular') }}</label>

                <div class="col-md-6">
                    <input id="alu_celular" type="text"
                    class="form-control @error('alu_celular') is-invalid @enderror"
                    name="alu_celular" value="{{ $aluno->alu_celular }}" required autocomplete="alu_celular" autofocus
                    onkeypress="mascara(this, '## #########'); return onlynumber();" maxlength="12">

                    @error('alu_celular')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="alu_cpf" class="col-md-4 col-form-label text-md-end">{{ __('Cpf') }}</label>

                <div class="col-md-6">
                    <input id="alu_cpf" type="text"
                     class="form-control @error('alu_cpf') is-invalid @enderror"
                     name="alu_cpf" value="{{ $aluno->alu_cpf }}" required autocomplete="alu_cpf" autofocus
                     onkeypress="mascara(this, '###.###.###-##'); return onlynumber();" maxlength="14">

                    @error('alu_cpf')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Atualizar') }}
                    </button>
                </div>
            </div>


    </form>
@endsection
