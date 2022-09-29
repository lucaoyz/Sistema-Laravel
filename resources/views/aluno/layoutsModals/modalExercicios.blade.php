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

