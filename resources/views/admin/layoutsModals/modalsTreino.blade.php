<!-- Criar Treino Geral -->
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
<div class="modal fade" id="criarTreinoGeralModal" tabindex="-1" role="dialog" aria-labelledby="criarTreinoGeralModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 750px">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="criarTreinoGeralModal">Criar</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('treinos.storeGeral') }}" method="POST">
                @csrf


                    <div class="row mb-3">
                        <label for="per_id" class="col-md-4 col-form-label text-md-end">{{ __('*Nome do professor') }}</label>

                        <div class="col-md-6">
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
                    </div>

                    <div class="row mb-3">
                        <label for="alu_id" class="col-md-4 col-form-label text-md-end">{{ __('*Nome do aluno') }}</label>

                        <div class="col-md-6">
                            <select name="alu_id" id="per_id"
                            class="form-select @error('alu_id') is-invalid @enderror"
                            value="{{ old('alu_id') }}" required autocomplete="alu_id">

                                @foreach ($alunos as $aluno)
                                    <option
                                        value="{{ $aluno['id'] }}"> {{ $aluno['alu_nome'] }}
                                    </option>
                                @endforeach

                            </select>

                            @error('alu_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="tg_data_inicio" class="col-md-4 col-form-label text-md-end">{{ __('*Data de início') }}</label>

                        <div class="col-md-6">
                            <input id="tg_data_inicio" type="date"
                            class="form-control @error('tg_data_inicio') is-invalid @enderror"
                            name="tg_data_inicio" value="{{ old('tg_data_inicio') }}" required autocomplete="tg_data_inicio" autofocus
                            min="{{ now()->toDateString('d-m-Y') }}">

                            @error('tg_data_inicio')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="tg_dias_semana" class="col-md-4 col-form-label text-md-end">{{ __('*Dias por semana') }}</label>

                        <div class="col-md-6">
                            <select name="tg_dias_semana" id="tg_dias_semana"
                            class="form-select @error('tg_dias_semana') is-invalid @enderror"
                            value="{{ old('tg_dias_semana') }}" required autocomplete="tg_dias_semana">
                                <option value="">Clique aqui</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                            </select>

                            @error('tg_dias_semana')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="tg_data_final" class="col-md-4 col-form-label text-md-end">{{ __('*Data final') }}</label>

                        <div class="col-md-6">
                            <input id="tg_data_final" type="date"
                            class="form-control @error('tg_data_final') is-invalid @enderror"
                            name="tg_data_final" value="{{ old('tg_data_final') }}" required autocomplete="tg_data_final" autofocus
                            min="{{ now()->toDateString('d-m-Y') }}">

                            @error('tg_data_final')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="tg_divisoes" class="col-md-4 col-form-label text-md-end">{{ __('*Divisões do treino') }}</label>

                        <div class="col-md-6">
                            <select name="tg_divisoes" id="tg_divisoes"
                            class="form-select @error('tg_divisoes') is-invalid @enderror"
                            value="{{ old('tg_divisoes') }}" required autocomplete="tg_divisoes">
                                <option value="">Clique aqui</option>
                                <option value="A">A</option>
                                <option value="AB">AB</option>
                                <option value="ABC">ABC</option>
                                <option value="ABCD">ABCD</option>
                                <option value="ABCDE">ABCDE</option>
                                <option value="ABCDEF">ABCDEF</option>
                            </select>

                            @error('tg_divisoes')
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

<!-- Editar Treino Geral -->
 @foreach($treinoGerals as $treinoGeral)
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
 <div class="modal fade" id="editarTreinoGeralModal{{$treinoGeral->id}}" tabindex="-1" role="dialog" aria-labelledby="editarTreinoGeralModal{{$treinoGeral->id}}" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 700px">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title font-weight-normal" id="editarTreinoGeralModal{{$treinoGeral->id}}">Editar</h5>
           <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
             <form action="{{ route('treinos.updateGeral',$treinoGeral->id) }}" method="POST">
                 @csrf
                 @method('PUT')


                     <div class="row mb-3">
                         <label for="id" class="col-md-4 col-form-label text-md-end">{{ __('ID') }}</label>

                         <div class="col-md-6">
                             <input id="id" type="text" {{ $treinoGeral->id ? 'readonly' : '' }}
                             class="form-control @error('id') is-invalid @enderror"
                             name="id" value="{{ $treinoGeral->id }}" required autocomplete="id" autofocus>

                             @error('id')
                                 <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                 </span>
                             @enderror
                         </div>
                     </div>

                     <div class="row mb-3">
                        <label for="per_id" class="col-md-4 col-form-label text-md-end">{{ __('*Nome do professor') }}</label>

                        <div class="col-md-6">
                            <select name="per_id" id="per_id"
                            class="form-select @error('per_id') is-invalid @enderror"
                            value="{{ old('per_id') }}" required autocomplete="per_id">

                                @foreach ($personals as $personal)
                                    <option
                                        value="{{ $personal['id'] }}"" @if($personal->id == $treinoGeral->per_id) selected @endif"> {{ $personal['per_nome'] }}
                                    </option>
                                @endforeach

                            </select>

                            @error('per_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="alu_id" class="col-md-4 col-form-label text-md-end">{{ __('*Nome do aluno') }}</label>

                        <div class="col-md-6">
                            <select name="alu_id" id="per_id"
                            class="form-select @error('alu_id') is-invalid @enderror"
                            value="{{ old('alu_id') }}" required autocomplete="alu_id">

                                @foreach ($alunos as $aluno)
                                    <option
                                        value="{{ $aluno['id'] }}"" @if($aluno->id == $treinoGeral->alu_id) selected @endif"> {{ $aluno['alu_nome'] }}
                                    </option>
                                @endforeach

                            </select>

                            @error('alu_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="tg_data_inicio" class="col-md-4 col-form-label text-md-end">{{ __('*Data de início') }}</label>

                        <div class="col-md-6">
                            <input id="tg_data_inicio" type="date"
                            class="form-control @error('tg_data_inicio') is-invalid @enderror"
                            name="tg_data_inicio" value="{{ $treinoGeral->tg_data_inicio->format('Y-m-d') }}" required autocomplete="tg_data_inicio" autofocus
                            min="{{ now()->toDateString('d-m-Y') }}">

                            @error('tg_data_inicio')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="tg_dias_semana" class="col-md-4 col-form-label text-md-end">{{ __('*Dias por semana') }}</label>

                        <div class="col-md-6">
                            <select name="tg_dias_semana" id="tg_dias_semana"
                            class="form-select @error('tg_dias_semana') is-invalid @enderror"
                            value="{{ old('tg_dias_semana') }}" required autocomplete="tg_dias_semana">
                                <option value="1" @if($treinoGeral->tg_dias_semana == '1') selected @endif>1</option>
                                <option value="2" @if($treinoGeral->tg_dias_semana == '2') selected @endif>2</option>
                                <option value="3" @if($treinoGeral->tg_dias_semana == '3') selected @endif>3</option>
                                <option value="4" @if($treinoGeral->tg_dias_semana == '4') selected @endif>4</option>
                                <option value="5" @if($treinoGeral->tg_dias_semana == '5') selected @endif>5</option>
                                <option value="6" @if($treinoGeral->tg_dias_semana == '6') selected @endif>6</option>
                                <option value="7" @if($treinoGeral->tg_dias_semana == '7') selected @endif>7</option>
                            </select>

                            @error('tg_dias_semana')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="tg_data_final" class="col-md-4 col-form-label text-md-end">{{ __('*Data final') }}</label>

                        <div class="col-md-6">
                            <input id="tg_data_final" type="date"
                            class="form-control @error('tg_data_final') is-invalid @enderror"
                            name="tg_data_final" value="{{ $treinoGeral->tg_data_final->format('Y-m-d') }}" required autocomplete="tg_data_final" autofocus
                            min="{{ now()->toDateString('d-m-Y') }}">

                            @error('tg_data_final')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="tg_divisoes" class="col-md-4 col-form-label text-md-end">{{ __('*Divisões do treino') }}</label>

                        <div class="col-md-6">
                            <select name="tg_divisoes" id="tg_divisoes"
                            class="form-select @error('tg_divisoes') is-invalid @enderror"
                            value="{{ old('tg_divisoes') }}" required autocomplete="tg_divisoes">
                                <option value="A" @if($treinoGeral->tg_divisoes == 'A') selected @endif>A</option>
                                <option value="AB" @if($treinoGeral->tg_divisoes == 'AB') selected @endif>AB</option>
                                <option value="ABC" @if($treinoGeral->tg_divisoes == 'ABC') selected @endif>ABC</option>
                                <option value="ABCD" @if($treinoGeral->tg_divisoes == 'ABCD') selected @endif>ABCD</option>
                                <option value="ABCDE" @if($treinoGeral->tg_divisoes == 'ABCDE') selected @endif>ABCDE</option>
                                <option value="ABCDEF" @if($treinoGeral->tg_divisoes == 'ABCDEF') selected @endif>ABCDEF</option>
                            </select>

                            @error('tg_divisoes')
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

    <!-- Modal de excluir/limpar treino -->
  @foreach($treinoGerals as $treinoGeral)
  <div class="modal fade" id="excluirTreinoGeralModal{{$treinoGeral->id}}" tabindex="-1" role="dialog" aria-labelledby="excluirTreinoGeralModal{{$treinoGeral->id}}" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title font-weight-normal" id="excluirTreinoGeralModal{{$treinoGeral->id}}">Excluir treino</h5>
            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Qual ação você deseja fazer com esse treino?</p>
            <form action="{{ route('treinos.limparGeral',$treinoGeral->id) }}" method="POST">

                @csrf
                @method('DELETE')

          </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger">Limpar exercícios do treino</button>
            </form>
            <form action="{{ route('treinos.destroyGeral',$treinoGeral->id) }}" method="POST">

                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger">Excluir treino</button>
            </form>
            </div>
        </div>
      </div>
    </div>
  @endforeach
