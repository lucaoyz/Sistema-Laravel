
  <!-- Criar Conta a receber -->
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
<div class="modal fade" id="criarContaAReceber" tabindex="-1" role="dialog" aria-labelledby="criarContaAReceber" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 750px">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="criarContaAReceber">Criar</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.financeiro.receber.store') }}" method="POST">
                @csrf


                    <div class="row mb-3">
                        <label for="tpg_id" class="col-md-4 col-form-label text-md-end">{{ __('*Tipo do pagamento') }}</label>

                        <div class="col-md-6">
                            <select name="tpg_id" id="tpg_id"
                            class="form-select @error('tpg_id') is-invalid @enderror"
                            value="{{ old('tpg_id') }}" required autocomplete="tpg_id">

                            @if ($tipopagtos === null)
                                <option><a href="{{route('admin.financeiro.tipopagto.index')}}">Você não tem tipos de pagamentos cadastrados,<br>
                                     clique aqui para cadastrar</a></option>
                            @else
                                @foreach ($tipopagtos as $tipopagto)
                                    <option
                                        value="{{ $tipopagto['id'] }}"> {{ $tipopagto['tpg_descricao'] }}
                                    </option>
                                @endforeach
                            @endif


                            </select>
                            @error('tpg_id')
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
