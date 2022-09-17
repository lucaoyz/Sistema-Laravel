<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Treino de {{auth::user()->name}}</title>
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
  border-color: inherit;
  border-style: solid;
  border-width: 1px;
  text-align: center;
  padding: 10px;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

th {
  background-color: #F44335;
  color: black;
}

.divTreinos {
    border-style: solid;
    box-sizing: border-box;
    position: absolute;
    float: left;
    overflow: auto;
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

        </style>
    </head>
    <body>
        <h2><img src="img/logos/gv2.png" style="max-width: 50px"> GV2 Academia</h2>
        <h2>Treino de <span>{{auth::user()->name;}}</span></h2>


                @if ($treinoGeralDivisoes === 'A')
                <div class="divTreinos"><br>
                    <h2>Treino A</h2>
                <table>
                    <tr>
                        <th>Membro</th>
                        <th>Exercício</th>
                        <th>Series</th>
                        <th>Repetições</th>
                        
                    </tr>
                    @foreach ($treinoAAlunos as $treinoAAluno)
                    <tr>
                        <td>{{$treinoAAluno->exe_membro}}</td>
                        <td>{{$treinoAAluno->exe_nome}}</td>
                        <td>{{$treinoAAluno->td_series}}</td>
                        <td>{{$treinoAAluno->td_repeticoes}}</td>
                    </tr>
                    @endforeach
                </table>
                </div>

                @endif

                @if ($treinoGeralDivisoes === 'AB')
                    <!-- Divisão A -->
                    <div class="divTreinos"><br>
                        <h2>Treino A</h2>
                    <table>
                        <tr>
                            <th>Membro</th>
                            <th>Exercício</th>
                            <th>Series</th>
                            <th>Repetições</th>
                        </tr>
                        @foreach ($treinoAAlunos as $treinoAAluno)
                        <tr>
                            <td>{{$treinoAAluno->exe_membro}}</td>
                            <td>{{$treinoAAluno->exe_nome}}</td>
                            <td>{{$treinoAAluno->td_series}}</td>
                            <td>{{$treinoAAluno->td_repeticoes}}</td>
                        </tr>
                        @endforeach
                    </table>
                    </div>

                    <!-- Divisão B -->
                    <div class="divTreinos"><br>
                        <h2>Treino B</h2>
                    <table>
                        <tr>
                            <th>Membro</th>
                            <th>Exercício</th>
                            <th>Series</th>
                            <th>Repetições</th>
                        </tr>
                        @foreach ($treinoBAlunos as $treinoBAluno)
                        <tr>
                            <td>{{$treinoBAluno->exe_membro}}</td>
                            <td>{{$treinoBAluno->exe_nome}}</td>
                            <td>{{$treinoBAluno->td_series}}</td>
                            <td>{{$treinoBAluno->td_repeticoes}}</td>
                        </tr>
                        @endforeach
                    </table>
                    </div>
                @endif

                @if ($treinoGeralDivisoes === 'ABC')
                    <!-- Divisão A -->
                    <div class="divTreinos"><br>
                        <h2>Treino A</h2>
                    <table>
                        <tr>
                            <th>Membro</th>
                            <th>Exercício</th>
                            <th>Series</th>
                            <th>Repetições</th>
                        </tr>
                        @foreach ($treinoAAlunos as $treinoAAluno)
                        <tr>
                            <td>{{$treinoAAluno->exe_membro}}</td>
                            <td>{{$treinoAAluno->exe_nome}}</td>
                            <td>{{$treinoAAluno->td_series}}</td>
                            <td>{{$treinoAAluno->td_repeticoes}}</td>
                        </tr>
                        @endforeach
                    </table>
                    </div>

                    <!-- Divisão B -->
                    <div class="divTreinos"><br>
                        <h2>Treino B</h2>
                    <table>
                        <tr>
                            <th>Membro</th>
                            <th>Exercício</th>
                            <th>Series</th>
                            <th>Repetições</th>
                        </tr>
                        @foreach ($treinoBAlunos as $treinoBAluno)
                        <tr>
                            <td>{{$treinoBAluno->exe_membro}}</td>
                            <td>{{$treinoBAluno->exe_nome}}</td>
                            <td>{{$treinoBAluno->td_series}}</td>
                            <td>{{$treinoBAluno->td_repeticoes}}</td>
                        </tr>
                        @endforeach
                    </table>
                    </div>

                    <!-- Divisão C -->
                    <div class="divTreinos"><br>
                        <h2>Treino C</h2>
                    <table>
                        <tr>
                            <th>Membro</th>
                            <th>Exercício</th>
                            <th>Series</th>
                            <th>Repetições</th>
                        </tr>
                        @foreach ($treinoCAlunos as $treinoCAluno)
                        <tr>
                            <td>{{$treinoCAluno->exe_membro}}</td>
                            <td>{{$treinoCAluno->exe_nome}}</td>
                            <td>{{$treinoCAluno->td_series}}</td>
                            <td>{{$treinoCAluno->td_repeticoes}}</td>
                        </tr>
                        @endforeach
                    </table>
                    </div>
                @endif

                @if ($treinoGeralDivisoes === 'ABCD')
                    <!-- Divisão A -->
                    <div class="container">
                    <div class="row">
                    <div class="col"><br>
                        <h2>Treino A</h2>
                    <table>
                        <tr>
                            <th>Membro</th>
                            <th>Exercício</th>
                            <th>Series</th>
                            <th>Repetições</th>
                        </tr>
                        @foreach ($treinoAAlunos as $treinoAAluno)
                        <tr>
                            <td>{{$treinoAAluno->exe_membro}}</td>
                            <td>{{$treinoAAluno->exe_nome}}</td>
                            <td>{{$treinoAAluno->td_series}}</td>
                            <td>{{$treinoAAluno->td_repeticoes}}</td>
                        </tr>
                        @endforeach
                    </table>
                    </div>

                    <!-- Divisão B -->
                    <div class="col"><br>
                        <h2>Treino B</h2>
                    <table>
                        <tr>
                            <th>Membro</th>
                            <th>Exercício</th>
                            <th>Series</th>
                            <th>Repetições</th>
                        </tr>
                        @foreach ($treinoBAlunos as $treinoBAluno)
                        <tr>
                            <td>{{$treinoBAluno->exe_membro}}</td>
                            <td>{{$treinoBAluno->exe_nome}}</td>
                            <td>{{$treinoBAluno->td_series}}</td>
                            <td>{{$treinoBAluno->td_repeticoes}}</td>
                        </tr>
                        @endforeach
                    </table>
                    </div>

                    <!-- Divisão C -->
                    <div class="col"><br>
                        <h2>Treino C</h2>
                    <table>
                        <tr>
                            <th>Membro</th>
                            <th>Exercício</th>
                            <th>Series</th>
                            <th>Repetições</th>
                        </tr>
                        @foreach ($treinoCAlunos as $treinoCAluno)
                        <tr>
                            <td>{{$treinoCAluno->exe_membro}}</td>
                            <td>{{$treinoCAluno->exe_nome}}</td>
                            <td>{{$treinoCAluno->td_series}}</td>
                            <td>{{$treinoCAluno->td_repeticoes}}</td>
                        </tr>
                        @endforeach
                    </table>
                    </div>
                </div>

                </div>
                    <!-- Divisão D -->
                    <div class="row">
                    <div class="col"><br>
                        <h2>Treino D</h2>
                    <table>
                        <tr>
                            <th>Membro</th>
                            <th>Exercício</th>
                            <th>Series</th>
                            <th>Repetições</th>
                        </tr>
                        @foreach ($treinoDAlunos as $treinoDAluno)
                        <tr>
                            <td>{{$treinoDAluno->exe_membro}}</td>
                            <td>{{$treinoDAluno->exe_nome}}</td>
                            <td>{{$treinoDAluno->td_series}}</td>
                            <td>{{$treinoDAluno->td_repeticoes}}</td>
                        </tr>
                        @endforeach
                    </table>
                    </div>
                </div>
                </div>
                @endif

                @if ($treinoGeralDivisoes === 'ABCDE')
                    <!-- Divisão A -->
                    <div class="divTreinos"><br>
                        <h2>Treino A</h2>
                    <table>
                        <tr>
                            <th>Membro</th>
                            <th>Exercício</th>
                            <th>Series</th>
                            <th>Repetições</th>
                        </tr>
                        @foreach ($treinoAAlunos as $treinoAAluno)
                        <tr>
                            <td>{{$treinoAAluno->exe_membro}}</td>
                            <td>{{$treinoAAluno->exe_nome}}</td>
                            <td>{{$treinoAAluno->td_series}}</td>
                            <td>{{$treinoAAluno->td_repeticoes}}</td>
                        </tr>
                        @endforeach
                    </table>
                    </div>

                    <!-- Divisão B -->
                    <div class="divTreinos"><br>
                        <h2>Treino B</h2>
                    <table>
                        <tr>
                            <th>Membro</th>
                            <th>Exercício</th>
                            <th>Series</th>
                            <th>Repetições</th>
                        </tr>
                        @foreach ($treinoBAlunos as $treinoBAluno)
                        <tr>
                            <td>{{$treinoBAluno->exe_membro}}</td>
                            <td>{{$treinoBAluno->exe_nome}}</td>
                            <td>{{$treinoBAluno->td_series}}</td>
                            <td>{{$treinoBAluno->td_repeticoes}}</td>
                        </tr>
                        @endforeach
                    </table>
                    </div>

                    <!-- Divisão C -->
                    <div class="divTreinos"><br>
                        <h2>Treino C</h2>
                    <table>
                        <tr>
                            <th>Membro</th>
                            <th>Exercício</th>
                            <th>Series</th>
                            <th>Repetições</th>
                        </tr>
                        @foreach ($treinoCAlunos as $treinoCAluno)
                        <tr>
                            <td>{{$treinoCAluno->exe_membro}}</td>
                            <td>{{$treinoCAluno->exe_nome}}</td>
                            <td>{{$treinoCAluno->td_series}}</td>
                            <td>{{$treinoCAluno->td_repeticoes}}</td>
                        </tr>
                        @endforeach
                    </table>
                    </div>

                    <!-- Divisão D -->
                    <div class="divTreinos"><br>
                        <h2>Treino D</h2>
                    <table>
                        <tr>
                            <th>Membro</th>
                            <th>Exercício</th>
                            <th>Series</th>
                            <th>Repetições</th>
                        </tr>
                        @foreach ($treinoDAlunos as $treinoDAluno)
                        <tr>
                            <td>{{$treinoDAluno->exe_membro}}</td>
                            <td>{{$treinoDAluno->exe_nome}}</td>
                            <td>{{$treinoDAluno->td_series}}</td>
                            <td>{{$treinoDAluno->td_repeticoes}}</td>
                        </tr>
                        @endforeach
                    </table>
                    </div>

                    <!-- Divisão E -->
                    <div class="divTreinos"><br>
                        <h2>Treino E</h2>
                    <table>
                        <tr>
                            <th>Membro</th>
                            <th>Exercício</th>
                            <th>Series</th>
                            <th>Repetições</th>
                        </tr>
                        @foreach ($treinoEAlunos as $treinoEAluno)
                        <tr>
                            <td>{{$treinoEAluno->exe_membro}}</td>
                            <td>{{$treinoEAluno->exe_nome}}</td>
                            <td>{{$treinoEAluno->td_series}}</td>
                            <td>{{$treinoEAluno->td_repeticoes}}</td>
                        </tr>
                        @endforeach
                    </table>
                    </div>
                @endif

                @if ($treinoGeralDivisoes === 'ABCDEF')
                    <!-- Divisão A -->
                    <div class="divTreinos"><br>
                        <h2>Treino A</h2>
                    <table>
                        <tr>
                            <th>Membro</th>
                            <th>Exercício</th>
                            <th>Series</th>
                            <th>Repetições</th>
                        </tr>
                        @foreach ($treinoAAlunos as $treinoAAluno)
                        <tr>
                            <td>{{$treinoAAluno->exe_membro}}</td>
                            <td>{{$treinoAAluno->exe_nome}}</td>
                            <td>{{$treinoAAluno->td_series}}</td>
                            <td>{{$treinoAAluno->td_repeticoes}}</td>
                        </tr>
                        @endforeach
                    </table>
                    </div>

                    <!-- Divisão B -->
                    <div class="divTreinos"><br>
                        <h2>Treino B</h2>
                    <table>
                        <tr>
                            <th>Membro</th>
                            <th>Exercício</th>
                            <th>Series</th>
                            <th>Repetições</th>
                        </tr>
                        @foreach ($treinoBAlunos as $treinoBAluno)
                        <tr>
                            <td>{{$treinoBAluno->exe_membro}}</td>
                            <td>{{$treinoBAluno->exe_nome}}</td>
                            <td>{{$treinoBAluno->td_series}}</td>
                            <td>{{$treinoBAluno->td_repeticoes}}</td>
                        </tr>
                        @endforeach
                    </table>
                    </div>

                    <!-- Divisão C -->
                    <div class="divTreinos"><br>
                        <h2>Treino C</h2>
                    <table>
                        <tr>
                            <th>Membro</th>
                            <th>Exercício</th>
                            <th>Series</th>
                            <th>Repetições</th>
                        </tr>
                        @foreach ($treinoCAlunos as $treinoCAluno)
                        <tr>
                            <td>{{$treinoCAluno->exe_membro}}</td>
                            <td>{{$treinoCAluno->exe_nome}}</td>
                            <td>{{$treinoCAluno->td_series}}</td>
                            <td>{{$treinoCAluno->td_repeticoes}}</td>
                        </tr>
                        @endforeach
                    </table>
                    </div>

                    <!-- Divisão D -->
                    <div class="divTreinos"><br>
                        <h2>Treino D</h2>
                    <table>
                        <tr>
                            <th>Membro</th>
                            <th>Exercício</th>
                            <th>Series</th>
                            <th>Repetições</th>
                        </tr>
                        @foreach ($treinoDAlunos as $treinoDAluno)
                        <tr>
                            <td>{{$treinoDAluno->exe_membro}}</td>
                            <td>{{$treinoDAluno->exe_nome}}</td>
                            <td>{{$treinoDAluno->td_series}}</td>
                            <td>{{$treinoDAluno->td_repeticoes}}</td>
                        </tr>
                        @endforeach
                    </table>
                    </div>

                    <!-- Divisão E -->
                    <div class="divTreinos"><br>
                        <h2>Treino E</h2>
                    <table>
                        <tr>
                            <th>Membro</th>
                            <th>Exercício</th>
                            <th>Series</th>
                            <th>Repetições</th>
                        </tr>
                        @foreach ($treinoEAlunos as $treinoEAluno)
                        <tr>
                            <td>{{$treinoEAluno->exe_membro}}</td>
                            <td>{{$treinoEAluno->exe_nome}}</td>
                            <td>{{$treinoEAluno->td_series}}</td>
                            <td>{{$treinoEAluno->td_repeticoes}}</td>
                        </tr>
                        @endforeach
                    </table>
                    </div>

                    <!-- Divisão F -->
                    <div class="divTreinos"><br>
                        <h2>Treino F</h2>
                    <table>
                        <tr>
                            <th>Membro</th>
                            <th>Exercício</th>
                            <th>Series</th>
                            <th>Repetições</th>
                        </tr>
                        @foreach ($treinoFAlunos as $treinoFAluno)
                        <tr>
                            <td>{{$treinoFAluno->exe_membro}}</td>
                            <td>{{$treinoFAluno->exe_nome}}</td>
                            <td>{{$treinoFAluno->td_series}}</td>
                            <td>{{$treinoFAluno->td_repeticoes}}</td>
                        </tr>
                        @endforeach
                    </table>
                    </div>
                @endif

    </body>
</html>
