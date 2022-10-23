<!-- Criar tipo pagamento -->
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
<div class="modal fade" id="criarTipoPagto" tabindex="-1" role="dialog" aria-labelledby="criarTipoPagto" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 750px">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="criarTipoPagto">Criar</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.financeiro.tipopagto.store') }}" method="POST">
                @csrf


                <div class="row mb-3">
                    <label for="tpg_descricao" class="col-md-4 col-form-label text-md-end">{{ __('*Tipo de pagamento') }}</label>

                    <div class="col-md-6">
                        <input id="tpg_descricao" type="text"
                        class="form-control @error('tpg_descricao') is-invalid @enderror"
                        name="tpg_descricao" value="{{ old('tpg_descricao') }}" required autocomplete="tpg_descricao" autofocus
                        placeholder="Insira um tipo de pagamento">

                        @error('tpg_descricao')
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

  <!-- Editar tipo pagamento -->
  @foreach ($tipoPagtos as $tipoPagto)
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
<div class="modal fade" id="editarTipoPagto{{$tipoPagto->id}}" tabindex="-1" role="dialog" aria-labelledby="editarTipoPagto{{$tipoPagto->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 750px">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="editarTipoPagto{{$tipoPagto->id}}">Editar</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.financeiro.tipopagto.update', $tipoPagto->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <label for="id" class="col-md-4 col-form-label text-md-end">{{ __('ID') }}</label>

                    <div class="col-md-6">
                        <input id="id" type="text" {{ $tipoPagto->id ? 'readonly' : '' }}
                        class="form-control @error('id') is-invalid @enderror"
                        name="id" value="{{ $tipoPagto->id }}" required autocomplete="id" autofocus>

                        @error('id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="tpg_descricao" class="col-md-4 col-form-label text-md-end">{{ __('Tipo de pagamento') }}</label>

                    <div class="col-md-6">
                        <input id="tpg_descricao" type="text"
                         class="form-control @error('tpg_descricao') is-invalid @enderror"
                          name="tpg_descricao" value="{{ $tipoPagto->tpg_descricao }}" required autocomplete="tpg_descricao" autofocus>

                        @error('tpg_descricao')
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

    <!-- Modal de excluir tipo de pagamento -->
    @foreach($tipoPagtos as $tipoPagto)
    <div class="modal fade" id="excluirTipoPagto{{$tipoPagto->id}}" tabindex="-1" role="dialog" aria-labelledby="excluirTipoPagto{{$tipoPagto->id}}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title font-weight-normal" id="excluirTipoPagto{{$tipoPagto->id}}">Excluir</h5>
              <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

                <p>Deseja excluir esse tipo de pagamento?</p>
                <form action="{{ route('admin.financeiro.tipopagto.delete', $tipoPagto->id) }}" method="POST">

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
