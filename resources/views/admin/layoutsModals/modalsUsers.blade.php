 <!-- Modal filtros -->
 <div class="modal fade" id="filtrosEspecificos" tabindex="-1" role="dialog" aria-labelledby="filtrosEspecificos" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title font-weight-normal" id="filtrosEspecificos">Filtros Específicos</h5>
           <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">

             <p>Qual filtro você deseja aplicar?</p>

         </div>
         <div class="modal-footer">
           <button type="button" class="btn bg-gradient-success">Alunos Ativos</button>
           <button type="button" class="btn bg-gradient-danger">Alunos Inativos</button>
           <button type="button" class="btn bg-gradient-info">Alunos com Treino</button>
           <button type="button" class="btn bg-gradient-danger" data-bs-dismiss="modal">Fechar</button>
         </div>
       </div>
     </div>
   </div>

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
          <h5 class="modal-title font-weight-normal" id="criarAlunoModal">Criar</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('alunos.store') }}" method="POST">
                @csrf


                    <div class="row mb-3">
                        <label for="alu_nome" class="col-md-4 col-form-label text-md-end">{{ __('*Nome') }}</label>

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
                        <label for="alu_email" class="col-md-4 col-form-label text-md-end">{{ __('*Endereço de email do aluno') }}</label>

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
                        <label for="alu_data_nascimento" class="col-md-4 col-form-label text-md-end">{{ __('*Data de Nascimento') }}</label>

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
                        <label for="alu_endereco" class="col-md-4 col-form-label text-md-end">{{ __('*Endereço') }}</label>

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
                        <label for="alu_celular" class="col-md-4 col-form-label text-md-end">{{ __('*Telefone ou Celular') }}</label>

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
                        <label for="alu_mensalidade" class="col-md-4 col-form-label text-md-end">{{ __('*Mensalidade R$') }}</label>

                        <div class="col-md-6">

                             <select name="alu_mensalidade" id="alu_mensalidade"
                            class="form-select @error('alu_mensalidade') is-invalid @enderror"
                            value="{{ old('alu_mensalidade') }}" required autocomplete="alu_mensalidade">
                                <option value="{{$plano1->pl_plano1}}">{{$plano1->pl_plano1}}</option>
                                <option value="{{$plano2->pl_plano2}}">{{$plano2->pl_plano2}}</option>
                                <option value="{{$plano3->pl_plano3}}">{{$plano3->pl_plano3}}</option>
                                <option value="{{$plano4->pl_plano4}}">{{$plano4->pl_plano4}}</option>
                            </select>

                            @error('alu_mensalidade')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="alu_cpf" class="col-md-4 col-form-label text-md-end">{{ __('*Cpf') }}</label>

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
                        <label for="id" class="col-md-4 col-form-label text-md-end">{{ __('ID') }}</label>

                        <div class="col-md-6">
                            <input id="id" type="text" {{ $aluno->id ? 'readonly' : '' }}
                            class="form-control @error('id') is-invalid @enderror"
                            name="id" value="{{ $aluno->id }}" required autocomplete="id" autofocus>

                            @error('id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

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
                            name="alu_data_nascimento" value="{{ $aluno->alu_data_nascimento->format('Y-m-d') }}" required autocomplete="alu_data_nascimento" autofocus
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
                        <label for="alu_mensalidade" class="col-md-4 col-form-label text-md-end">{{ __('Mensalidade') }}</label>

                        <div class="col-md-6">

                            <select name="alu_mensalidade" id="alu_mensalidade"
                            class="form-select @error('alu_mensalidade') is-invalid @enderror"
                            required autocomplete="alu_mensalidade">
                                <option value="{{$aluno->alu_mensalidade}}" selected>{{$aluno->alu_mensalidade}}</option>
                                <optgroup label="Mensalidades Atuais">
                                    <option value="{{$plano1->pl_plano1}}" @if($aluno->alu_mensalidade == $plano1->pl_plano1) selected @endif>{{$plano1->pl_plano1}}</option>
                                    <option value="{{$plano2->pl_plano2}}" @if($aluno->alu_mensalidade == $plano2->pl_plano2) selected @endif>{{$plano2->pl_plano2}}</option>
                                    <option value="{{$plano3->pl_plano3}}" @if($aluno->alu_mensalidade == $plano3->pl_plano3) selected @endif>{{$plano3->pl_plano3}}</option>
                                    <option value="{{$plano4->pl_plano4}}" @if($aluno->alu_mensalidade == $plano4->pl_plano4) selected @endif>{{$plano4->pl_plano4}}</option>
                                </optgroup>
                            </select>

                            @error('alu_mensalidade')
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

  <!-- Modal de remover aluno -->
@foreach($alunos as $aluno)
<div class="modal fade" id="removerAlunoModal{{$aluno->id}}" tabindex="-1" role="dialog" aria-labelledby="removerAlunoModal{{$aluno->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="removerAlunoModal{{$aluno->id}}">Remover aluno</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <p>Qual ação você deseja fazer com esse aluno?</p>
            <form action="{{ route('alunos.inativar',$aluno->id) }}" method="POST">

                @csrf
                @method('DELETE')

        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-danger">Remover acesso</button>
        </form>
            <form action="{{ route('alunos.destroy',$aluno->id) }}" method="POST">

                @csrf
                @method('DELETE')

          <button type="submit" class="btn btn-danger">Remover por completo</button>
        </form>
        </div>
      </div>
    </div>
</div>
@endforeach

  <!-- PROFESSOR // PERSONAL -->

  <!-- criar professor // PERSONAL-->
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
<div class="modal fade" id="criarPersonalModal" tabindex="-1" role="dialog" aria-labelledby="criarPersonalModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 750px">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="criarPersonalModal">Criar</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('personals.store') }}" method="POST">
                @csrf


                    <div class="row mb-3">
                        <label for="per_nome" class="col-md-4 col-form-label text-md-end">{{ __('Nome') }}</label>

                        <div class="col-md-6">
                            <input id="per_nome" type="text"
                            class="form-control @error('per_nome') is-invalid @enderror"
                            name="per_nome" value="{{ old('per_nome') }}" required autocomplete="per_nome" autofocus
                            placeholder="Insira o nome completo do professor aqui">

                            @error('per_nome')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="per_email" class="col-md-4 col-form-label text-md-end">{{ __('Endereço de email do professor') }}</label>

                        <div class="col-md-6">
                            <input id="per_email" type="email"
                             class="form-control @error('per_email') is-invalid @enderror"
                              name="per_email" value="{{ old('per_email') }}" required autocomplete="per_email"
                              placeholder="Insira o endereço de email do professor aqui">

                            @error('per_email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="per_data_nascimento" class="col-md-4 col-form-label text-md-end">{{ __('Data de Nascimento') }}</label>

                        <div class="col-md-6">
                            <input id="per_data_nascimento" type="date"
                            class="form-control @error('per_data_nascimento') is-invalid @enderror"
                            name="per_data_nascimento" value="{{ old('per_data_nascimento') }}" required autocomplete="per_idade" autofocus
                            max="{{ now()->toDateString('d-m-Y') }}">

                            @error('per_data_nascimento')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="per_endereco" class="col-md-4 col-form-label text-md-end">{{ __('Endereço') }}</label>

                        <div class="col-md-6">
                            <input id="per_endereco" type="text"
                             class="form-control @error('per_endereco') is-invalid @enderror"
                             name="per_endereco" value="{{ old('per_endereco') }}" required autocomplete="per_endereco" autofocus
                             placeholder="Insira o endereço do professor aqui">

                            @error('per_endereco')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="per_celular" class="col-md-4 col-form-label text-md-end">{{ __('Telefone ou Celular') }}</label>

                        <div class="col-md-6">
                            <input id="per_celular" type="tel"
                             class="form-control @error('per_celular') is-invalid @enderror"
                             name="per_celular" value="{{ old('per_celular') }}" required autocomplete="per_celular" autofocus
                             onkeypress="mascara(this, '## #########'); return onlynumber();" maxlength="12"
                             placeholder="Insira o numero de telefone ou celular do professor aqui">

                            @error('per_celular')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="per_cpf" class="col-md-4 col-form-label text-md-end">{{ __('Cpf') }}</label>

                        <div class="col-md-6">
                            <input id="per_cpf" type="text"
                            class="form-control @error('per_cpf') is-invalid @enderror"
                            name="per_cpf" value="{{ old('per_cpf') }}" required autocomplete="per_cpf" autofocus
                            onkeypress="mascara(this, '###.###.###-##'); return onlynumber();" maxlength="14"
                            placeholder="Insira o cpf do professor aqui">

                            @error('per_cpf')
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

  <!-- Editar professor / personal -->

@foreach($personals as $personal)
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
<div class="modal fade" id="editarPersonalModal{{$personal->id}}" tabindex="-1" role="dialog" aria-labelledby="editarPersonalModal{{$personal->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 700px">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="editarPersonalModal">Editar</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('personals.update',$personal->id) }}" method="POST">
                @csrf
                @method('PUT')


                    <div class="row mb-3">
                        <label for="id" class="col-md-4 col-form-label text-md-end">{{ __('ID') }}</label>

                        <div class="col-md-6">
                            <input id="id" type="text" {{ $personal->id ? 'readonly' : '' }}
                            class="form-control @error('id') is-invalid @enderror"
                            name="id" value="{{ $personal->id }}" required autocomplete="id" autofocus>

                            @error('id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="per_nome" class="col-md-4 col-form-label text-md-end">{{ __('Nome') }}</label>

                        <div class="col-md-6">
                            <input id="per_nome" type="text"
                             class="form-control @error('per_nome') is-invalid @enderror"
                              name="per_nome" value="{{ $personal->per_nome }}" required autocomplete="per_nome" autofocus>

                            @error('per_nome')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Endereço de email do professor') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email"
                            class="form-control @error('email') is-invalid @enderror"
                             name="per_email" value="{{ $personal->per_email }}" required autocomplete="per_email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="per_data_nascimento" class="col-md-4 col-form-label text-md-end">{{ __('Data de Nascimento') }}</label>

                        <div class="col-md-6">
                            <input id="per_data_nascimento" type="date"
                            class="form-control @error('per_data_nascimento') is-invalid @enderror"
                            name="per_data_nascimento" value="{{ $personal->per_data_nascimento->format('Y-m-d') }}" required autocomplete="per_data_nascimento" autofocus
                            max="{{ now()->toDateString('d-m-Y') }}">

                            @error('per_data_nascimento')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="per_endereco" class="col-md-4 col-form-label text-md-end">{{ __('Endereço') }}</label>

                        <div class="col-md-6">
                            <input id="per_endereco" type="text"
                            class="form-control @error('per_endereco') is-invalid @enderror"
                            name="per_endereco" value="{{ $personal->per_endereco }}" required autocomplete="per_endereco" autofocus>

                            @error('per_endereco')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="per_celular" class="col-md-4 col-form-label text-md-end">{{ __('Telefone ou Celular') }}</label>

                        <div class="col-md-6">
                            <input id="per_celular" type="text"
                            class="form-control" @error('per_celular') is-invalid @enderror"
                            name="per_celular" value="{{ $personal->per_celular }}" required autocomplete="per_celular" autofocus
                            onkeypress="mascara(this, '## #########'); return onlynumber();" maxlength="12">

                            @error('per_celular')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="per_cpf" class="col-md-4 col-form-label text-md-end">{{ __('Cpf') }}</label>

                        <div class="col-md-6">
                            <input id="per_cpf" type="text"
                             class="form-control @error('per_cpf') is-invalid @enderror"
                             name="per_cpf" value="{{ $personal->per_cpf }}" required autocomplete="per_cpf" autofocus
                             onkeypress="mascara(this, '###.###.###-##'); return onlynumber();" maxlength="14">

                            @error('per_cpf')
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

 <!-- Modal de remover personal // professor -->
 @foreach($personals as $personal)
 <div class="modal fade" id="removerPersonalModal{{$personal->id}}" tabindex="-1" role="dialog" aria-labelledby="removerPersonalModal{{$personal->id}}" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title font-weight-normal" id="removerPersonalModal{{$personal->id}}">Remover professor</h5>
           <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">

             <p>Qual ação você deseja fazer com esse professor?</p>
             <form action="{{ route('personals.inativar',$personal->id) }}" method="POST">

                 @csrf
                 @method('DELETE')

         </div>
         <div class="modal-footer">
           <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cancelar</button>
           <button type="submit" class="btn btn-danger">Remover acesso</button>
            </form>
             <form action="{{ route('personals.destroy',$personal->id) }}" method="POST">

                 @csrf
                 @method('DELETE')

           <button type="submit" class="btn btn-danger">Remover por completo</button>
         </form>
         </div>
       </div>
     </div>
   </div>
 @endforeach



