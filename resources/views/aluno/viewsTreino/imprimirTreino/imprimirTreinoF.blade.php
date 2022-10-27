<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>
            Treino de {{$aluno->alu_nome}}
        </title>
    <style>
        h1, .h1, h2, .h2, h3, .h3, h4, .h4, h5, .h5, h6, .h6 {
  margin-top: 0;
  margin-bottom: 0.5rem;
  margin-left: 0.5rem;
  margin-right: 0.5rem;

  font-weight: 400;
  line-height: 1.2;
  color: #000; }

h1, .h1 {
  font-size: calc(1.425rem + 2.1vw); }
  @media (min-width: 1200px) {
    h1, .h1 {
      font-size: 3rem; } }

h2, .h2 {
  font-size: calc(1.35rem + 1.2vw); }
  @media (min-width: 1200px) {
    h2, .h2 {
      font-size: 2.25rem; } }

h3, .h3 {
  font-size: calc(1.3125rem + 0.75vw); }
  @media (min-width: 1200px) {
    h3, .h3 {
      font-size: 1.875rem; } }

h4, .h4 {
  font-size: calc(1.275rem + 0.3vw); }
  @media (min-width: 1200px) {
    h4, .h4 {
      font-size: 1.5rem; } }

h5, .h5 {
  font-size: 1.25rem; }

h6, .h6 {
  font-size: 1rem; }

p {
  margin-top: 0;
  margin-bottom: 1rem; }

  .list-unstyled {
  margin-left: 0.5rem;
  margin-right: 0.5rem;
  list-style: none; }

  ol,
ul {
  padding-left: 2rem; }

ol,
ul,
dl {
  margin-top: 0;
  margin-bottom: 1rem; }

ol ol,
ul ul,
ol ul,
ul ol {
  margin-bottom: 0; }

  table {
  caption-side: bottom;
  border-collapse: collapse; }

caption {
  padding-top: 0.5rem;
  padding-bottom: 0.5rem;
  color: #6c757d;
  text-align: left; }

th {
  text-align: inherit;
  text-align: -webkit-match-parent; }

table,
thead,
tbody,
tfoot,
tr,
td,
th {
  text-align: center;
  padding: 2px;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

th {
  color: black;
}

.container {
    display: flex;
    width: 20cm;
}

.row {
    max-width: 20cm;
    float: left;
}

.col {
    border-style: solid;
    margin: 2px;
}

.tdNumero {
    font-size: 30px;
    font-weight: bold;
    font-family:Verdana, Geneva, Tahoma, sans-serif;
}

    @page {
            margin: 0in;
            font-family: 'Courier New', Courier, monospace;
    }
    body {
        background-color: #808080;
        padding: 0.05in;
    }
    #wrapper {
        background-color: white;
        width: 100%;
        height: 100%;
        text-align: center;
        }

    .imprimirTreino {
        font-size: 23px;
        text-align: center;
        max-width: 800px;
    }

    .imprimirTreino td {
        word-wrap: break-word;
    }
    .imprimirTreino table {
        width: 580px;
        margin-left: 5px;
    }
        </style>
    </head>
    <body>
        <div id="wrapper">
        <h2 style="padding-top: 10px;"><img src="img/logos/gv2pretoebranco.png" style="width: 90px;"></h2>
            <p style="margin: 1px 0px 0px 5px;"> Data do treino: {{now()->format('d/m/Y')}}</p>
            <p style="margin: 1px 0px 0px 5px;"> Treinador: {{$treinoGeralAlunoProfessor}}</p>
            <h3 style="margin: 0;">Treino de <span style="font-weight: 10;">{{$aluno->alu_nome}}</span></h3>
        @isset ($treinoAlunosPeito)
        <p style="margin: 0;">---------------------------</p>
        <div class="imprimirTreino">
            <p style="font-size: 30px;">Treino F - <span>Peito</span></p>
            <table>
                <tr>
                    <th>Nº</th>
                    <th>Exercício</th>
                    <th>Series/Repetições</th>
                    <th>OBS</th>
                </tr>
                @foreach ($treinoAlunosPeito as $treinoAlunoPeito)
                <tr>
                    <td>{{$treinoAlunoPeito->td_numero}}</td>
                    <td>{{$treinoAlunoPeito->exe_nome}}</td>
                    <td>{{$treinoAlunoPeito->td_series}}x{{$treinoAlunoPeito->td_repeticoes}}</td>
                    <td>{{$treinoAlunoPeito->exe_descricao}}</td>
                </tr>
                @endforeach
            </table>
        </div>
        @endisset

        @isset ($treinoAlunosCostas)
        <p style="margin: 0;">---------------------------</p>
        <div class="imprimirTreino">
            <p style="font-size: 30px;">Treino F - <span>Costas</span></p>
            <table>
                <tr>
                    <th>Nº</th>
                    <th>Exercício</th>
                    <th>Series/Repetições</th>
                    <th>OBS</th>
                </tr>
                @foreach ($treinoAlunosCostas as $treinoAlunoCostas)
                <tr>
                    <td>{{$treinoAlunoCostas->td_numero}}</td>
                    <td>{{$treinoAlunoCostas->exe_nome}}</td>
                    <td>{{$treinoAlunoCostas->td_series}}x{{$treinoAlunoCostas->td_repeticoes}}</td>
                    <td>{{$treinoAlunoCostas->exe_descricao}}</td>
                </tr>
                @endforeach
            </table>
            </div>
        @endisset

        @isset ($treinoAlunosBiceps)
        <p style="margin: 0;">---------------------------</p>
        <div class="imprimirTreino">
            <p style="font-size: 30px;">Treino F - <span>Biceps</span></p>
            <table>
                <tr>
                    <th>Nº</th>
                    <th>Exercício</th>
                    <th>Series/Repetições</th>
                    <th>OBS</th>
                </tr>
                @foreach ($treinoAlunosBiceps as $treinoAlunoBiceps)
                <tr>
                    <td>{{$treinoAlunoBiceps->td_numero}}</td>
                    <td>{{$treinoAlunoBiceps->exe_nome}}</td>
                    <td>{{$treinoAlunoBiceps->td_series}}x{{$treinoAlunoBiceps->td_repeticoes}}</td>
                    <td>{{$treinoAlunoBiceps->exe_descricao}}</td>
                </tr>
                @endforeach
            </table>
        </div>
        @endisset

        @isset ($treinoAlunosTriceps)
        <p style="margin: 0;">---------------------------</p>
        <div class="imprimirTreino">
            <p style="font-size: 30px;">Treino F - <span>Triceps</span></p>
            <table>
                <tr>
                    <th>Nº</th>
                    <th>Exercício</th>
                    <th>Series/Repetições</th>
                    <th>OBS</th>
                </tr>
                @foreach ($treinoAlunosTriceps as $treinoAlunoTriceps)
                <tr>
                    <td>{{$treinoAlunoTriceps->td_numero}}</td>
                    <td>{{$treinoAlunoTriceps->exe_nome}}</td>
                    <td>{{$treinoAlunoTriceps->td_series}}x{{$treinoAlunoTriceps->td_repeticoes}}</td>
                    <td>{{$treinoAlunoTriceps->exe_descricao}}</td>
                </tr>
                @endforeach
            </table>
        </div>
        @endisset

        @isset ($treinoAlunosAntebraco)
        <p style="margin: 0;">---------------------------</p>
        <div class="imprimirTreino">
            <p style="font-size: 30px;">Treino F - <span>Antebraço</span></p>
            <table>
                <tr>
                    <th>Nº</th>
                    <th>Exercício</th>
                    <th>Series/Repetições</th>
                    <th>OBS</th>
                </tr>
                @foreach ($treinoAlunosAntebraco as $treinoAlunoAntebraco)
                <tr>
                    <td>{{$treinoAlunoAntebraco->td_numero}}</td>
                    <td>{{$treinoAlunoAntebraco->exe_nome}}</td>
                    <td>{{$treinoAlunoAntebraco->td_series}}x{{$treinoAlunoAntebraco->td_repeticoes}}</td>
                    <td>{{$treinoAlunoAntebraco->exe_descricao}}</td>
                </tr>
                @endforeach
            </table>
            </div>
        @endisset

        @isset ($treinoAlunosOmbro)
        <p style="margin: 0;">---------------------------</p>
        <div class="imprimirTreino">
            <p style="font-size: 30px;">Treino F - <span>Ombro</span></p>
            <table>
                <tr>
                    <th>Nº</th>
                    <th>Exercício</th>
                    <th>Series/Repetições</th>
                    <th>OBS</th>
                </tr>
                @foreach ($treinoAlunosOmbro as $treinoAlunoOmbro)
                <tr>
                    <td>{{$treinoAlunoOmbro->td_numero}}</td>
                    <td>{{$treinoAlunoOmbro->exe_nome}}</td>
                    <td>{{$treinoAlunoOmbro->td_series}}x{{$treinoAlunoOmbro->td_repeticoes}}</td>
                    <td>{{$treinoAlunoOmbro->exe_descricao}}</td>
                @endforeach
            </table>
            </div>
        @endisset

        @isset ($treinoAlunosTrapezio)
        <p style="margin: 0;">---------------------------</p>
        <div class="imprimirTreino">
            <p style="font-size: 30px;">Treino F - <span>Trapezio</span></p>
            <table>
                <tr>
                    <th>Nº</th>
                    <th>Exercício</th>
                    <th>Series/Repetições</th>
                    <th>OBS</th>
                </tr>
                @foreach ($treinoAlunosTrapezio as $treinoAlunoTrapezio)
                <tr>
                    <td>{{$treinoAlunoTrapezio->td_numero}}</td>
                    <td>{{$treinoAlunoTrapezio->exe_nome}}</td>
                    <td>{{$treinoAlunoTrapezio->td_series}}x{{$treinoAlunoTrapezio->td_repeticoes}}</td>
                    <td>{{$treinoAlunoTrapezio->exe_descricao}}</td>
                </tr>
                @endforeach
            </table>
            </div>
        @endisset

        @isset ($treinoAlunosInferior)
        <p style="margin: 0;">---------------------------</p>
        <div class="imprimirTreino">
            <p style="font-size: 30px;">Treino F - <span>Inferior</span></p>
            <table>
                <tr>
                    <th>Nº</th>
                    <th>Exercício</th>
                    <th>Series/Repetições</th>
                    <th>OBS</th>
                </tr>
                @foreach ($treinoAlunosInferior as $treinoAlunoInferior)
                <tr>
                    <td>{{$treinoAlunoInferior->td_numero}}</td>
                    <td>{{$treinoAlunoInferior->exe_nome}}</td>
                    <td>{{$treinoAlunoInferior->td_series}}x{{$treinoAlunoInferior->td_repeticoes}}</td>
                    <td>{{$treinoAlunoInferior->exe_descricao}}</td>
                </tr>
                @endforeach
            </table>
            </div>
        @endisset

        @isset ($treinoAlunosLombar)
        <p style="margin: 0;">---------------------------</p>
        <div class="imprimirTreino">
            <p style="font-size: 30px;">Treino F - <span>Lombar</span></p>
            <table>
                <tr>
                    <th>Nº</th>
                    <th>Exercício</th>
                    <th>Series/Repetições</th>
                    <th>OBS</th>
                </tr>
                @foreach ($treinoAlunosLombar as $treinoAlunoLombar)
                <tr>
                    <td>{{$treinoAlunoLombar->td_numero}}</td>
                    <td>{{$treinoAlunoLombar->exe_nome}}</td>
                    <td>{{$treinoAlunoLombar->td_series}}x{{$treinoAlunoLombar->td_repeticoes}}</td>
                    <td>{{$treinoAlunoLombar->exe_descricao}}</td>
                </tr>
                @endforeach
            </table>
            </div>
        @endisset

        @isset ($treinoAlunosAbdomen)
        <p style="margin: 0;">---------------------------</p>
        <div class="imprimirTreino">
            <p style="font-size: 30px;">Treino F - <span>Abdomen</span></p>
            <table>
                <tr>
                    <th>Nº</th>
                    <th>Exercício</th>
                    <th>Series/Repetições</th>
                    <th>OBS</th>
                </tr>
                @foreach ($treinoAlunosAbdomen as $treinoAlunoAbdomen)
                <tr>
                    <td>{{$treinoAlunoAbdomen->td_numero}}</td>
                    <td>{{$treinoAlunoAbdomen->exe_nome}}</td>
                    <td>{{$treinoAlunoAbdomen->td_series}}x{{$treinoAlunoAbdomen->td_repeticoes}}</td>
                    <td>{{$treinoAlunoAbdomen->exe_descricao}}</td>
                </tr>
                @endforeach
            </table>
            </div>
        @endisset
    </div>
    </body>
</html>
