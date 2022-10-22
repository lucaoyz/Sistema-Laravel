<!-- Alterar Planos -->
<div class="modal fade" id="alterarPlanos" tabindex="-1" role="dialog" aria-labelledby="alterarPlanos" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 750px">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-normal" id="alterarPlanos">Alterar</h5>
          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="@if ($plano === null)
                {{ route('admin.alterarInfos.storePlanos')}}
                " method="POST">
                @csrf
            @else
            {{ route('admin.alterarInfos.updatePlanos', $plano->id)}}
            " method="POST">
            @csrf
            @method('PUT')
            @endif

                    <div class="row mb-3">
                        <label for="pl_plano1" class="col-md-4 col-form-label text-md-end">{{ __('Plano 1') }}</label>

                        <div class="col-md-6">
                            <input id="pl_plano1" type="text"
                            class="form-control @error('pl_plano1') is-invalid @enderror"
                            name="pl_plano1" onkeypress="return onlynumber();"
                                @if ($plano1 === null)
                                    value="{{ old('pl_plano1') }}" autocomplete="pl_plano1" autofocus
                                    placeholder="Insira o valor do plano">
                                @else
                                    value="{{$plano1->pl_plano1}}" autocomplete="pl_plano1" autofocus
                                    placeholder="Insira o valor do plano">
                                @endif

                            @error('pl_plano1')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="pl_plano2" class="col-md-4 col-form-label text-md-end">{{ __('Plano 2') }}</label>

                        <div class="col-md-6">
                            <input id="pl_plano2" type="text"
                            class="form-control @error('pl_plano2') is-invalid @enderror"
                            name="pl_plano2" onkeypress="return onlynumber();"
                                @if ($plano2 === null)
                                    value="{{ old('pl_plano2') }}" autocomplete="pl_plano2" autofocus
                                    placeholder="Insira o valor do plano">
                                @else
                                    value="{{$plano2->pl_plano2}}" autocomplete="pl_plano2" autofocus
                                    placeholder="Insira o valor do plano">
                                @endif

                            @error('pl_plano2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="pl_plano3" class="col-md-4 col-form-label text-md-end">{{ __('Plano 3') }}</label>

                        <div class="col-md-6">
                            <input id="pl_plano3" type="text"
                            class="form-control @error('pl_plano3') is-invalid @enderror"
                            name="pl_plano3" onkeypress="return onlynumber();"
                                @if ($plano3 === null)
                                    value="{{ old('pl_plano3') }}" autocomplete="pl_plano3" autofocus
                                    placeholder="Insira o valor do plano">
                                @else
                                    value="{{$plano3->pl_plano3}}" autocomplete="pl_plano3" autofocus
                                    placeholder="Insira o valor do plano">
                                @endif

                            @error('pl_plano3')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="pl_plano4" class="col-md-4 col-form-label text-md-end">{{ __('Plano 4') }}</label>

                        <div class="col-md-6">
                            <input id="pl_plano4" type="text"
                            class="form-control @error('pl_plano4') is-invalid @enderror"
                            name="pl_plano4" onkeypress="return onlynumber();"
                                @if ($plano4 === null)
                                    value="{{ old('pl_plano4') }}" autocomplete="pl_plano4" autofocus
                                    placeholder="Insira o valor do plano">
                                @else
                                    value="{{$plano4->pl_plano4}}" autocomplete="pl_plano4" autofocus
                                    placeholder="Insira o valor do plano">
                                @endif

                            @error('pl_plano4')
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
                        {{ __('Alterar') }}
                    </button>
            </div>
        </div>
    </form>
      </div>
    </div>
  </div>
