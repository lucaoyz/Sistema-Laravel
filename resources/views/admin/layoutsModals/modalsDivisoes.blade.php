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
