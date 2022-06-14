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

<!-- tela de exercicio -->
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
<div class="modal fade" id="ExercicioModal" tabindex="-1" role="dialog" aria-labelledby="ExercicioModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 750px">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="ExercicioModal">Exercícios</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <h5 class="mb-0"><a href="" data-bs-toggle="modal" data-bs-target="#criarExercicioModal" class="btn btn-success">Registre um novo exercicio</a></h5>

            <form action="{{route('exercicios.search')}}" method="post">
                @csrf
                <div class="input-group input-group-outline my-3">
                    <!-- Campo de texto para digitar oque será filtrado -->
                    <input type="text" name="search" class="form-control" style="max-height: 42.5px" placeholder="Filtrar por nome, email ou cpf">
                    <!-- Botão para filtrar -->
                    <button class="btn btn-primary" type="submit">Filtrar</button>
                    <!-- Botão para limpar filtro -->
                    <a class="btn btn-outline-secondary" href="{{route('treinos.index')}}">Limpar filtro</a>
                  </div>
            </form>

            <table class="table align-items-center mb-0">
                <!-- Dados que vão ser coletados -->
                <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nome do exercício</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Membro Muscular</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Descrição</th>
                        <th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7">Ações</th>
                    </tr>
                </thead>

              <tbody>

                <!-- Laço de repetição dos exercicios -->
                @foreach ($exercicios as $exercicio)
                <tr>

                    <!-- Nome do exercício-->
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">{{ $exercicio->exe_nome }}</h6>
                      </div>
                    </div>
                  </td>

                  <!-- Membro muscular -->
                  <td>
                    <p class="text-xs font-weight-bold mb-0">{{ $exercicio->exe_membro }}</p>
                  </td>

                  <!-- Descrição -->
                  <td class="align-middle text-center text-sm">
                    <p class="text-xs font-weight-bold mb-0">{{ $exercicio->exe_descricao }}</p>
                  </td>

                  <!-- Botoes de ação -->
                  <td class="align-middle">

                        <!-- Editar -->
                        <a class="btn btn-primary" href="{{ route('exercicios.edit',$exercicio->id) }}" data-bs-toggle="modal" data-bs-target="#editarExercicioModal{{$exercicio->id}}">Editar</a>

                        <!-- Remover -->
                        <a href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#excluirExercicioModal{{$exercicio->id}}">Excluir</a>

                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <!-- Paginação com e sem filtros -->
            @if (isset($filters))
            {{ $exercicios->appends($filters)->links() }}
        @else
            {{ $exercicios->links() }}
        @endif

        </div>
        <div class="modal-footer">
            <div class="row mb-0">
                <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </form>
      </div>
    </div>
  </div>


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
