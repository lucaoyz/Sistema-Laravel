<!-- Modal de histórico -->
<div class="modal fade" id="historicoTreino" tabindex="-1" role="dialog" aria-labelledby="historicoTreino" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="historicoTreino">Saiba mais</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            Histórico de treinos em ordem de conclusão:
            @foreach ($historicoTreinos as $historicoTreino)
                {{$historicoTreino->ht_divisao}}
            @endforeach
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>

