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
            <form action="{{ route('exercicios.store') }}" method="POST">
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
                            <input id="exe_membro" type="text"
                             class="form-control @error('exe_membro') is-invalid @enderror"
                              name="exe_membro" value="{{ old('exe_membro') }}" required autocomplete="exe_membro"
                              placeholder="Insira o membro muscular do exercício">

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
