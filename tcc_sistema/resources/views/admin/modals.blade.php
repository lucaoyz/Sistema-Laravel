<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <script type="text/javascript">
        function mascara(t, mask) {
            var i = t.value.length;
            var saida = mask.substring(1, 0);
            var texto = mask.substring(i)
            if (texto.substring(0, 1) != saida) {
                t.value += texto.substring(0, 1);
            }
        }

        function onlynumber(evt) {
            var theEvent = evt || window.event;
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode( key );
            //var regex = /^[0-9.,]+$/;
            var regex = /^[0-9.]+$/;
            if( !regex.test(key) ) {
                theEvent.returnValue = false;
                if(theEvent.preventDefault) theEvent.preventDefault();
             }
    }
    </script>

<!-- mostrar aluno -->
@foreach($alunos as $aluno)
<div class="modal fade" id="mostrarAlunoModal{{$aluno->id}}" tabindex="-1" role="dialog" aria-labelledby="mostrarAlunoModal{{$aluno->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="editarAlunoModal">Mostrar aluno</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Nome:</strong>
                        {{ $aluno->alu_nome }}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Email:</strong>
                        {{ $aluno->alu_email }}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Data de Nascimento:</strong>
                        {{ $aluno->alu_data_nascimento->format('d/m/Y') }}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Endereço:</strong>
                        {{ $aluno->alu_endereco }}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Telefone ou Celular:</strong>
                        {{ $aluno->alu_celular }}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Cpf:</strong>
                        {{ $aluno->alu_cpf }}
                    </div>
                </div>

            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>
  @endforeach

  <!-- Editar aluno -->

@foreach($alunos as $aluno)
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
<div class="modal fade" id="editarAlunoModal{{$aluno->id}}" tabindex="-1" role="dialog" aria-labelledby="editarAlunoModal{{$aluno->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 700px">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="editarAlunoModal">Editar</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
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
                            name="alu_data_nascimento" value="{{ $aluno->alu_data_nascimento->format('d/m/Y') }}" required autocomplete="alu_data_nascimento" autofocus
                            max="{{ now()->toDateString('d-m-Y') }}">

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
                            class="form-control" @error('alu_celular') is-invalid @enderror"
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
        </div>
        <div class="modal-footer">
            <div class="row mb-0">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Atualizar') }}
                    </button>
            </div>
        </div>
    </form>
      </div>
    </div>
  </div>
  @endforeach

    <!-- Criar aluno -->
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
<div class="modal fade" id="criarAlunoModal" tabindex="-1" role="dialog" aria-labelledby="criarAlunoModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 750px">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="editarAlunoModal">Criar</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
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
                        <label for="alu_data_nascimento" class="col-md-4 col-form-label text-md-end">{{ __('Data de Nascimento') }}</label>

                        <div class="col-md-6">
                            <input id="alu_data_nascimento" type="date"
                            class="form-control @error('alu_data_nascimento') is-invalid @enderror"
                            name="alu_data_nascimento" value="{{ old('alu_data_nascimento') }}" required autocomplete="alu_idade" autofocus
                            max="{{ now()->toDateString('d-m-Y') }}">

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
        </div>
        <div class="modal-footer">
            <div class="row mb-0">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Cadastrar') }}
                    </button>
            </div>
        </div>
    </form>
      </div>
    </div>
  </div>


