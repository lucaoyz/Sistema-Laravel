
<!-- Criar exercicio -->
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
<div class="modal fade" id="criarExercicioModal" tabindex="-1" role="dialog" aria-labelledby="criarExercicioModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 750px">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="criarExercicioModal">Criar</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('exercicios.store') }}" method="POST" enctype="multipart/form-data">
                @csrf


                    <div class="row mb-3">
                        <label for="exe_nome" class="col-md-4 col-form-label text-md-end">{{ __('*Nome do exercício') }}</label>

                        <div class="col-md-6">
                            <input id="exe_nome" type="text"
                            class="form-control @error('exe_nome') is-invalid @enderror"
                            name="exe_nome" value="{{ old('exe_nome') }}" required autocomplete="exe_nome" autofocus
                            placeholder="Insira o nome do exercicio">

                            @error('exe_nome')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="exe_membro" class="col-md-4 col-form-label text-md-end">{{ __('*Membro muscular do exercício') }}</label>

                        <div class="col-md-6">
                            <select name="exe_membro" id="exe_membro"
                            class="form-select @error('exe_membro') is-invalid @enderror"
                            value="{{ old('exe_membro') }}" required autocomplete="exe_membro">
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

                            @error('exe_membro')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="exe_descricao" class="col-md-4 col-form-label text-md-end">{{ __('Descrição do exercício') }}</label>

                        <div class="col-md-6">
                            <input id="exe_descricao" type="text"
                             class="form-control @error('exe_descricao') is-invalid @enderror"
                              name="exe_descricao" value="{{ old('exe_descricao') }}" autocomplete="exe_descricao"
                              placeholder="Insira a descrição do exercício">

                            @error('exe_descricao')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="exe_foto" class="col-md-4 col-form-label text-md-end">{{ __('Foto do exercicio') }}</label>

                        <div class="col-md-6">
                            <input id="exe_foto" type="file"
                             class="form-control-sm @error('exe_foto') is-invalid @enderror"
                              name="exe_foto" value="{{ old('exe_foto') }}" autocomplete="exe_foto"
                              accept=".jpeg, .png, .jpg, .gif, .svg">

                            @error('exe_foto')
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

  <!-- editar exercicio -->
  @foreach($exercicios as $exercicio)
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
<div class="modal fade" id="editarExercicioModal{{$exercicio->id}}" tabindex="-1" role="dialog" aria-labelledby="editarExercicioModal{{$exercicio->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 700px">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="editarExercicioModal{{$exercicio->id}}">Editar</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('exercicios.update',$exercicio->id) }}" method="POST">
                @csrf
                @method('PUT')


                    <div class="row mb-3">
                        <label for="id" class="col-md-4 col-form-label text-md-end">{{ __('ID') }}</label>

                        <div class="col-md-6">
                            <input id="id" type="text" {{ $exercicio->id ? 'readonly' : '' }}
                            class="form-control @error('id') is-invalid @enderror"
                            name="id" value="{{ $exercicio->id }}" required autocomplete="id" autofocus>

                            @error('id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="exe_nome" class="col-md-4 col-form-label text-md-end">{{ __('Nome') }}</label>

                        <div class="col-md-6">
                            <input id="exe_nome" type="text"
                             class="form-control @error('exe_nome') is-invalid @enderror"
                              name="exe_nome" value="{{ $exercicio->exe_nome }}" required autocomplete="exe_nome" autofocus>

                            @error('exe_nome')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="exe_membro" class="col-md-4 col-form-label text-md-end">{{ __('Membro muscular') }}</label>

                        <div class="col-md-6">

                            <select name="exe_membro" id="exe_membro"
                            class="form-select @error('exe_membro') is-invalid @enderror"
                            required autocomplete="exe_membro">

                                <option value="peito" @if($exercicio->exe_membro == 'peito') selected @endif>Peito</option>
                                <option value="costas" @if($exercicio->exe_membro == 'costas') selected @endif>Costas</option>
                                <option value="biceps" @if($exercicio->exe_membro == 'biceps') selected @endif>Biceps</option>
                                <option value="triceps" @if($exercicio->exe_membro == 'triceps') selected @endif>Triceps</option>
                                <option value="antebraco" @if($exercicio->exe_membro == 'antebraco') selected @endif>Antebraço</option>
                                <option value="ombro" @if($exercicio->exe_membro == 'ombro') selected @endif>Ombro</option>
                                <option value="trapezio" @if($exercicio->exe_membro == 'trapezio') selected @endif>Trapezio</option>
                                <option value="inferior" @if($exercicio->exe_membro == 'inferior') selected @endif>Inferior</option>
                                <option value="lombar" @if($exercicio->exe_membro == 'lombar') selected @endif>Lombar</option>
                                <option value="abdomen" @if($exercicio->exe_membro == 'abdomen') selected @endif>Abdomen</option>

                            </select>

                            @error('exe_membro')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="exe_descricao" class="col-md-4 col-form-label text-md-end">{{ __('Descrição') }}</label>

                        <div class="col-md-6">
                            <input id="exe_descricao" type="text"
                             class="form-control @error('exe_descricao') is-invalid @enderror"
                              name="exe_descricao" value="{{ $exercicio->exe_descricao }}" autocomplete="exe_descricao" autofocus>

                            @error('exe_descricao')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="exe_foto" class="col-md-4 col-form-label text-md-end">{{ __('Foto do exercicio') }}</label>

                        <div class="col-md-6">
                            <input id="exe_foto" type="file"
                             class="form-control-sm @error('exe_foto') is-invalid @enderror"
                              name="exe_foto" value="{{ old('exe_foto') }}" autocomplete="exe_foto"
                              accept=".jpeg, .png, .jpg, .gif, .svg">
                              <img style="margin-top: 5px;" src="/img/exercicios/{{$exercicio->exe_foto}}" width="100px">

                            @error('exe_foto')
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

  <!-- Modal de excluir exercício -->
  @foreach($exercicios as $exercicio)
<div class="modal fade" id="excluirExercicioModal{{$exercicio->id}}" tabindex="-1" role="dialog" aria-labelledby="excluirExercicioModal{{$exercicio->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="excluirExercicioModal{{$exercicio->id}}">Excluir Exercício</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <p>Deseja excluir esse exercício?</p>
            <form action="{{ route('exercicios.destroy',$exercicio->id) }}" method="POST">

                @csrf
                @method('DELETE')

        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-danger">Excluir</button>
        </form>
        </div>
      </div>
    </div>
  </div>
@endforeach
