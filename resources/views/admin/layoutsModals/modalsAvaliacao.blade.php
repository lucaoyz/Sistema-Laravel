<!-- Criar Avaliação Fisica -->
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
<div class="modal fade" id="criarAvaliacaoFisica" tabindex="-1" role="dialog" aria-labelledby="criarAvaliacaoFisica" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 750px">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="criarAvaliacaoFisica">Criar</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('alunos.avaliacaoFisicaStore', $aluno->id) }}" method="POST">
                @csrf


                    <div class="row mb-3">
                        <label for="alu_id" class="col-md-4 col-form-label text-md-end">{{ __('ID Aluno') }}</label>

                        <div class="col-md-6">
                            <input id="alu_id" type="text"  {{ $aluno->id ? 'readonly' : '' }}
                            class="form-control @error('alu_id') is-invalid @enderror"
                            name="alu_id" value="{{$aluno->id}}" autocomplete="alu_id" autofocus
                            >

                            @error('alu_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_kg" class="col-md-4 col-form-label text-md-end">{{ __('*Peso do Aluno') }}</label>

                        <div class="col-md-6">
                            <input id="af_kg" type="text"
                            class="form-control @error('af_kg') is-invalid @enderror"
                            name="af_kg" value="{{ old('af_kg') }}" required autocomplete="af_kg" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira o peso do aluno">

                            @error('af_kg')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_altura" class="col-md-4 col-form-label text-md-end">{{ __('*Altura do Aluno') }}</label>

                        <div class="col-md-6">
                            <input id="af_altura" type="text"
                            class="form-control @error('af_altura') is-invalid @enderror"
                            name="af_altura" value="{{ old('af_altura') }}" required autocomplete="af_altura" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a altura do aluno">

                            @error('af_altura')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_massa_gorda" class="col-md-4 col-form-label text-md-end">{{ __('Massa gorda do Aluno (Gordura/kg)') }}</label>

                        <div class="col-md-6">
                            <input id="af_massa_gorda" type="text"
                            class="form-control @error('af_massa_gorda') is-invalid @enderror"
                            name="af_massa_gorda" value="{{ old('af_massa_gorda') }}" autocomplete="af_massa_gorda" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a massa gorda do aluno">

                            @error('af_massa_gorda')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_massa_magra" class="col-md-4 col-form-label text-md-end">{{ __('Massa magra do Aluno (Músculo/kg)') }}</label>

                        <div class="col-md-6">
                            <input id="af_massa_magra" type="text"
                            class="form-control @error('af_massa_magra') is-invalid @enderror"
                            name="af_massa_magra" value="{{ old('af_massa_magra') }}" autocomplete="af_massa_magra" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a massa magra do aluno">

                            @error('af_massa_magra')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_imc" class="col-md-4 col-form-label text-md-end">{{ __('IMC do Aluno') }}</label>

                        <div class="col-md-6">
                            <input id="af_imc" type="text" {{ 'IMC Calculado automaticamente' ? 'readonly' : '' }}
                            class="form-control @error('af_imc') is-invalid @enderror"
                            name="af_imc" value="{{ old('af_imc') }}" autocomplete="af_imc" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="IMC Calculado automaticamente">

                            @error('af_massa_magra')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_cm_bracoE" class="col-md-4 col-form-label text-md-end">{{ __('Medida do braço esquerdo do Aluno (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_cm_bracoE" type="text"
                            class="form-control @error('af_cm_bracoE') is-invalid @enderror"
                            name="af_cm_bracoE" value="{{ old('af_cm_bracoE') }}" autocomplete="af_cm_bracoE" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida do braço esquerdo (cm)">

                            @error('af_cm_bracoE')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_cm_bracoD" class="col-md-4 col-form-label text-md-end">{{ __('Medida do braço direito do Aluno (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_cm_bracoD" type="text"
                            class="form-control @error('af_cm_bracoD') is-invalid @enderror"
                            name="af_cm_bracoD" value="{{ old('af_cm_bracoD') }}" autocomplete="af_cm_bracoD" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida do braço direito (cm)">

                            @error('af_cm_bracoD')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_cm_antebracoE" class="col-md-4 col-form-label text-md-end">{{ __('Medida do antebraço esquerdo do Aluno (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_cm_antebracoE" type="text"
                            class="form-control @error('af_cm_antebracoE') is-invalid @enderror"
                            name="af_cm_antebracoE" value="{{ old('af_cm_antebracoE') }}" autocomplete="af_cm_antebracoE" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida do antebraço esquerdo (cm)">

                            @error('af_cm_antebracoE')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_cm_antebracoD" class="col-md-4 col-form-label text-md-end">{{ __('Medida do antebraço direito do Aluno (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_cm_antebracoD" type="text"
                            class="form-control @error('af_cm_antebracoD') is-invalid @enderror"
                            name="af_cm_antebracoD" value="{{ old('af_cm_antebracoD') }}" autocomplete="af_cm_antebracoD" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida do antebraço direito (cm)">

                            @error('af_cm_antebracoD')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_cm_coxaE" class="col-md-4 col-form-label text-md-end">{{ __('Medida da coxa esquerda do Aluno (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_cm_coxaE" type="text"
                            class="form-control @error('af_cm_coxaE') is-invalid @enderror"
                            name="af_cm_coxaE" value="{{ old('af_cm_coxaE') }}" autocomplete="af_cm_coxaE" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida da coxa esquerda (cm)">

                            @error('af_cm_coxaE')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_cm_coxaD" class="col-md-4 col-form-label text-md-end">{{ __('Medida da coxa direita do Aluno (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_cm_coxaD" type="text"
                            class="form-control @error('af_cm_coxaD') is-invalid @enderror"
                            name="af_cm_coxaD" value="{{ old('af_cm_coxaD') }}" autocomplete="af_cm_coxaD" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida da coxa direita (cm)">

                            @error('af_cm_coxaD')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_cm_panturrilhaE" class="col-md-4 col-form-label text-md-end">{{ __('Medida da panturrilha esquerda do Aluno (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_cm_panturrilhaE" type="text"
                            class="form-control @error('af_cm_panturrilhaE') is-invalid @enderror"
                            name="af_cm_panturrilhaE" value="{{ old('af_cm_panturrilhaE') }}" autocomplete="af_cm_panturrilhaE" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida da panturrilha esquerda (cm)">

                            @error('af_cm_panturrilhaE')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_cm_panturrilhaD" class="col-md-4 col-form-label text-md-end">{{ __('Medida da panturrilha direita do Aluno (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_cm_panturrilhaD" type="text"
                            class="form-control @error('af_cm_panturrilhaD') is-invalid @enderror"
                            name="af_cm_panturrilhaD" value="{{ old('af_cm_panturrilhaD') }}" autocomplete="af_cm_panturrilhaD" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida da panturrilha direita (cm)">

                            @error('af_cm_panturrilhaD')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_cm_torax" class="col-md-4 col-form-label text-md-end">{{ __('Medida do torax do Aluno (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_cm_torax" type="text"
                            class="form-control @error('af_cm_torax') is-invalid @enderror"
                            name="af_cm_torax" value="{{ old('af_cm_torax') }}" autocomplete="af_cm_torax" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida do torax (cm)">

                            @error('af_cm_torax')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_cm_cintura" class="col-md-4 col-form-label text-md-end">{{ __('Medida da cintura do Aluno (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_cm_cintura" type="text"
                            class="form-control @error('af_cm_cintura') is-invalid @enderror"
                            name="af_cm_cintura" value="{{ old('af_cm_cintura') }}" autocomplete="af_cm_cintura" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida da cintura (cm)">

                            @error('af_cm_cintura')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_cm_abdomen" class="col-md-4 col-form-label text-md-end">{{ __('Medida do abdomen do Aluno (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_cm_abdomen" type="text"
                            class="form-control @error('af_cm_abdomen') is-invalid @enderror"
                            name="af_cm_abdomen" value="{{ old('af_cm_abdomen') }}" autocomplete="af_cm_abdomen" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida do abdomen (cm)">

                            @error('af_cm_abdomen')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_cm_quadril" class="col-md-4 col-form-label text-md-end">{{ __('Medida do quadril do Aluno (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_cm_quadril" type="text"
                            class="form-control @error('af_cm_quadril') is-invalid @enderror"
                            name="af_cm_quadril" value="{{ old('af_cm_quadril') }}" autocomplete="af_cm_quadril" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida do quadril (cm)">

                            @error('af_cm_quadril')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_cm_pescoco" class="col-md-4 col-form-label text-md-end">{{ __('Medida do pescoço do Aluno (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_cm_pescoco" type="text"
                            class="form-control @error('af_cm_pescoco') is-invalid @enderror"
                            name="af_cm_pescoco" value="{{ old('af_cm_pescoco') }}" autocomplete="af_cm_pescoco" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida do pescoço (cm)">

                            @error('af_cm_pescoco')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_cm_ombro" class="col-md-4 col-form-label text-md-end">{{ __('Medida do ombro do Aluno (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_cm_ombro" type="text"
                            class="form-control @error('af_cm_ombro') is-invalid @enderror"
                            name="af_cm_ombro" value="{{ old('af_cm_ombro') }}" autocomplete="af_cm_ombro" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida do ombro (cm)">

                            @error('af_cm_ombro')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_dc_subescapular" class="col-md-4 col-form-label text-md-end">{{ __('Medida da dobra cutânea da subescapular (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_dc_subescapular" type="text"
                            class="form-control @error('af_dc_subescapular') is-invalid @enderror"
                            name="af_dc_subescapular" value="{{ old('af_dc_subescapular') }}" autocomplete="af_dc_subescapular" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida da dobra cutânea da subescapular (cm)">

                            @error('af_dc_subescapular')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_dc_triceps" class="col-md-4 col-form-label text-md-end">{{ __('Medida da dobra cutânea do triceps (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_dc_triceps" type="text"
                            class="form-control @error('af_dc_triceps') is-invalid @enderror"
                            name="af_dc_triceps" value="{{ old('af_dc_triceps') }}" autocomplete="af_dc_triceps" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida da dobra cutânea do triceps (cm)">

                            @error('af_dc_triceps')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_dc_biceps" class="col-md-4 col-form-label text-md-end">{{ __('Medida da dobra cutânea do biceps (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_dc_biceps" type="text"
                            class="form-control @error('af_dc_biceps') is-invalid @enderror"
                            name="af_dc_biceps" value="{{ old('af_dc_biceps') }}" autocomplete="af_dc_biceps" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida da dobra cutânea do biceps (cm)">

                            @error('af_dc_biceps')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_dc_torax" class="col-md-4 col-form-label text-md-end">{{ __('Medida da dobra cutânea do torax (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_dc_torax" type="text"
                            class="form-control @error('af_dc_torax') is-invalid @enderror"
                            name="af_dc_torax" value="{{ old('af_dc_torax') }}" autocomplete="af_dc_torax" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida da dobra cutânea do torax (cm)">

                            @error('af_dc_torax')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_dc_axilarMedia" class="col-md-4 col-form-label text-md-end">{{ __('Medida da dobra cutânea da axilar média (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_dc_axilarMedia" type="text"
                            class="form-control @error('af_dc_axilarMedia') is-invalid @enderror"
                            name="af_dc_axilarMedia" value="{{ old('af_dc_axilarMedia') }}" autocomplete="af_dc_axilarMedia" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida da dobra cutânea da axilar média (cm)">

                            @error('af_dc_axilarMedia')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_dc_suprailiaca" class="col-md-4 col-form-label text-md-end">{{ __('Medida da dobra cutânea da suprailiaca (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_dc_suprailiaca" type="text"
                            class="form-control @error('af_dc_suprailiaca') is-invalid @enderror"
                            name="af_dc_suprailiaca" value="{{ old('af_dc_suprailiaca') }}" autocomplete="af_dc_suprailiaca" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida da dobra cutânea da suprailiaca (cm)">

                            @error('af_dc_suprailiaca')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_dc_abdominal" class="col-md-4 col-form-label text-md-end">{{ __('Medida da dobra cutânea abdominal (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_dc_abdominal" type="text"
                            class="form-control @error('af_dc_abdominal') is-invalid @enderror"
                            name="af_dc_abdominal" value="{{ old('af_dc_abdominal') }}" autocomplete="af_dc_abdominal" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida da dobra cutânea abdominal (cm)">

                            @error('af_dc_abdominal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_dc_coxaMedial" class="col-md-4 col-form-label text-md-end">{{ __('Medida da dobra cutânea da coxa medial (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_dc_coxaMedial" type="text"
                            class="form-control @error('af_dc_coxaMedial') is-invalid @enderror"
                            name="af_dc_coxaMedial" value="{{ old('af_dc_coxaMedial') }}" autocomplete="af_dc_coxaMedial" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida da dobra cutânea da coxa medial (cm)">

                            @error('af_dc_coxaMedial')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_dc_panturrilhaMedial" class="col-md-4 col-form-label text-md-end">{{ __('Medida da dobra cutânea da panturrilha medial (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_dc_panturrilhaMedial" type="text"
                            class="form-control @error('af_dc_panturrilhaMedial') is-invalid @enderror"
                            name="af_dc_panturrilhaMedial" value="{{ old('af_dc_panturrilhaMedial') }}" autocomplete="af_dc_panturrilhaMedial" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida da dobra cutânea da panturrilha medial (cm)">

                            @error('af_dc_panturrilhaMedial')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_objetivo" class="col-md-4 col-form-label text-md-end">{{ __('Objetivo do aluno') }}</label>

                        <div class="col-md-6">
                            <input id="af_objetivo" type="text"
                            class="form-control @error('af_objetivo') is-invalid @enderror"
                            name="af_objetivo" value="{{ old('af_objetivo') }}" autocomplete="af_objetivo" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira o objetivo do aluno">

                            @error('af_objetivo')
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

  <!-- Editar Avaliação Fisica -->
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
@foreach ($avaliacaoFisicas as $avaliacaoFisica)
<div class="modal fade" id="editarAvaliacaoFisica{{$aluno->id}}{{$avaliacaoFisica->id}}" tabindex="-1" role="dialog" aria-labelledby="editarAvaliacaoFisica{{$aluno->id}}{{$avaliacaoFisica->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 750px">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="editarAvaliacaoFisica{{$aluno->id}}{{$avaliacaoFisica->id}}">Editar</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('alunos.avaliacaoFisicaUpdate', $aluno->id) }}" method="POST">
                @csrf
                @method('PUT')


                    <div class="row mb-3">
                        <label for="id" class="col-md-4 col-form-label text-md-end">{{ __('ID') }}</label>

                        <div class="col-md-6">
                            <input id="id" type="text" {{ $avaliacaoFisica->id ? 'readonly' : '' }}
                            class="form-control @error('id') is-invalid @enderror"
                            name="id" value="{{ $avaliacaoFisica->id }}" required autocomplete="id" autofocus>

                            @error('id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="alu_id" class="col-md-4 col-form-label text-md-end">{{ __('ID Aluno') }}</label>

                        <div class="col-md-6">
                            <input id="alu_id" type="text"  {{ $aluno->id ? 'readonly' : '' }}
                            class="form-control @error('alu_id') is-invalid @enderror"
                            name="alu_id" value="{{$aluno->id}}" autocomplete="alu_id" autofocus
                            >

                            @error('alu_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_kg" class="col-md-4 col-form-label text-md-end">{{ __('Peso do Aluno') }}</label>

                        <div class="col-md-6">
                            <input id="af_kg" type="text"
                            class="form-control @error('af_kg') is-invalid @enderror"
                            name="af_kg" value="{{$avaliacaoFisica->af_kg}}" autocomplete="af_kg" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira o peso do aluno">

                            @error('af_kg')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_altura" class="col-md-4 col-form-label text-md-end">{{ __('Altura do Aluno') }}</label>

                        <div class="col-md-6">
                            <input id="af_altura" type="text"
                            class="form-control @error('af_altura') is-invalid @enderror"
                            name="af_altura" value="{{$avaliacaoFisica->af_altura}}" autocomplete="af_altura" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a altura do aluno">

                            @error('af_altura')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_massa_gorda" class="col-md-4 col-form-label text-md-end">{{ __('Massa gorda do Aluno') }}</label>

                        <div class="col-md-6">
                            <input id="af_massa_gorda" type="text"
                            class="form-control @error('af_massa_gorda') is-invalid @enderror"
                            name="af_massa_gorda" value="{{$avaliacaoFisica->af_massa_gorda}}" autocomplete="af_massa_gorda" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a massa gorda do aluno">

                            @error('af_massa_gorda')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_massa_magra" class="col-md-4 col-form-label text-md-end">{{ __('Massa magra do Aluno') }}</label>

                        <div class="col-md-6">
                            <input id="af_massa_magra" type="text"
                            class="form-control @error('af_massa_magra') is-invalid @enderror"
                            name="af_massa_magra" value="{{$avaliacaoFisica->af_massa_magra}}" autocomplete="af_massa_magra" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a massa magra do aluno">

                            @error('af_massa_magra')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_imc" class="col-md-4 col-form-label text-md-end">{{ __('IMC do Aluno') }}</label>

                        <div class="col-md-6">
                            <input id="af_imc" type="text" {{ 'IMC Calculado automaticamente' ? 'readonly' : '' }}
                            class="form-control @error('af_imc') is-invalid @enderror"
                            name="af_imc" value="{{$avaliacaoFisica->af_imc}}" autocomplete="af_imc" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="IMC Calculado automaticamente">

                            @error('af_massa_magra')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_cm_bracoE" class="col-md-4 col-form-label text-md-end">{{ __('Medida do braço esquerdo do Aluno (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_cm_bracoE" type="text"
                            class="form-control @error('af_cm_bracoE') is-invalid @enderror"
                            name="af_cm_bracoE" value="{{$avaliacaoFisica->af_cm_bracoE}}" autocomplete="af_cm_bracoE" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida do braço esquerdo (cm)">

                            @error('af_cm_bracoE')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_cm_bracoD" class="col-md-4 col-form-label text-md-end">{{ __('Medida do braço direito do Aluno (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_cm_bracoD" type="text"
                            class="form-control @error('af_cm_bracoD') is-invalid @enderror"
                            name="af_cm_bracoD" value="{{$avaliacaoFisica->af_cm_bracoD}}" autocomplete="af_cm_bracoD" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida do braço direito (cm)">

                            @error('af_cm_bracoD')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_cm_antebracoE" class="col-md-4 col-form-label text-md-end">{{ __('Medida do antebraço esquerdo do Aluno (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_cm_antebracoE" type="text"
                            class="form-control @error('af_cm_antebracoE') is-invalid @enderror"
                            name="af_cm_antebracoE" value="{{$avaliacaoFisica->af_cm_antebracoE}}" autocomplete="af_cm_antebracoE" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida do antebraço esquerdo (cm)">

                            @error('af_cm_antebracoE')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_cm_antebracoD" class="col-md-4 col-form-label text-md-end">{{ __('Medida do antebraço direito do Aluno (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_cm_antebracoD" type="text"
                            class="form-control @error('af_cm_antebracoD') is-invalid @enderror"
                            name="af_cm_antebracoD" value="{{ $avaliacaoFisica->af_cm_antebracoD }}" autocomplete="af_cm_antebracoD" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida do antebraço direito (cm)">

                            @error('af_cm_antebracoD')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_cm_coxaE" class="col-md-4 col-form-label text-md-end">{{ __('Medida da coxa esquerda do Aluno (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_cm_coxaE" type="text"
                            class="form-control @error('af_cm_coxaE') is-invalid @enderror"
                            name="af_cm_coxaE" value="{{ $avaliacaoFisica->af_cm_coxaE}}" autocomplete="af_cm_coxaE" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida da coxa esquerda (cm)">

                            @error('af_cm_coxaE')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_cm_coxaD" class="col-md-4 col-form-label text-md-end">{{ __('Medida da coxa direita do Aluno (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_cm_coxaD" type="text"
                            class="form-control @error('af_cm_coxaD') is-invalid @enderror"
                            name="af_cm_coxaD" value="{{ $avaliacaoFisica->af_cm_coxaD}}" autocomplete="af_cm_coxaD" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida da coxa direita (cm)">

                            @error('af_cm_coxaD')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_cm_panturrilhaE" class="col-md-4 col-form-label text-md-end">{{ __('Medida da panturrilha esquerda do Aluno (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_cm_panturrilhaE" type="text"
                            class="form-control @error('af_cm_panturrilhaE') is-invalid @enderror"
                            name="af_cm_panturrilhaE" value="{{ $avaliacaoFisica->af_cm_panturrilhaE }}" autocomplete="af_cm_panturrilhaE" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida da panturrilha esquerda (cm)">

                            @error('af_cm_panturrilhaE')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_cm_panturrilhaD" class="col-md-4 col-form-label text-md-end">{{ __('Medida da panturrilha direita do Aluno (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_cm_panturrilhaD" type="text"
                            class="form-control @error('af_cm_panturrilhaD') is-invalid @enderror"
                            name="af_cm_panturrilhaD" value="{{ $avaliacaoFisica->af_cm_panturrilhaD }}" autocomplete="af_cm_panturrilhaD" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida da panturrilha direita (cm)">

                            @error('af_cm_panturrilhaD')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_cm_torax" class="col-md-4 col-form-label text-md-end">{{ __('Medida do torax do Aluno (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_cm_torax" type="text"
                            class="form-control @error('af_cm_torax') is-invalid @enderror"
                            name="af_cm_torax" value="{{ $avaliacaoFisica->af_cm_torax}}" autocomplete="af_cm_torax" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida do torax (cm)">

                            @error('af_cm_torax')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_cm_cintura" class="col-md-4 col-form-label text-md-end">{{ __('Medida da cintura do Aluno (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_cm_cintura" type="text"
                            class="form-control @error('af_cm_cintura') is-invalid @enderror"
                            name="af_cm_cintura" value="{{ $avaliacaoFisica->af_cm_cintura }}" autocomplete="af_cm_cintura" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida da cintura (cm)">

                            @error('af_cm_cintura')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_cm_abdomen" class="col-md-4 col-form-label text-md-end">{{ __('Medida do abdomen do Aluno (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_cm_abdomen" type="text"
                            class="form-control @error('af_cm_abdomen') is-invalid @enderror"
                            name="af_cm_abdomen" value="{{ $avaliacaoFisica->af_cm_abdomen }}" autocomplete="af_cm_abdomen" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida do abdomen (cm)">

                            @error('af_cm_abdomen')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_cm_quadril" class="col-md-4 col-form-label text-md-end">{{ __('Medida do quadril do Aluno (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_cm_quadril" type="text"
                            class="form-control @error('af_cm_quadril') is-invalid @enderror"
                            name="af_cm_quadril" value="{{ $avaliacaoFisica->af_cm_quadril }}" autocomplete="af_cm_quadril" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida do quadril (cm)">

                            @error('af_cm_quadril')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_cm_pescoco" class="col-md-4 col-form-label text-md-end">{{ __('Medida do pescoço do Aluno (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_cm_pescoco" type="text"
                            class="form-control @error('af_cm_pescoco') is-invalid @enderror"
                            name="af_cm_pescoco" value="{{ $avaliacaoFisica->af_cm_pescoco }}" autocomplete="af_cm_pescoco" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida do pescoço (cm)">

                            @error('af_cm_pescoco')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_cm_ombro" class="col-md-4 col-form-label text-md-end">{{ __('Medida do ombro do Aluno (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_cm_ombro" type="text"
                            class="form-control @error('af_cm_ombro') is-invalid @enderror"
                            name="af_cm_ombro" value="{{ $avaliacaoFisica->af_cm_ombro }}" autocomplete="af_cm_ombro" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida do ombro (cm)">

                            @error('af_cm_ombro')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_dc_subescapular" class="col-md-4 col-form-label text-md-end">{{ __('Medida da dobra cutânea da subescapular (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_dc_subescapular" type="text"
                            class="form-control @error('af_dc_subescapular') is-invalid @enderror"
                            name="af_dc_subescapular" value="{{ $avaliacaoFisica->af_dc_subescapular }}" autocomplete="af_dc_subescapular" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida da dobra cutânea da subescapular (cm)">

                            @error('af_dc_subescapular')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_dc_triceps" class="col-md-4 col-form-label text-md-end">{{ __('Medida da dobra cutânea do triceps (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_dc_triceps" type="text"
                            class="form-control @error('af_dc_triceps') is-invalid @enderror"
                            name="af_dc_triceps" value="{{ $avaliacaoFisica->af_dc_triceps }}" autocomplete="af_dc_triceps" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida da dobra cutânea do triceps (cm)">

                            @error('af_dc_triceps')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_dc_biceps" class="col-md-4 col-form-label text-md-end">{{ __('Medida da dobra cutânea do biceps (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_dc_biceps" type="text"
                            class="form-control @error('af_dc_biceps') is-invalid @enderror"
                            name="af_dc_biceps" value="{{ $avaliacaoFisica->af_dc_biceps }}" autocomplete="af_dc_biceps" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida da dobra cutânea do biceps (cm)">

                            @error('af_dc_biceps')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_dc_torax" class="col-md-4 col-form-label text-md-end">{{ __('Medida da dobra cutânea do torax (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_dc_torax" type="text"
                            class="form-control @error('af_dc_torax') is-invalid @enderror"
                            name="af_dc_torax" value="{{ $avaliacaoFisica->af_dc_torax }}" autocomplete="af_dc_torax" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida da dobra cutânea do torax (cm)">

                            @error('af_dc_torax')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_dc_axilarMedia" class="col-md-4 col-form-label text-md-end">{{ __('Medida da dobra cutânea da axilar média (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_dc_axilarMedia" type="text"
                            class="form-control @error('af_dc_axilarMedia') is-invalid @enderror"
                            name="af_dc_axilarMedia" value="{{ $avaliacaoFisica->af_dc_axilarMedia }}" autocomplete="af_dc_axilarMedia" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida da dobra cutânea da axilar média (cm)">

                            @error('af_dc_axilarMedia')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_dc_suprailiaca" class="col-md-4 col-form-label text-md-end">{{ __('Medida da dobra cutânea da suprailiaca (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_dc_suprailiaca" type="text"
                            class="form-control @error('af_dc_suprailiaca') is-invalid @enderror"
                            name="af_dc_suprailiaca" value="{{ $avaliacaoFisica->af_dc_suprailiaca }}" autocomplete="af_dc_suprailiaca" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida da dobra cutânea da suprailiaca (cm)">

                            @error('af_dc_suprailiaca')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_dc_abdominal" class="col-md-4 col-form-label text-md-end">{{ __('Medida da dobra cutânea abdominal (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_dc_abdominal" type="text"
                            class="form-control @error('af_dc_abdominal') is-invalid @enderror"
                            name="af_dc_abdominal" value="{{ $avaliacaoFisica->af_dc_abdominal }}" autocomplete="af_dc_abdominal" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida da dobra cutânea abdominal (cm)">

                            @error('af_dc_abdominal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_dc_coxaMedial" class="col-md-4 col-form-label text-md-end">{{ __('Medida da dobra cutânea da coxa medial (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_dc_coxaMedial" type="text"
                            class="form-control @error('af_dc_coxaMedial') is-invalid @enderror"
                            name="af_dc_coxaMedial" value="{{ $avaliacaoFisica->af_dc_coxaMedial }}" autocomplete="af_dc_coxaMedial" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida da dobra cutânea da coxa medial (cm)">

                            @error('af_dc_coxaMedial')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_dc_panturrilhaMedial" class="col-md-4 col-form-label text-md-end">{{ __('Medida da dobra cutânea da panturrilha medial (cm)') }}</label>

                        <div class="col-md-6">
                            <input id="af_dc_panturrilhaMedial" type="text"
                            class="form-control @error('af_dc_panturrilhaMedial') is-invalid @enderror"
                            name="af_dc_panturrilhaMedial" value="{{ $avaliacaoFisica->af_dc_panturrilhaMedial }}" autocomplete="af_dc_panturrilhaMedial" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira a medida da dobra cutânea da panturrilha medial (cm)">

                            @error('af_dc_panturrilhaMedial')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="af_objetivo" class="col-md-4 col-form-label text-md-end">{{ __('Objetivo do aluno') }}</label>

                        <div class="col-md-6">
                            <input id="af_objetivo" type="text"
                            class="form-control @error('af_objetivo') is-invalid @enderror"
                            name="af_objetivo" value="{{ $avaliacaoFisica->af_objetivo }}" autocomplete="af_objetivo" autofocus
                            onkeypress="return onlynumber();"
                            placeholder="Insira o objetivo do aluno">

                            @error('af_objetivo')
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

<!-- Modal de excluir exercício -->
@foreach($avaliacaoFisicas as $avaliacaoFisica)
<div class="modal fade" id="excluirAvaliacaoFisica{{$aluno->id}}{{$avaliacaoFisica->id}}" tabindex="-1" role="dialog" aria-labelledby="excluirAvaliacaoFisica{{$aluno->id}}{{$avaliacaoFisica->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="excluirAvaliacaoFisica{{$aluno->id}}{{$avaliacaoFisica->id}}">Excluir Equipamento</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <p>Deseja excluir esse equipamento?</p>
            <form action="{{ route('alunos.avaliacaoFisicaDelete', [$aluno->id, $avaliacaoFisica->id]) }}" method="POST">

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

<!-- Modal de visualizar -->
@foreach ($avaliacaoFisicas as $avaliacaoFisica)
<div class="modal fade" id="visualizarAvaliacaoFisica{{$aluno->id}}" tabindex="-1" role="dialog" aria-labelledby="visualizarAvaliacaoFisica{{$aluno->id}}" aria-hidden="true">
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
            <p>Massa Gorda (Gordura/kg): {{$avaliacaoFisica->af_massa_gorda}}</p>
            <p>Massa Magra (Músculo/kg): {{$avaliacaoFisica->af_massa_musculo}}</p>
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
@endforeach

