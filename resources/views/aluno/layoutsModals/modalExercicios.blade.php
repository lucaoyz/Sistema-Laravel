<!-- Modal de saiba mais A -->
@foreach ($treinoAAlunos as $treinoAAluno)
<div class="modal fade" id="saibaMaisTreinoDetalhesDivisaoA{{$treinoAAluno->exe_id}}" tabindex="-1" role="dialog" aria-labelledby="saibaMaisTreinoDetalhesDivisaoA{{$treinoAAluno->exe_id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="saibaMaisTreinoDetalhesDivisaoA{{$treinoAAluno->exe_id}}">Saiba mais</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <p>Observações do exercicio: <span style="font-style: bold;">{{$treinoAAluno->exe_descricao}}</span></p>
            <p>Foto do exercício:</p>
                <img style="border-radius: 5px;" src="/img/exercicios/{{$treinoAAluno->exe_foto}}" width="200px">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>
@endforeach

<!-- Modal de saiba mais B -->
@foreach ($treinoBAlunos as $treinoBAluno)
<div class="modal fade" id="saibaMaisTreinoDetalhesDivisaoB{{$treinoBAluno->exe_id}}" tabindex="-1" role="dialog" aria-labelledby="saibaMaisTreinoDetalhesDivisaoB{{$treinoAAluno->exe_id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="saibaMaisTreinoDetalhesDivisaoB{{$treinoBAluno->exe_id}}">Saiba mais</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <p>Observações do exercicio: <span style="font-style: bold;">{{$treinoBAluno->exe_descricao}}</span></p>
            <p>Foto do exercício:</p>
                <img style="border-radius: 5px;" src="/img/exercicios/{{$treinoBAluno->exe_foto}}" width="200px">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>
@endforeach

<!-- Modal de saiba mais C -->
@foreach ($treinoCAlunos as $treinoCAluno)
<div class="modal fade" id="saibaMaisTreinoDetalhesDivisaoC{{$treinoCAluno->exe_id}}" tabindex="-1" role="dialog" aria-labelledby="saibaMaisTreinoDetalhesDivisaoC{{$treinoCAluno->exe_id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="saibaMaisTreinoDetalhesDivisaoC{{$treinoCAluno->exe_id}}">Saiba mais</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <p>Observações do exercicio: <span style="font-style: bold;">{{$treinoCAluno->exe_descricao}}</span></p>
            <p>Foto do exercício:</p>
                <img style="border-radius: 5px;" src="/img/exercicios/{{$treinoCAluno->exe_foto}}" width="200px">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>
@endforeach

<!-- Modal de saiba mais D -->
@foreach ($treinoDAlunos as $treinoDAluno)
<div class="modal fade" id="saibaMaisTreinoDetalhesDivisaoD{{$treinoDAluno->exe_id}}" tabindex="-1" role="dialog" aria-labelledby="saibaMaisTreinoDetalhesDivisaoD{{$treinoDAluno->exe_id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="saibaMaisTreinoDetalhesDivisaoD{{$treinoDAluno->exe_id}}">Saiba mais</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <p>Observações do exercicio: <span style="font-style: bold;">{{$treinoDAluno->exe_descricao}}</span></p>
            <p>Foto do exercício:</p>
                <img style="border-radius: 5px;" src="/img/exercicios/{{$treinoDAluno->exe_foto}}" width="200px">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>
@endforeach

<!-- Modal de saiba mais E -->
@foreach ($treinoEAlunos as $treinoEAluno)
<div class="modal fade" id="saibaMaisTreinoDetalhesDivisaoE{{$treinoEAluno->exe_id}}" tabindex="-1" role="dialog" aria-labelledby="saibaMaisTreinoDetalhesDivisaoE{{$treinoEAluno->exe_id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="saibaMaisTreinoDetalhesDivisaoE{{$treinoEAluno->exe_id}}">Saiba mais</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <p>Observações do exercicio: <span style="font-style: bold;">{{$treinoEAluno->exe_descricao}}</span></p>
            <p>Foto do exercício:</p>
                <img style="border-radius: 5px;" src="/img/exercicios/{{$treinoEAluno->exe_foto}}" width="200px">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>
@endforeach

<!-- Modal de saiba mais F -->
@foreach ($treinoFAlunos as $treinoFAluno)
<div class="modal fade" id="saibaMaisTreinoDetalhesDivisaoF{{$treinoFAluno->exe_id}}" tabindex="-1" role="dialog" aria-labelledby="saibaMaisTreinoDetalhesDivisaoF{{$treinoFAluno->exe_id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="saibaMaisTreinoDetalhesDivisaoF{{$treinoFAluno->exe_id}}">Saiba mais</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <p>Observações do exercicio: <span style="font-style: bold;">{{$treinoFAluno->exe_descricao}}</span></p>
            <p>Foto do exercício:</p>
                <img style="border-radius: 5px;" src="/img/exercicios/{{$treinoFAluno->exe_foto}}" width="200px">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>
@endforeach

