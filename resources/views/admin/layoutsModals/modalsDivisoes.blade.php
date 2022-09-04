<!-- Modal de observação exercício A -->
@foreach($treinoDetalhes as $treinoDetalhe)
<div class="modal fade" id="obsTreinoDetalhesDivisaoA{{$treinoDetalhe->id}}{{$treinoGeral->id}}" tabindex="-1" role="dialog" aria-labelledby="obsTreinoDetalhesDivisaoA{{$treinoDetalhe->id}}{{$treinoGeral->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="obsTreinoDetalhesDivisaoA{{$treinoDetalhe->id}}{{$treinoGeral->id}}">Excluir Exercício</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <p>Observações do exercicio: </p><span style="font-style: bold;">{{$treinoDetalhe->exe_descricao}}</span>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>
@endforeach

<!-- Criar Divisao A -->
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
<div class="modal fade" id="criarTreinoDetalhesDivisaoA" tabindex="-1" role="dialog" aria-labelledby="criarTreinoDetalhesDivisaoA" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 750px">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="criarTreinoDetalhesDivisaoA">Criar</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('treinos.storeDetalhesDivisaoA', $treinoGeral->id) }}" method="POST">
                @csrf

                    <div class="row mb-3">
                        <label for="tre_id" class="col-md-4 col-form-label text-md-end">{{ __('Divisão') }}</label>

                        <div class="col-md-6">
                            <input id="td_divisao" type="text" {{ 'A' ? 'readonly' : '' }}
                            class="form-control @error('td_divisao') is-invalid @enderror"
                            name="td_divisao" value="A" required autocomplete="td_divisao" autofocus>

                            @error('td_divisao')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="eq_id" class="col-md-4 col-form-label text-md-end">{{ __('*Equipamento') }}</label>

                        <div class="col-md-6">
                            <select name="eq_id" id="eq_id"
                            class="form-select @error('eq_id') is-invalid @enderror"
                            value="{{ old('eq_id') }}" required autocomplete="eq_id">

                                @foreach ($equipamentos as $equipamento)
                                    <option
                                        value="{{ $equipamento['id'] }}"> {{ $equipamento['eq_nome'] }}
                                    </option>
                                @endforeach

                            </select>

                            @error('eq_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="exe_id" class="col-md-4 col-form-label text-md-end">{{ __('*Nome do Exercício') }}</label>

                        <div class="col-md-6">
                            <select name="exe_id" id="per_id"
                            class="form-select @error('exe_id') is-invalid @enderror"
                            value="{{ old('exe_id') }}" required autocomplete="alu_id">

                                @foreach ($exercicios as $exercicio)
                                    <option
                                        value="{{ $exercicio['id'] }}"> {{ $exercicio['exe_nome'] }}
                                    </option>
                                @endforeach

                            </select>

                            @error('exe_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="td_series" class="col-md-4 col-form-label text-md-end">{{ __('*Número de series') }}</label>

                        <div class="col-md-6">
                            <input id="td_series" type="text"
                            class="form-control @error('td_series') is-invalid @enderror"
                            name="td_series" value="{{ old('td_series') }}" required autocomplete="td_series" autofocus
                            placeholder="Insira o número de series"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">

                            @error('td_series')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="td_repeticoes" class="col-md-4 col-form-label text-md-end">{{ __('*Número de repetições') }}</label>

                        <div class="col-md-6">
                            <input id="td_repeticoes" type="text"
                            class="form-control @error('td_series') is-invalid @enderror"
                            name="td_repeticoes" value="{{ old('td_repeticoes') }}" required autocomplete="td_repeticoes" autofocus
                            placeholder="Insira o número de repetições"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">

                            @error('td_repeticoes')
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

  <!-- Editar Divisao A -->
  @foreach($treinoDetalhes as $treinoDetalhe)
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
<div class="modal fade" id="editarTreinoDetalhesDivisaoA{{$treinoDetalhe->id}}{{$treinoGeral->id}}" tabindex="-1" role="dialog" aria-labelledby="editarTreinoDetalhesDivisaoA{{$treinoDetalhe->id}}{{$treinoGeral->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 750px">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="editarTreinoDetalhesDivisaoA{{$treinoDetalhe->id}}">Editar</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('treinos.updateDetalhesDivisaoA', $treinoGeral->id, $treinoDetalhe->id) }}" method="POST">
                @csrf
                @method('PUT')

                    <div class="row mb-3">
                        <label for="id" class="col-md-4 col-form-label text-md-end">{{ __('ID') }}</label>

                        <div class="col-md-6">
                            <input id="id" type="text" {{ $treinoDetalhe->id ? 'readonly' : '' }}
                            class="form-control @error('id') is-invalid @enderror"
                            name="id" value="{{ $treinoDetalhe->id }}" required autocomplete="id" autofocus>

                            @error('id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="tre_id" class="col-md-4 col-form-label text-md-end">{{ __('Divisão') }}</label>

                        <div class="col-md-6">
                            <input id="td_divisao" type="text" {{ 'A' ? 'readonly' : '' }}
                            class="form-control @error('td_divisao') is-invalid @enderror"
                            name="td_divisao" value="{{ $treinoDetalhe->td_divisao }}" required autocomplete="td_divisao" autofocus>

                            @error('td_divisao')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="eq_id" class="col-md-4 col-form-label text-md-end">{{ __('*Equipamento') }}</label>

                        <div class="col-md-6">
                            <select name="eq_id" id="eq_id"
                            class="form-select @error('eq_id') is-invalid @enderror"
                            value="{{ old('eq_id') }}" required autocomplete="eq_id">

                                @foreach ($equipamentos as $equipamento)
                                    <option
                                        value="{{ $equipamento['id'] }}" @if($treinoDetalhe->eq_id == $equipamento->id) selected @endif> {{ $equipamento['eq_nome'] }}
                                    </option>
                                @endforeach

                            </select>

                            @error('eq_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="exe_id" class="col-md-4 col-form-label text-md-end">{{ __('*Nome do Exercício') }}</label>

                        <div class="col-md-6">
                            <select name="exe_id" id="per_id"
                            class="form-select @error('exe_id') is-invalid @enderror"
                            value="{{ old('exe_id') }}" required autocomplete="alu_id">

                                @foreach ($exercicios as $exercicio)
                                    <option
                                        value="{{ $exercicio['id'] }}" @if($treinoDetalhe->exe_id == $exercicio->id) selected @endif> {{ $exercicio['exe_nome'] }}
                                    </option>
                                @endforeach

                            </select>

                            @error('exe_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="td_series" class="col-md-4 col-form-label text-md-end">{{ __('*Número de series') }}</label>

                        <div class="col-md-6">
                            <input id="td_series" type="text"
                            class="form-control @error('td_series') is-invalid @enderror"
                            name="td_series" value="{{ $treinoDetalhe->td_series }}" required autocomplete="td_series" autofocus
                            placeholder="Insira o número de series"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">

                            @error('td_series')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="td_repeticoes" class="col-md-4 col-form-label text-md-end">{{ __('*Número de repetições') }}</label>

                        <div class="col-md-6">
                            <input id="td_repeticoes" type="text"
                            class="form-control @error('td_repeticoes') is-invalid @enderror"
                            name="td_repeticoes" value="{{ $treinoDetalhe->td_repeticoes }}" required autocomplete="td_repeticoes" autofocus
                            placeholder="Insira o número de repetições"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">

                            @error('td_repeticoes')
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
<!-- Modal de excluir treino detalhes A -->
@foreach($treinoDetalhes as $treinoDetalhe)
<div class="modal fade" id="excluirTreinoDetalhesDivisaoA{{$treinoGeral->id}}{{$treinoDetalhe->id}}" tabindex="-1" role="dialog" aria-labelledby="excluirTreinoDetalhesDivisaoA{{$treinoGeral->id}}{{$treinoDetalhe->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="excluirTreinoDetalhesDivisaoA{{$treinoGeral->id}}{{$treinoDetalhe->id}}">Excluir Exercício</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <p>Deseja excluir esse exercício?</p>
            <form action="{{ route('treinos.destroyDetalhesDivisaoA', ['treinoGeral' => $treinoGeral->id, 'treinoDetalhe' => $treinoDetalhe->id]) }}" method="POST">

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

<!-- modal de treino divisão B -->
<!-- Modal de observação exercício B -->
@foreach($treinoDetalhes as $treinoDetalhe)
<div class="modal fade" id="obsTreinoDetalhesDivisaoB{{$treinoDetalhe->id}}{{$treinoGeral->id}}" tabindex="-1" role="dialog" aria-labelledby="obsTreinoDetalhesDivisaoB{{$treinoDetalhe->id}}{{$treinoGeral->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="obsTreinoDetalhesDivisaoB{{$treinoDetalhe->id}}{{$treinoGeral->id}}">Excluir Exercício</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <p>Observações do exercicio: </p><span style="font-style: bold;">{{$treinoDetalhe->exe_descricao}}</span>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>
@endforeach

<!-- Criar Divisao B -->
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
<div class="modal fade" id="criarTreinoDetalhesDivisaoB" tabindex="-1" role="dialog" aria-labelledby="criarTreinoDetalhesDivisaoB" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 750px">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="criarTreinoDetalhesDivisaoB">Criar</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('treinos.storeDetalhesDivisaoB', $treinoGeral->id) }}" method="POST">
                @csrf

                    <div class="row mb-3">
                        <label for="tre_id" class="col-md-4 col-form-label text-md-end">{{ __('Divisão') }}</label>

                        <div class="col-md-6">
                            <input id="td_divisao" type="text" {{ 'B' ? 'readonly' : '' }}
                            class="form-control @error('td_divisao') is-invalid @enderror"
                            name="td_divisao" value="B" required autocomplete="td_divisao" autofocus>

                            @error('td_divisao')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="eq_id" class="col-md-4 col-form-label text-md-end">{{ __('*Equipamento') }}</label>

                        <div class="col-md-6">
                            <select name="eq_id" id="eq_id"
                            class="form-select @error('eq_id') is-invalid @enderror"
                            value="{{ old('eq_id') }}" required autocomplete="eq_id">

                                @foreach ($equipamentos as $equipamento)
                                    <option
                                        value="{{ $equipamento['id'] }}"> {{ $equipamento['eq_nome'] }}
                                    </option>
                                @endforeach

                            </select>

                            @error('eq_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="exe_id" class="col-md-4 col-form-label text-md-end">{{ __('*Nome do Exercício') }}</label>

                        <div class="col-md-6">
                            <select name="exe_id" id="per_id"
                            class="form-select @error('exe_id') is-invalid @enderror"
                            value="{{ old('exe_id') }}" required autocomplete="alu_id">

                                @foreach ($exercicios as $exercicio)
                                    <option
                                        value="{{ $exercicio['id'] }}"> {{ $exercicio['exe_nome'] }}
                                    </option>
                                @endforeach

                            </select>

                            @error('exe_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="td_series" class="col-md-4 col-form-label text-md-end">{{ __('*Número de series') }}</label>

                        <div class="col-md-6">
                            <input id="td_series" type="text"
                            class="form-control @error('td_series') is-invalid @enderror"
                            name="td_series" value="{{ old('td_series') }}" required autocomplete="td_series" autofocus
                            placeholder="Insira o número de series"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">

                            @error('td_series')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="td_repeticoes" class="col-md-4 col-form-label text-md-end">{{ __('*Número de repetições') }}</label>

                        <div class="col-md-6">
                            <input id="td_repeticoes" type="text"
                            class="form-control @error('td_series') is-invalid @enderror"
                            name="td_repeticoes" value="{{ old('td_repeticoes') }}" required autocomplete="td_repeticoes" autofocus
                            placeholder="Insira o número de repetições"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">

                            @error('td_repeticoes')
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

  <!-- Editar Divisao B -->
  @foreach($treinoDetalhes as $treinoDetalhe)
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
<div class="modal fade" id="editarTreinoDetalhesDivisaoB{{$treinoDetalhe->id}}{{$treinoGeral->id}}" tabindex="-1" role="dialog" aria-labelledby="editarTreinoDetalhesDivisaoB{{$treinoDetalhe->id}}{{$treinoGeral->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 750px">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="editarTreinoDetalhesDivisaoB{{$treinoDetalhe->id}}">Editar</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('treinos.updateDetalhesDivisaoB', $treinoGeral->id, $treinoDetalhe->id) }}" method="POST">
                @csrf
                @method('PUT')

                    <div class="row mb-3">
                        <label for="id" class="col-md-4 col-form-label text-md-end">{{ __('ID') }}</label>

                        <div class="col-md-6">
                            <input id="id" type="text" {{ $treinoDetalhe->id ? 'readonly' : '' }}
                            class="form-control @error('id') is-invalid @enderror"
                            name="id" value="{{ $treinoDetalhe->id }}" required autocomplete="id" autofocus>

                            @error('id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="tre_id" class="col-md-4 col-form-label text-md-end">{{ __('Divisão') }}</label>

                        <div class="col-md-6">
                            <input id="td_divisao" type="text" {{ 'B' ? 'readonly' : '' }}
                            class="form-control @error('td_divisao') is-invalid @enderror"
                            name="td_divisao" value="{{ $treinoDetalhe->td_divisao }}" required autocomplete="td_divisao" autofocus>

                            @error('td_divisao')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="eq_id" class="col-md-4 col-form-label text-md-end">{{ __('*Equipamento') }}</label>

                        <div class="col-md-6">
                            <select name="eq_id" id="eq_id"
                            class="form-select @error('eq_id') is-invalid @enderror"
                            value="{{ old('eq_id') }}" required autocomplete="eq_id">

                                @foreach ($equipamentos as $equipamento)
                                    <option
                                        value="{{ $equipamento['id'] }}" @if($treinoDetalhe->eq_id == $equipamento->id) selected @endif> {{ $equipamento['eq_nome'] }}
                                    </option>
                                @endforeach

                            </select>

                            @error('eq_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="exe_id" class="col-md-4 col-form-label text-md-end">{{ __('*Nome do Exercício') }}</label>

                        <div class="col-md-6">
                            <select name="exe_id" id="per_id"
                            class="form-select @error('exe_id') is-invalid @enderror"
                            value="{{ old('exe_id') }}" required autocomplete="alu_id">

                                @foreach ($exercicios as $exercicio)
                                    <option
                                        value="{{ $exercicio['id'] }}" @if($treinoDetalhe->exe_id == $exercicio->id) selected @endif> {{ $exercicio['exe_nome'] }}
                                    </option>
                                @endforeach

                            </select>

                            @error('exe_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="td_series" class="col-md-4 col-form-label text-md-end">{{ __('*Número de series') }}</label>

                        <div class="col-md-6">
                            <input id="td_series" type="text"
                            class="form-control @error('td_series') is-invalid @enderror"
                            name="td_series" value="{{ $treinoDetalhe->td_series }}" required autocomplete="td_series" autofocus
                            placeholder="Insira o número de series"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">

                            @error('td_series')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="td_repeticoes" class="col-md-4 col-form-label text-md-end">{{ __('*Número de repetições') }}</label>

                        <div class="col-md-6">
                            <input id="td_repeticoes" type="text"
                            class="form-control @error('td_repeticoes') is-invalid @enderror"
                            name="td_repeticoes" value="{{ $treinoDetalhe->td_repeticoes }}" required autocomplete="td_repeticoes" autofocus
                            placeholder="Insira o número de repetições"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">

                            @error('td_repeticoes')
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
<!-- Modal de excluir treino detalhes B -->
@foreach($treinoDetalhes as $treinoDetalhe)
<div class="modal fade" id="excluirTreinoDetalhesDivisaoB{{$treinoGeral->id}}{{$treinoDetalhe->id}}" tabindex="-1" role="dialog" aria-labelledby="excluirTreinoDetalhesDivisaoB{{$treinoGeral->id}}{{$treinoDetalhe->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="excluirTreinoDetalhesDivisaoB{{$treinoGeral->id}}{{$treinoDetalhe->id}}">Excluir Exercício</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <p>Deseja excluir esse exercício?</p>
            <form action="{{ route('treinos.destroyDetalhesDivisaoB', ['treinoGeral' => $treinoGeral->id, 'treinoDetalhe' => $treinoDetalhe->id]) }}" method="POST">

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

<!-- modal de treino divisão C -->
<!-- Modal de observação exercício C -->
@foreach($treinoDetalhes as $treinoDetalhe)
<div class="modal fade" id="obsTreinoDetalhesDivisaoC{{$treinoDetalhe->id}}{{$treinoGeral->id}}" tabindex="-1" role="dialog" aria-labelledby="obsTreinoDetalhesDivisaoC{{$treinoDetalhe->id}}{{$treinoGeral->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="obsTreinoDetalhesDivisaoC{{$treinoDetalhe->id}}{{$treinoGeral->id}}">Excluir Exercício</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <p>Observações do exercicio: </p><span style="font-style: bold;">{{$treinoDetalhe->exe_descricao}}</span>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>
@endforeach

<!-- Criar Divisao C -->
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
<div class="modal fade" id="criarTreinoDetalhesDivisaoC" tabindex="-1" role="dialog" aria-labelledby="criarTreinoDetalhesDivisaoC" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 750px">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="criarTreinoDetalhesDivisaoC">Criar</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('treinos.storeDetalhesDivisaoC', $treinoGeral->id) }}" method="POST">
                @csrf

                    <div class="row mb-3">
                        <label for="tre_id" class="col-md-4 col-form-label text-md-end">{{ __('Divisão') }}</label>

                        <div class="col-md-6">
                            <input id="td_divisao" type="text" {{ 'C' ? 'readonly' : '' }}
                            class="form-control @error('td_divisao') is-invalid @enderror"
                            name="td_divisao" value="C" required autocomplete="td_divisao" autofocus>

                            @error('td_divisao')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="eq_id" class="col-md-4 col-form-label text-md-end">{{ __('*Equipamento') }}</label>

                        <div class="col-md-6">
                            <select name="eq_id" id="eq_id"
                            class="form-select @error('eq_id') is-invalid @enderror"
                            value="{{ old('eq_id') }}" required autocomplete="eq_id">

                                @foreach ($equipamentos as $equipamento)
                                    <option
                                        value="{{ $equipamento['id'] }}"> {{ $equipamento['eq_nome'] }}
                                    </option>
                                @endforeach

                            </select>

                            @error('eq_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="exe_id" class="col-md-4 col-form-label text-md-end">{{ __('*Nome do Exercício') }}</label>

                        <div class="col-md-6">
                            <select name="exe_id" id="per_id"
                            class="form-select @error('exe_id') is-invalid @enderror"
                            value="{{ old('exe_id') }}" required autocomplete="alu_id">

                                @foreach ($exercicios as $exercicio)
                                    <option
                                        value="{{ $exercicio['id'] }}"> {{ $exercicio['exe_nome'] }}
                                    </option>
                                @endforeach

                            </select>

                            @error('exe_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="td_series" class="col-md-4 col-form-label text-md-end">{{ __('*Número de series') }}</label>

                        <div class="col-md-6">
                            <input id="td_series" type="text"
                            class="form-control @error('td_series') is-invalid @enderror"
                            name="td_series" value="{{ old('td_series') }}" required autocomplete="td_series" autofocus
                            placeholder="Insira o número de series"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">

                            @error('td_series')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="td_repeticoes" class="col-md-4 col-form-label text-md-end">{{ __('*Número de repetições') }}</label>

                        <div class="col-md-6">
                            <input id="td_repeticoes" type="text"
                            class="form-control @error('td_series') is-invalid @enderror"
                            name="td_repeticoes" value="{{ old('td_repeticoes') }}" required autocomplete="td_repeticoes" autofocus
                            placeholder="Insira o número de repetições"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">

                            @error('td_repeticoes')
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

  <!-- Editar Divisao C -->
  @foreach($treinoDetalhes as $treinoDetalhe)
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
<div class="modal fade" id="editarTreinoDetalhesDivisaoC{{$treinoDetalhe->id}}{{$treinoGeral->id}}" tabindex="-1" role="dialog" aria-labelledby="editarTreinoDetalhesDivisaoC{{$treinoDetalhe->id}}{{$treinoGeral->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 750px">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="editarTreinoDetalhesDivisaoC{{$treinoDetalhe->id}}">Editar</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('treinos.updateDetalhesDivisaoC', $treinoGeral->id, $treinoDetalhe->id) }}" method="POST">
                @csrf
                @method('PUT')

                    <div class="row mb-3">
                        <label for="id" class="col-md-4 col-form-label text-md-end">{{ __('ID') }}</label>

                        <div class="col-md-6">
                            <input id="id" type="text" {{ $treinoDetalhe->id ? 'readonly' : '' }}
                            class="form-control @error('id') is-invalid @enderror"
                            name="id" value="{{ $treinoDetalhe->id }}" required autocomplete="id" autofocus>

                            @error('id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="tre_id" class="col-md-4 col-form-label text-md-end">{{ __('Divisão') }}</label>

                        <div class="col-md-6">
                            <input id="td_divisao" type="text" {{ 'C' ? 'readonly' : '' }}
                            class="form-control @error('td_divisao') is-invalid @enderror"
                            name="td_divisao" value="{{ $treinoDetalhe->td_divisao }}" required autocomplete="td_divisao" autofocus>

                            @error('td_divisao')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="eq_id" class="col-md-4 col-form-label text-md-end">{{ __('*Equipamento') }}</label>

                        <div class="col-md-6">
                            <select name="eq_id" id="eq_id"
                            class="form-select @error('eq_id') is-invalid @enderror"
                            value="{{ old('eq_id') }}" required autocomplete="eq_id">

                                @foreach ($equipamentos as $equipamento)
                                    <option
                                        value="{{ $equipamento['id'] }}" @if($treinoDetalhe->eq_id == $equipamento->id) selected @endif> {{ $equipamento['eq_nome'] }}
                                    </option>
                                @endforeach

                            </select>

                            @error('eq_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="exe_id" class="col-md-4 col-form-label text-md-end">{{ __('*Nome do Exercício') }}</label>

                        <div class="col-md-6">
                            <select name="exe_id" id="per_id"
                            class="form-select @error('exe_id') is-invalid @enderror"
                            value="{{ old('exe_id') }}" required autocomplete="alu_id">

                                @foreach ($exercicios as $exercicio)
                                    <option
                                        value="{{ $exercicio['id'] }}" @if($treinoDetalhe->exe_id == $exercicio->id) selected @endif> {{ $exercicio['exe_nome'] }}
                                    </option>
                                @endforeach

                            </select>

                            @error('exe_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="td_series" class="col-md-4 col-form-label text-md-end">{{ __('*Número de series') }}</label>

                        <div class="col-md-6">
                            <input id="td_series" type="text"
                            class="form-control @error('td_series') is-invalid @enderror"
                            name="td_series" value="{{ $treinoDetalhe->td_series }}" required autocomplete="td_series" autofocus
                            placeholder="Insira o número de series"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">

                            @error('td_series')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="td_repeticoes" class="col-md-4 col-form-label text-md-end">{{ __('*Número de repetições') }}</label>

                        <div class="col-md-6">
                            <input id="td_repeticoes" type="text"
                            class="form-control @error('td_repeticoes') is-invalid @enderror"
                            name="td_repeticoes" value="{{ $treinoDetalhe->td_repeticoes }}" required autocomplete="td_repeticoes" autofocus
                            placeholder="Insira o número de repetições"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">

                            @error('td_repeticoes')
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
<!-- Modal de excluir treino detalhes C -->
@foreach($treinoDetalhes as $treinoDetalhe)
<div class="modal fade" id="excluirTreinoDetalhesDivisaoC{{$treinoGeral->id}}{{$treinoDetalhe->id}}" tabindex="-1" role="dialog" aria-labelledby="excluirTreinoDetalhesDivisaoC{{$treinoGeral->id}}{{$treinoDetalhe->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="excluirTreinoDetalhesDivisaoC{{$treinoGeral->id}}{{$treinoDetalhe->id}}">Excluir Exercício</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <p>Deseja excluir esse exercício?</p>
            <form action="{{ route('treinos.destroyDetalhesDivisaoC', ['treinoGeral' => $treinoGeral->id, 'treinoDetalhe' => $treinoDetalhe->id]) }}" method="POST">

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

<!-- modal de treino divisão D -->
<!-- Modal de observação exercício D -->
@foreach($treinoDetalhes as $treinoDetalhe)
<div class="modal fade" id="obsTreinoDetalhesDivisaoD{{$treinoDetalhe->id}}{{$treinoGeral->id}}" tabindex="-1" role="dialog" aria-labelledby="obsTreinoDetalhesDivisaoD{{$treinoDetalhe->id}}{{$treinoGeral->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="obsTreinoDetalhesDivisaoD{{$treinoDetalhe->id}}{{$treinoGeral->id}}">Excluir Exercício</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <p>Observações do exercicio: </p><span style="font-style: bold;">{{$treinoDetalhe->exe_descricao}}</span>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>
@endforeach

<!-- Criar Divisao D -->
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
<div class="modal fade" id="criarTreinoDetalhesDivisaoD" tabindex="-1" role="dialog" aria-labelledby="criarTreinoDetalhesDivisaoD" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 750px">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="criarTreinoDetalhesDivisaoD">Criar</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('treinos.storeDetalhesDivisaoD', $treinoGeral->id) }}" method="POST">
                @csrf

                    <div class="row mb-3">
                        <label for="tre_id" class="col-md-4 col-form-label text-md-end">{{ __('Divisão') }}</label>

                        <div class="col-md-6">
                            <input id="td_divisao" type="text" {{ 'D' ? 'readonly' : '' }}
                            class="form-control @error('td_divisao') is-invalid @enderror"
                            name="td_divisao" value="D" required autocomplete="td_divisao" autofocus>

                            @error('td_divisao')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="eq_id" class="col-md-4 col-form-label text-md-end">{{ __('*Equipamento') }}</label>

                        <div class="col-md-6">
                            <select name="eq_id" id="eq_id"
                            class="form-select @error('eq_id') is-invalid @enderror"
                            value="{{ old('eq_id') }}" required autocomplete="eq_id">

                                @foreach ($equipamentos as $equipamento)
                                    <option
                                        value="{{ $equipamento['id'] }}"> {{ $equipamento['eq_nome'] }}
                                    </option>
                                @endforeach

                            </select>

                            @error('eq_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="exe_id" class="col-md-4 col-form-label text-md-end">{{ __('*Nome do Exercício') }}</label>

                        <div class="col-md-6">
                            <select name="exe_id" id="per_id"
                            class="form-select @error('exe_id') is-invalid @enderror"
                            value="{{ old('exe_id') }}" required autocomplete="alu_id">

                                @foreach ($exercicios as $exercicio)
                                    <option
                                        value="{{ $exercicio['id'] }}"> {{ $exercicio['exe_nome'] }}
                                    </option>
                                @endforeach

                            </select>

                            @error('exe_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="td_series" class="col-md-4 col-form-label text-md-end">{{ __('*Número de series') }}</label>

                        <div class="col-md-6">
                            <input id="td_series" type="text"
                            class="form-control @error('td_series') is-invalid @enderror"
                            name="td_series" value="{{ old('td_series') }}" required autocomplete="td_series" autofocus
                            placeholder="Insira o número de series"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">

                            @error('td_series')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="td_repeticoes" class="col-md-4 col-form-label text-md-end">{{ __('*Número de repetições') }}</label>

                        <div class="col-md-6">
                            <input id="td_repeticoes" type="text"
                            class="form-control @error('td_series') is-invalid @enderror"
                            name="td_repeticoes" value="{{ old('td_repeticoes') }}" required autocomplete="td_repeticoes" autofocus
                            placeholder="Insira o número de repetições"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">

                            @error('td_repeticoes')
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

  <!-- Editar Divisao D -->
  @foreach($treinoDetalhes as $treinoDetalhe)
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
<div class="modal fade" id="editarTreinoDetalhesDivisaoD{{$treinoDetalhe->id}}{{$treinoGeral->id}}" tabindex="-1" role="dialog" aria-labelledby="editarTreinoDetalhesDivisaoD{{$treinoDetalhe->id}}{{$treinoGeral->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 750px">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="editarTreinoDetalhesDivisaoD{{$treinoDetalhe->id}}">Editar</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('treinos.updateDetalhesDivisaoD', $treinoGeral->id, $treinoDetalhe->id) }}" method="POST">
                @csrf
                @method('PUT')

                    <div class="row mb-3">
                        <label for="id" class="col-md-4 col-form-label text-md-end">{{ __('ID') }}</label>

                        <div class="col-md-6">
                            <input id="id" type="text" {{ $treinoDetalhe->id ? 'readonly' : '' }}
                            class="form-control @error('id') is-invalid @enderror"
                            name="id" value="{{ $treinoDetalhe->id }}" required autocomplete="id" autofocus>

                            @error('id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="tre_id" class="col-md-4 col-form-label text-md-end">{{ __('Divisão') }}</label>

                        <div class="col-md-6">
                            <input id="td_divisao" type="text" {{ 'D' ? 'readonly' : '' }}
                            class="form-control @error('td_divisao') is-invalid @enderror"
                            name="td_divisao" value="{{ $treinoDetalhe->td_divisao }}" required autocomplete="td_divisao" autofocus>

                            @error('td_divisao')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="eq_id" class="col-md-4 col-form-label text-md-end">{{ __('*Equipamento') }}</label>

                        <div class="col-md-6">
                            <select name="eq_id" id="eq_id"
                            class="form-select @error('eq_id') is-invalid @enderror"
                            value="{{ old('eq_id') }}" required autocomplete="eq_id">

                                @foreach ($equipamentos as $equipamento)
                                    <option
                                        value="{{ $equipamento['id'] }}" @if($treinoDetalhe->eq_id == $equipamento->id) selected @endif> {{ $equipamento['eq_nome'] }}
                                    </option>
                                @endforeach

                            </select>

                            @error('eq_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="exe_id" class="col-md-4 col-form-label text-md-end">{{ __('*Nome do Exercício') }}</label>

                        <div class="col-md-6">
                            <select name="exe_id" id="per_id"
                            class="form-select @error('exe_id') is-invalid @enderror"
                            value="{{ old('exe_id') }}" required autocomplete="alu_id">

                                @foreach ($exercicios as $exercicio)
                                    <option
                                        value="{{ $exercicio['id'] }}" @if($treinoDetalhe->exe_id == $exercicio->id) selected @endif> {{ $exercicio['exe_nome'] }}
                                    </option>
                                @endforeach

                            </select>

                            @error('exe_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="td_series" class="col-md-4 col-form-label text-md-end">{{ __('*Número de series') }}</label>

                        <div class="col-md-6">
                            <input id="td_series" type="text"
                            class="form-control @error('td_series') is-invalid @enderror"
                            name="td_series" value="{{ $treinoDetalhe->td_series }}" required autocomplete="td_series" autofocus
                            placeholder="Insira o número de series"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">

                            @error('td_series')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="td_repeticoes" class="col-md-4 col-form-label text-md-end">{{ __('*Número de repetições') }}</label>

                        <div class="col-md-6">
                            <input id="td_repeticoes" type="text"
                            class="form-control @error('td_repeticoes') is-invalid @enderror"
                            name="td_repeticoes" value="{{ $treinoDetalhe->td_repeticoes }}" required autocomplete="td_repeticoes" autofocus
                            placeholder="Insira o número de repetições"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">

                            @error('td_repeticoes')
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

<!-- Modal de excluir treino detalhes D -->
@foreach($treinoDetalhes as $treinoDetalhe)
<div class="modal fade" id="excluirTreinoDetalhesDivisaoD{{$treinoGeral->id}}{{$treinoDetalhe->id}}" tabindex="-1" role="dialog" aria-labelledby="excluirTreinoDetalhesDivisaoD{{$treinoGeral->id}}{{$treinoDetalhe->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="excluirTreinoDetalhesDivisaoD{{$treinoGeral->id}}{{$treinoDetalhe->id}}">Excluir Exercício</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <p>Deseja excluir esse exercício?</p>
            <form action="{{ route('treinos.destroyDetalhesDivisaoD', ['treinoGeral' => $treinoGeral->id, 'treinoDetalhe' => $treinoDetalhe->id]) }}" method="POST">

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

<!-- modal de treino divisão E -->
<!-- Modal de observação exercício E -->
@foreach($treinoDetalhes as $treinoDetalhe)
<div class="modal fade" id="obsTreinoDetalhesDivisaoE{{$treinoDetalhe->id}}{{$treinoGeral->id}}" tabindex="-1" role="dialog" aria-labelledby="obsTreinoDetalhesDivisaoE{{$treinoDetalhe->id}}{{$treinoGeral->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="obsTreinoDetalhesDivisaoE{{$treinoDetalhe->id}}{{$treinoGeral->id}}">Excluir Exercício</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <p>Observações do exercicio: </p><span style="font-style: bold;">{{$treinoDetalhe->exe_descricao}}</span>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>
@endforeach

<!-- Criar Divisao E -->
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
<div class="modal fade" id="criarTreinoDetalhesDivisaoE" tabindex="-1" role="dialog" aria-labelledby="criarTreinoDetalhesDivisaoE" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 750px">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="criarTreinoDetalhesDivisaoE">Criar</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('treinos.storeDetalhesDivisaoE', $treinoGeral->id) }}" method="POST">
                @csrf

                    <div class="row mb-3">
                        <label for="tre_id" class="col-md-4 col-form-label text-md-end">{{ __('Divisão') }}</label>

                        <div class="col-md-6">
                            <input id="td_divisao" type="text" {{ 'E' ? 'readonly' : '' }}
                            class="form-control @error('td_divisao') is-invalid @enderror"
                            name="td_divisao" value="E" required autocomplete="td_divisao" autofocus>

                            @error('td_divisao')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="eq_id" class="col-md-4 col-form-label text-md-end">{{ __('*Equipamento') }}</label>

                        <div class="col-md-6">
                            <select name="eq_id" id="eq_id"
                            class="form-select @error('eq_id') is-invalid @enderror"
                            value="{{ old('eq_id') }}" required autocomplete="eq_id">

                                @foreach ($equipamentos as $equipamento)
                                    <option
                                        value="{{ $equipamento['id'] }}"> {{ $equipamento['eq_nome'] }}
                                    </option>
                                @endforeach

                            </select>

                            @error('eq_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="exe_id" class="col-md-4 col-form-label text-md-end">{{ __('*Nome do Exercício') }}</label>

                        <div class="col-md-6">
                            <select name="exe_id" id="per_id"
                            class="form-select @error('exe_id') is-invalid @enderror"
                            value="{{ old('exe_id') }}" required autocomplete="alu_id">

                                @foreach ($exercicios as $exercicio)
                                    <option
                                        value="{{ $exercicio['id'] }}"> {{ $exercicio['exe_nome'] }}
                                    </option>
                                @endforeach

                            </select>

                            @error('exe_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="td_series" class="col-md-4 col-form-label text-md-end">{{ __('*Número de series') }}</label>

                        <div class="col-md-6">
                            <input id="td_series" type="text"
                            class="form-control @error('td_series') is-invalid @enderror"
                            name="td_series" value="{{ old('td_series') }}" required autocomplete="td_series" autofocus
                            placeholder="Insira o número de series"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">

                            @error('td_series')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="td_repeticoes" class="col-md-4 col-form-label text-md-end">{{ __('*Número de repetições') }}</label>

                        <div class="col-md-6">
                            <input id="td_repeticoes" type="text"
                            class="form-control @error('td_series') is-invalid @enderror"
                            name="td_repeticoes" value="{{ old('td_repeticoes') }}" required autocomplete="td_repeticoes" autofocus
                            placeholder="Insira o número de repetições"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">

                            @error('td_repeticoes')
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

  <!-- Editar Divisao E -->
  @foreach($treinoDetalhes as $treinoDetalhe)
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
<div class="modal fade" id="editarTreinoDetalhesDivisaoE{{$treinoDetalhe->id}}{{$treinoGeral->id}}" tabindex="-1" role="dialog" aria-labelledby="editarTreinoDetalhesDivisaoE{{$treinoDetalhe->id}}{{$treinoGeral->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 750px">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="editarTreinoDetalhesDivisaoE{{$treinoDetalhe->id}}">Editar</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('treinos.updateDetalhesDivisaoE', $treinoGeral->id, $treinoDetalhe->id) }}" method="POST">
                @csrf
                @method('PUT')

                    <div class="row mb-3">
                        <label for="id" class="col-md-4 col-form-label text-md-end">{{ __('ID') }}</label>

                        <div class="col-md-6">
                            <input id="id" type="text" {{ $treinoDetalhe->id ? 'readonly' : '' }}
                            class="form-control @error('id') is-invalid @enderror"
                            name="id" value="{{ $treinoDetalhe->id }}" required autocomplete="id" autofocus>

                            @error('id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="tre_id" class="col-md-4 col-form-label text-md-end">{{ __('Divisão') }}</label>

                        <div class="col-md-6">
                            <input id="td_divisao" type="text" {{ 'E' ? 'readonly' : '' }}
                            class="form-control @error('td_divisao') is-invalid @enderror"
                            name="td_divisao" value="{{ $treinoDetalhe->td_divisao }}" required autocomplete="td_divisao" autofocus>

                            @error('td_divisao')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="eq_id" class="col-md-4 col-form-label text-md-end">{{ __('*Equipamento') }}</label>

                        <div class="col-md-6">
                            <select name="eq_id" id="eq_id"
                            class="form-select @error('eq_id') is-invalid @enderror"
                            value="{{ old('eq_id') }}" required autocomplete="eq_id">

                                @foreach ($equipamentos as $equipamento)
                                    <option
                                        value="{{ $equipamento['id'] }}" @if($treinoDetalhe->eq_id == $equipamento->id) selected @endif> {{ $equipamento['eq_nome'] }}
                                    </option>
                                @endforeach

                            </select>

                            @error('eq_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="exe_id" class="col-md-4 col-form-label text-md-end">{{ __('*Nome do Exercício') }}</label>

                        <div class="col-md-6">
                            <select name="exe_id" id="per_id"
                            class="form-select @error('exe_id') is-invalid @enderror"
                            value="{{ old('exe_id') }}" required autocomplete="alu_id">

                                @foreach ($exercicios as $exercicio)
                                    <option
                                        value="{{ $exercicio['id'] }}" @if($treinoDetalhe->exe_id == $exercicio->id) selected @endif> {{ $exercicio['exe_nome'] }}
                                    </option>
                                @endforeach

                            </select>

                            @error('exe_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="td_series" class="col-md-4 col-form-label text-md-end">{{ __('*Número de series') }}</label>

                        <div class="col-md-6">
                            <input id="td_series" type="text"
                            class="form-control @error('td_series') is-invalid @enderror"
                            name="td_series" value="{{ $treinoDetalhe->td_series }}" required autocomplete="td_series" autofocus
                            placeholder="Insira o número de series"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">

                            @error('td_series')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="td_repeticoes" class="col-md-4 col-form-label text-md-end">{{ __('*Número de repetições') }}</label>

                        <div class="col-md-6">
                            <input id="td_repeticoes" type="text"
                            class="form-control @error('td_repeticoes') is-invalid @enderror"
                            name="td_repeticoes" value="{{ $treinoDetalhe->td_repeticoes }}" required autocomplete="td_repeticoes" autofocus
                            placeholder="Insira o número de repetições"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">

                            @error('td_repeticoes')
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

<!-- Modal de excluir treino detalhes E -->
@foreach($treinoDetalhes as $treinoDetalhe)
<div class="modal fade" id="excluirTreinoDetalhesDivisaoE{{$treinoGeral->id}}{{$treinoDetalhe->id}}" tabindex="-1" role="dialog" aria-labelledby="excluirTreinoDetalhesDivisaoE{{$treinoGeral->id}}{{$treinoDetalhe->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="excluirTreinoDetalhesDivisaoE{{$treinoGeral->id}}{{$treinoDetalhe->id}}">Excluir Exercício</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <p>Deseja excluir esse exercício?</p>
            <form action="{{ route('treinos.destroyDetalhesDivisaoE', ['treinoGeral' => $treinoGeral->id, 'treinoDetalhe' => $treinoDetalhe->id]) }}" method="POST">

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


