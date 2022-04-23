@extends('admin.alunos.layout')

@section('content')



<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Criar novo aluno</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('alunos.index') }}"> Voltar</a>
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

<form action="{{ route('alunos.store') }}" method="POST">
    @csrf


        <div class="row mb-3">
            <label for="alu_nome" class="col-md-4 col-form-label text-md-end">{{ __('Nome') }}</label>

            <div class="col-md-6">
                <input id="alu_nome" type="text"
                class="form-control @error('alu_nome') is-invalid @enderror"
                name="alu_nome" value="{{ old('alu_nome') }}" required autocomplete="alu_nome" autofocus
                placeholder="Insira o nome completo do aluno aqui">

                @error('alu_nome')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="alu_email" class="col-md-4 col-form-label text-md-end">{{ __('Endereço de email do aluno') }}</label>

            <div class="col-md-6">
                <input id="alu_email" type="email"
                 class="form-control @error('alu_email') is-invalid @enderror"
                  name="alu_email" value="{{ old('alu_email') }}" required autocomplete="alu_email"
                  placeholder="Insira o endereço de email do aluno aqui">

                @error('alu_email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="alu_idade" class="col-md-4 col-form-label text-md-end">{{ __('Idade') }}</label>

            <div class="col-md-6">
                <input id="alu_idade" type="text"
                class="form-control @error('alu_idade') is-invalid @enderror"
                name="alu_idade" value="{{ old('alu_idade') }}" required autocomplete="alu_idade" autofocus
                onkeypress="return onlynumber();" maxlength="3"
                placeholder="Insira a idade do aluno aqui">

                @error('alu_idade')
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
                 name="alu_endereco" value="{{ old('alu_endereco') }}" required autocomplete="alu_endereco" autofocus
                 placeholder="Insira o endereço do aluno aqui">

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
                <input id="alu_celular" type="tel"
                 class="form-control @error('alu_celular') is-invalid @enderror"
                 name="alu_celular" value="{{ old('alu_celular') }}" required autocomplete="alu_celular" autofocus
                 onkeypress="mascara(this, '## #########'); return onlynumber();" maxlength="12"
                 placeholder="Insira o numero de telefone ou celular do aluno aqui">

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
                name="alu_cpf" value="{{ old('alu_cpf') }}" required autocomplete="alu_cpf" autofocus
                onkeypress="mascara(this, '###.###.###-##'); return onlynumber();" maxlength="14"
                placeholder="Insira o cpf do aluno aqui">

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
                    {{ __('Cadastrar') }}
                </button>
            </div>
        </div>


</form>
@endsection
