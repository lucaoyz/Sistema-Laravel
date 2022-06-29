<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
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

        function dias_semana() {

            var dias_da_semana = document.getElementById('tre_dias_semana').value;
            var $divTexDias = $('#tex_dia');
            var $mudarDias = $('#tre_dias_semana');

            var html = '';


            for(let i=1; dias_da_semana >= i; i++){
                html = '<input type="radio" value=' + i + ' id="dia' + i + '" name="tex_dia" onchange="mudarDia()"><span>' + i + '</span> ';
                $divTexDias.append(html);
            }

            $mudarDias.on('change', function(){
                $divTexDias.empty(html);
                for(let i=1; dias_da_semana >= i; i++){
                html = '<input type="radio" value=' + i + ' id="dia' + i + '" name="tex_dia" onchange="mudarDia()"><span>' + i + '</span> ';
                $divTexDias.append(html);
            }

            })

        }

        function mudarDia(){
        var $membro_musculares = $('#membro_musculares');
        var membroSelect = '';

            membroSelect = '<label for="tex_membro1">{{ __("*Membro Muscular 1") }}</label>';
            membroSelect += '<select name="tex_membro1" id="tex_membro1" class="form-select @error('tex_membro1') is-invalid @enderror" value="{{ old('tex_membro1') }}" required autocomplete="tex_membro1">'
            membroSelect += '<option value="peito">Peito</option>'
                                + '<option value="costas">Costas</option>'
                                + '<option value="biceps">Biceps</option>'
                                + '<option value="triceps">Triceps</option>'
                                + '<option value="antebraco">Antebraço</option>'
                                + '<option value="ombro">Ombro</option>'
                                + '<option value="trapezio">Trapezio</option>'
                                + '<option value="inferior">Inferior</option>'
                                + '<option value="lombar">Lombar</option>'
                                + '<option value="abdomen">Abdomen</option>'
            membroSelect += '</select>';

            membroSelect += '<label for="tex_membro2">{{ __("Membro Muscular 2 (Opcional)") }}</label>';
            membroSelect += '<select name="tex_membro2" id="tex_membro2" class="form-select @error('tex_membro2') is-invalid @enderror" value="{{ old('tex_membro2') }}" autocomplete="tex_membro2">'
            membroSelect += '<option value=""></option>'
                                + '<option value="peito">Peito</option>'
                                + '<option value="costas">Costas</option>'
                                + '<option value="biceps">Biceps</option>'
                                + '<option value="triceps">Triceps</option>'
                                + '<option value="antebraco">Antebraço</option>'
                                + '<option value="ombro">Ombro</option>'
                                + '<option value="trapezio">Trapezio</option>'
                                + '<option value="inferior">Inferior</option>'
                                + '<option value="lombar">Lombar</option>'
                                + '<option value="abdomen">Abdomen</option>';
            membroSelect += '</select>';
                $membro_musculares.append(membroSelect);
        }

    </script>

    <!-- Criar treino -->
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
<div class="modal fade" id="criarTreinoModal" tabindex="-1" role="dialog" aria-labelledby="criarTreinoModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 50%;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="criarTreinoModal">Criar</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('treinos.store') }}" method="POST">
                @csrf

                <div class="container">
                    <div class="row" style="padding-bottom: 2%;">

                      <div class="col-sm">
                        <label for="per_id">{{ __('*Nome do Professor') }}</label>
                        <select name="per_id" id="per_id"
                        class="form-select @error('per_id') is-invalid @enderror"
                        value="{{ old('per_id') }}" required autocomplete="per_id">
                        @if(auth()->user()->type == 'admin')
                                @foreach ($personals as $personal)
                                    <option
                                        value="{{ $personal['id'] }}"> {{ $personal['per_nome'] }}
                                    </option>
                                @endforeach
                            @elseif(auth()->user()->type == 'professor')
                            <option
                            value="{{ Auth()->user()->per_id }}"> {{ Auth()->user()->name }}
                        @endif
                        </select>

                        @error('per_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>

                      <div class="col-sm">
                        <label for="tre_dias_semana">{{ __('*Dias por semana') }}</label>
                        <select name="tre_dias_semana" id="tre_dias_semana" onchange="dias_semana()"
                        class="form-select @error('tre_dias_semana') is-invalid @enderror"
                        value="{{ old('tre_dias_semana') }}" required autocomplete="tre_dias_semana">
                            <option value="">Clique aqui</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                        </select>

                        @error('tre_dias_semana')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                      </div>

                      <div class="col-sm">
                        <label for="tre_tempo">{{ __('*Tempo de cada treino') }}</label>
                        <select name="tre_tempo" id="tre_tempo"
                        class="form-select @error('tre_tempo') is-invalid @enderror"
                        value="{{ old('tre_tempo') }}" required autocomplete="tre_tempo">
                            <option value="">Clique aqui</option>
                            <option value="30m">30 Minutos</option>
                            <option value="45m">45 Minutos</option>
                            <option value="1h">1 Hora</option>
                            <option value="1h30m">1 Hora e 30 Minutos</option>
                            <option value="2h">2 Horas</option>
                        </select>

                        @error('tre_tempo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>

                      <div class="col-sm">
                        <label for="tre_data_troca">{{ __('*Data de troca') }}</label>
                        <input id="tre_data_troca" type="date"
                        class="form-control @error('tre_data_troca') is-invalid @enderror"
                        name="tre_data_troca" value="{{ old('tre_data_troca') }}" required autocomplete="tre_data_troca" autofocus
                        min="{{ now()->toDateString('d-m-Y') }}" >

                        @error('tre_data_troca')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    </div>

                    <div class="row" style="padding-bottom: 2%;">

                        <div class="col-sm" style="max-width: 300px;">
                          <label for="tex_dia">{{ __('*Dias da semana') }}</label>
                            <div id="tex_dia">
                                <!-- aqui vai a expressão javascript do onchange do dias por semana -->
                            </div>
                            <div style="padding-top: 16.3px">
                            <label for="numero_exercicios">{{ __('*Numero de exercícios') }}</label>
                            <select name="numero_exercicios" id="numero_exercicios"
                              class="form-select @error('numero_exercicios') is-invalid @enderror"
                              value="{{ old('numero_exercicios') }}" required autocomplete="numero_exercicios">
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                  <option value="6">6</option>
                                  <option value="7">7</option>
                                  <option value="8">8</option>
                                  <option value="9">9</option>
                                  <option value="10">10</option>
                                  <option value="11">11</option>
                                  <option value="12">12</option>
                              </select>

                            @error('tex_membro')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        </div>


                        <div id="membro_musculares"class="col-sm">
                            <!--
                          <label for="tex_membro1">{{ __('*Membro Muscular 1') }}</label>
                          <select name="tex_membro1" id="tex_membro1"
                            class="form-select @error('tex_membro1') is-invalid @enderror"
                            value="{{ old('tex_membro1') }}" required autocomplete="tex_membro1">
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

                          @error('tex_membro1')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror

                          <label for="tex_membro2">{{ __('Membro Muscular 2') }}</label>
                          <select name="tex_membro2" id="tex_membro2"
                            class="form-select @error('tex_membro2') is-invalid @enderror"
                            value="{{ old('tex_membro2') }}" autocomplete="tex_membro2">
                                <option value=""></option>
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

                          @error('tex_membro2')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                          -->
                        </div>

                      </div>

                      <div class="row" style="padding-bottom: 2%;">

                        <div class="col-sm">
                            <label for="exe_nome">{{ __('*Nome do exercício') }}</label>
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

                        <div class="col-sm">
                          <label for="exe_nome">{{ __('*Nome do exercício') }}</label>
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

                        <div class="col-sm">
                          <label for="exe_nome">{{ __('*Nome do exercício') }}</label>
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
