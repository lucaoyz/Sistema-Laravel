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

<!-- tela de treinos -->
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
<div class="modal fade" id="TreinoModal" tabindex="-1" role="dialog" aria-labelledby="TreinoModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 750px">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="TreinoModal">Treinos</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <h5 class="mb-0"><a href="" data-bs-toggle="modal" data-bs-target="#criarTreinoModal" class="btn btn-success">Registre um novo treino</a></h5>

            <form action="{{route('treinos.search')}}" method="post">
                @csrf
                <div class="input-group input-group-outline my-3">
                    <!-- Campo de texto para digitar oque será filtrado -->
                    <input type="text" name="search" class="form-control" style="max-height: 42.5px" placeholder="Filtrar por nome do aluno ou data!">
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
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nome do aluno</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nome do professor</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Dias por semana</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tempo</th>
                        <th class="text-secondary text-uppercase text-xxs font-weight-bolder opacity-7">Ações</th>
                    </tr>
                </thead>

              <tbody>

                <!-- Laço de repetição dos exercicios -->
                @foreach ($treinos as $treino)
                <tr>

                    <!-- Nome do exercício-->
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">{{ $treino->alu_nome }}</h6>
                      </div>
                    </div>
                  </td>

                  <!-- Membro muscular -->
                  <td>
                    <p class="text-xs font-weight-bold mb-0">{{ $treino->per_nome }}</p>
                  </td>

                  <!-- Descrição -->
                  <td class="align-middle text-center text-sm">
                    <p class="text-xs font-weight-bold mb-0">{{ $treino->tre_dias_semana }}</p>
                  </td>
                  <!-- Descrição -->
                  <td class="align-middle text-center text-sm">
                    <p class="text-xs font-weight-bold mb-0">{{ $treino->tre_tempo }}</p>
                  </td>

                  <!-- Botoes de ação -->
                  <td class="align-middle">

                        <!-- Editar -->
                        <a class="btn btn-primary" href="{{ route('treinos.edit',$treino->id) }}" data-bs-toggle="modal" data-bs-target="#{{$treino->id}}">Editar</a>

                        <!-- Remover -->
                        <a href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#{{$treino->id}}">Excluir</a>

                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <!-- Paginação com e sem filtros -->
            @if (isset($filters))
            {{ $treinos->appends($filters)->links() }}
        @else
            {{ $treinos->links() }}
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
