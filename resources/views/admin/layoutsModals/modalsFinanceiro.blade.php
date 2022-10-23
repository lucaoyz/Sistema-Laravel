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
  @foreach ($tipopagtos as $tipopagto)
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
<div class="modal fade" id="editarTipoPagto{{$tipopagto->id}}" tabindex="-1" role="dialog" aria-labelledby="editarTipoPagto{{$tipopagto->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 750px">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="editarTipoPagto{{$tipopagto->id}}">Editar</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.financeiro.tipopagto.update', $tipopagto->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <label for="id" class="col-md-4 col-form-label text-md-end">{{ __('ID') }}</label>

                    <div class="col-md-6">
                        <input id="id" type="text" {{ $tipopagto->id ? 'readonly' : '' }}
                        class="form-control @error('id') is-invalid @enderror"
                        name="id" value="{{ $tipopagto->id }}" required autocomplete="id" autofocus>

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
                          name="tpg_descricao" value="{{ $tipopagto->tpg_descricao }}" required autocomplete="tpg_descricao" autofocus>

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
    @foreach($tipopagtos as $tipopagto)
    <div class="modal fade" id="excluirTipoPagto{{$tipopagto->id}}" tabindex="-1" role="dialog" aria-labelledby="excluirTipoPagto{{$tipopagto->id}}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title font-weight-normal" id="excluirTipoPagto{{$tipopagto->id}}">Excluir</h5>
              <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

                <p>Deseja excluir esse tipo de pagamento?</p>
                <form action="{{ route('admin.financeiro.tipopagto.delete', $tipopagto->id) }}" method="POST">

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
