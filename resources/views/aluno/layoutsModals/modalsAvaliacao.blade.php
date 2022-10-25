<!-- Modal de historico -->

<div class="modal fade" id="visualizaHistoricoAvaliacao{{$aluno->id}}" tabindex="-1" role="dialog" aria-labelledby="visualizaHistoricoAvaliacao{{$aluno->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="visualizaHistoricoAvaliacao{{$aluno->id}}">Histórico de avaliação física</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            @foreach ($avaliacaoFisicaRecentes as $avaliacaoFisicaRecente)
                <a class="btn bg-gradient-secondary" data-bs-toggle="modal" data-bs-target="#visualizarAvaliacaoFisica{{$aluno->id}}{{$avaliacaoFisicaRecente->id}}">Ver avaliação física | {{$avaliacaoFisicaRecente->created_at->format('d/m/Y')}}</a>
            @endforeach
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>

<!-- Modal de visualizar -->
@foreach ($avaliacaoFisicaRecentes as $avaliacaoFisicaRecente)
<div class="modal fade" id="visualizarAvaliacaoFisica{{$aluno->id}}{{$avaliacaoFisicaRecente->id}}" tabindex="-1" role="dialog" aria-labelledby="visualizarAvaliacaoFisica{{$aluno->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="visualizarAvaliacaoFisica{{$aluno->id}}">Saiba mais</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <h3 style="text-align: center; font-size: 24px;">Nome: {{$aluno->alu_nome}}</h3>
            <p style="text-align: center; font-size: 20px;">KG: {{$avaliacaoFisicaRecente->af_kg}}<br>
            Altura: {{$avaliacaoFisicaRecente->af_altura}}<br>
            IMC: {{$avaliacaoFisicaRecente->af_imc}}<br>
            <span style="font-size: 16px">Data da avaliação: {{$avaliacaoFisicaRecente->created_at->format('d/m/Y')}}<br>
            Objetivo: {{$avaliacaoFisicaRecente->af_objetivo}}</span>
        </p>
            <h6>Medidas (cm)</h6>
            <p>Massa Gorda (Gordura): {{$avaliacaoFisicaRecente->af_massa_gorda}}</p>
            <p>Massa Magra (Musculo): {{$avaliacaoFisicaRecente->af_massa_musculo}}</p>
            <p>Medida do Braço Esquerdo (cm): {{$avaliacaoFisicaRecente->af_cm_bracoE}}</p>
            <p>Medida do Braço Direito (cm): {{$avaliacaoFisicaRecente->af_cm_bracoD}}</p>
            <p>Medida do Antebraço Esquerdo (cm): {{$avaliacaoFisicaRecente->af_cm_antebracoE}}</p>
            <p>Medida do Antebraço Direito (cm): {{$avaliacaoFisicaRecente->af_cm_antebracoD}}</p>
            <p>Medida da Coxa Esquerda (cm): {{$avaliacaoFisicaRecente->af_cm_coxaE}}</p>
            <p>Medida da Coxa Direita (cm): {{$avaliacaoFisicaRecente->af_cm_coxaD}}</p>
            <p>Medida da Panturrilha Esquerda (cm): {{$avaliacaoFisicaRecente->af_cm_panturrilhaE}}</p>
            <p>Medida da Panturrilha Direita (cm): {{$avaliacaoFisicaRecente->af_cm_panturrilhaD}}</p>
            <p>Medida do Torax (cm): {{$avaliacaoFisicaRecente->af_cm_torax}}</p>
            <p>Medida do Cintura (cm): {{$avaliacaoFisicaRecente->af_cm_cintura}}</p>
            <p>Medida do Abdomen (cm): {{$avaliacaoFisicaRecente->af_cm_abdomen}}</p>
            <p>Medida do Quadril (cm): {{$avaliacaoFisicaRecente->af_cm_quadril}}</p>
            <p>Medida do Pescoço (cm): {{$avaliacaoFisicaRecente->af_cm_pescoço}}</p>
            <p>Medida do Ombro (cm): {{$avaliacaoFisicaRecente->af_cm_ombro}}</p><br>
            <h6>Dobras Cutâneas (cm)</h6>
            <p>Dobras Cutânea Subescapular(cm): {{$avaliacaoFisicaRecente->af_dc_subescapular}}</p>
            <p>Dobras Cutânea Triceps(cm): {{$avaliacaoFisicaRecente->af_dc_triceps}}</p>
            <p>Dobras Cutânea Biceps(cm): {{$avaliacaoFisicaRecente->af_dc_biceps}}</p>
            <p>Dobras Cutânea Torax(cm): {{$avaliacaoFisicaRecente->af_dc_torax}}</p>
            <p>Dobras Cutânea Axilar Média(cm): {{$avaliacaoFisicaRecente->af_dc_axilarMedia}}</p>
            <p>Dobras Cutânea Suprailiaca(cm): {{$avaliacaoFisicaRecente->af_dc_suprailiaca}}</p>
            <p>Dobras Cutânea Abdominal(cm): {{$avaliacaoFisicaRecente->af_dc_abdominal}}</p>
            <p>Dobras Cutânea Coxa Medial(cm): {{$avaliacaoFisicaRecente->af_dc_coxaMedial}}</p>
            <p>Dobras Cutânea Panturrilha Medial(cm): {{$avaliacaoFisicaRecente->af_dc_panturrilhaMedial}}</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>
  @endforeach
