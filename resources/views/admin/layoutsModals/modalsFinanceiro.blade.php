<!-- Modal Selecionar conta a pagar ou receber -->
<div class="modal fade" id="selecionarContaModal" tabindex="-1" role="dialog" aria-labelledby="selecionarContaModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="selecionarContaModal">Selecionar</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <p>Selecione qual tipo de conta deseja adicionar</p>

        </div>
        <div class="modal-footer">
          <a class="btn bg-gradient-success" data-bs-toggle="modal" data-bs-target="#criarContaAReceber">Contas a receber</a>
          <a class="btn bg-gradient-secondary" data-bs-toggle="modal" data-bs-target="#criarContaAPagar">Contas a pagar</a>
          <button type="button" class="btn bg-gradient-danger" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>

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

                        <label for="tpg_id" class="col-md-4 col-form-label text-md-end">
                            {{ __('*Tipo do pagamento') }}
                            <a href="{{route('admin.financeiro.tipopagto.index')}}" class="material-icons ms-auto text-dark cursor-pointer"><i class="material-icons ms-auto text-dark cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar tipos de pagamentos">edit</i></a>
                        </label>

                        <div class="col-md-6">
                            <select name="tpg_id" id="tpg_id"
                            class="form-select @error('tpg_id') is-invalid @enderror"
                            value="{{ old('tpg_id') }}" required autocomplete="tpg_id">
                            <option>Selecione ou adicione pelo lápis</option>
                            <optgroup label="Tipos de pagamentos"></optgroup>
                                @foreach ($tipoPagtos as $tipoPagto)
                                    <option
                                        value="{{ $tipoPagto['id'] }}"> {{ $tipoPagto['tpg_descricao'] }}
                                    </option>
                                @endforeach

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
