@extends('admin.layoutsModals.layouts')
@section('title', 'Criar Treino')
@section('treino', 'active bg-gradient-primary')
@section('pagina', 'Criar Treino')
@section('content')

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
@if (Session::get('proximaAbaDMA')) {{--quando cadastrado o treino, retorna o proximaAbaDMA e executa as funções abaixo--}}
    <script>
        function proximaAbaDMA(){

            $('#diasMembrosAluno-tab').removeClass('disabled'); // remove classe disabled
            document.getElementById('diasMembrosAluno-tab').click(); // clica na outra aba pelo id
    }

    $(document).ready(function(){
        proximaAbaDMA(); // executa a função quando o documento estiver pronto.
        });

</script>
@endif

<ul
class="nav nav-tabs" id="criacaoTreino" role="tablist">
    <li class="nav-item" role="presentation">

      <a class="nav-link active" id="treino-tab"
       data-bs-toggle="tab" data-bs-target="#treino"
       type="button" role="tab" aria-controls="treino"
       aria-selected="true">
        Informações gerais do treino
      </a>

    </li>
    <li class="nav-item" role="presentation">

      <a class="nav-link disabled" id="diasMembrosAluno-tab"
      data-bs-toggle="tab" data-bs-target="#diasMembrosAluno"
       type="button" role="tab" aria-controls="diasMembrosAluno"
       aria-selected="false">
       Quantidade de exercicios e membros musculares
    </a>

    </li>
    <li class="nav-item" role="presentation">

      <a class="nav-link disabled" id="exercicios-tab"
       data-bs-toggle="tab" data-bs-target="#exercicios"
        type="button" role="tab" aria-controls="exercicios"
        aria-selected="false">
        Exercícios do treino
    </a>

    </li>
    <li class="nav-item" role="presentation">

      <a class="nav-link disabled" id="conclusao-tab"
       data-bs-toggle="tab" data-bs-target="#conclusao"
       type="button" role="tab" aria-controls="conclusao"
       aria-selected="false">
       Conclusão
    </a>

    </li>
  </ul>

  <div class="tab-content">

    <div class="tab-pane active" id="treino" role="tabpanel" aria-labelledby="treino-tab">
        <form action="{{ route('treinos.store') }}" method="POST">
            @csrf
            <div class="container" style="margin-left: 0%; padding-top: 1.5%">
                <div class="row" style="padding-bottom: 2%;">

                  <div class="col-sm">
                    <label for="per_id">{{ __('*Nome do Professor') }}</label>
                    <select name="per_id" id="per_id" style="background-color: #fff"
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
                    <select name="tre_dias_semana" id="tre_dias_semana" style="background-color: #fff"
                    class="form-select @error('tre_dias_semana') is-invalid @enderror"
                    required autocomplete="tre_dias_semana">
                        <option value="">Clique aqui</option>
                        <option value='1'>1</option>
                        <option value='2'>2</option>
                        <option value='3'>3</option>
                        <option value='4'>4</option>
                        <option value='5'>5</option>
                        <option value='6'>6</option>
                        <option value='7'>7</option>
                    </select>

                    @error('tre_dias_semana')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                  </div>

                  <div class="col-sm">
                    <label for="tre_tempo">{{ __('*Tempo de cada treino') }}</label>
                    <select name="tre_tempo" id="tre_tempo" style="background-color: #fff"
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
                    <input id="tre_data_troca" type="date" style="background-color: #fff"
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
              <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </form>
    </div>

    <div class="tab-pane" id="diasMembrosAluno" role="tabpanel" aria-labelledby="diasMembrosAluno-tab">

    </div>

    <div class="tab-pane" id="exercicios" role="tabpanel" aria-labelledby="exercicios-tab">

    </div>

    <div class="tab-pane" id="conclusao" role="tabpanel" aria-labelledby="conclusao-tab">


    </div>

</div>

@endsection