<!-- Modal de visualizar -->
<div class="modal fade" id="visualizarAvaliacaoFisicaRecente{{$aluno->id}}" tabindex="-1" role="dialog" aria-labelledby="visualizarAvaliacaoFisica{{$aluno->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="visualizarAvaliacaoFisica{{$aluno->id}}">Saiba mais</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <h3 style="text-align: center; font-size: 24px;">Nome: {{$aluno->alu_nome}}</h3>
            <p style="text-align: center; font-size: 20px;">KG: {{$avaliacaoFisica->af_kg}}<br>
            Altura: {{$avaliacaoFisica->af_altura}}<br>
            IMC: {{$avaliacaoFisica->af_imc}}<br>
            <span style="font-size: 16px">Data da avaliação: {{$avaliacaoFisica->created_at->format('d/m/Y')}}<br>
            Objetivo: {{$avaliacaoFisica->af_objetivo}}</span>
        </p>
            <h6>Medidas (cm)</h6>
            <p>Massa Gorda (Gordura): {{$avaliacaoFisica->af_massa_gorda}}</p>
            <p>Massa Magra (Musculo): {{$avaliacaoFisica->af_massa_musculo}}</p>
            <p>Medida do Braço Esquerdo (cm): {{$avaliacaoFisica->af_cm_bracoE}}</p>
            <p>Medida do Braço Direito (cm): {{$avaliacaoFisica->af_cm_bracoD}}</p>
            <p>Medida do Antebraço Esquerdo (cm): {{$avaliacaoFisica->af_cm_antebracoE}}</p>
            <p>Medida do Antebraço Direito (cm): {{$avaliacaoFisica->af_cm_antebracoD}}</p>
            <p>Medida da Coxa Esquerda (cm): {{$avaliacaoFisica->af_cm_coxaE}}</p>
            <p>Medida da Coxa Direita (cm): {{$avaliacaoFisica->af_cm_coxaD}}</p>
            <p>Medida da Panturrilha Esquerda (cm): {{$avaliacaoFisica->af_cm_panturrilhaE}}</p>
            <p>Medida da Panturrilha Direita (cm): {{$avaliacaoFisica->af_cm_panturrilhaD}}</p>
            <p>Medida do Torax (cm): {{$avaliacaoFisica->af_cm_torax}}</p>
            <p>Medida do Cintura (cm): {{$avaliacaoFisica->af_cm_cintura}}</p>
            <p>Medida do Abdomen (cm): {{$avaliacaoFisica->af_cm_abdomen}}</p>
            <p>Medida do Quadril (cm): {{$avaliacaoFisica->af_cm_quadril}}</p>
            <p>Medida do Pescoço (cm): {{$avaliacaoFisica->af_cm_pescoço}}</p>
            <p>Medida do Ombro (cm): {{$avaliacaoFisica->af_cm_ombro}}</p><br>
            <h6>Dobras Cutâneas (cm)</h6>
            <p>Dobras Cutânea Subescapular(cm): {{$avaliacaoFisica->af_dc_subescapular}}</p>
            <p>Dobras Cutânea Triceps(cm): {{$avaliacaoFisica->af_dc_triceps}}</p>
            <p>Dobras Cutânea Biceps(cm): {{$avaliacaoFisica->af_dc_biceps}}</p>
            <p>Dobras Cutânea Torax(cm): {{$avaliacaoFisica->af_dc_torax}}</p>
            <p>Dobras Cutânea Axilar Média(cm): {{$avaliacaoFisica->af_dc_axilarMedia}}</p>
            <p>Dobras Cutânea Suprailiaca(cm): {{$avaliacaoFisica->af_dc_suprailiaca}}</p>
            <p>Dobras Cutânea Abdominal(cm): {{$avaliacaoFisica->af_dc_abdominal}}</p>
            <p>Dobras Cutânea Coxa Medial(cm): {{$avaliacaoFisica->af_dc_coxaMedial}}</p>
            <p>Dobras Cutânea Panturrilha Medial(cm): {{$avaliacaoFisica->af_dc_panturrilhaMedial}}</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>
