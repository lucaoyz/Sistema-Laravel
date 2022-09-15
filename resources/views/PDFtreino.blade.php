<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Treino de {{auth::user()->name}}</title>

    <style>
        h1, .h1, h2, .h2, h3, .h3, h4, .h4, h5, .h5, h6, .h6 {
  margin-top: 0;
  margin-bottom: 0.5rem;
  font-weight: 400;
  line-height: 1.2;
  color: #F44335; }

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
  padding-left: 0;
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

        </style>
    </head>
    <body>
        <h1>Treino de {{ Auth::user()->name }}</h1>
        @foreach ($treinoAlunos as $treinoAluno)
        <h2>Exercício: {{$treinoAluno->exe_nome}}</h2>
        <ul class="list-unstyled">
            <li class="list-unstyled">Series: {{$treinoAluno->td_series}}</li>
            <li class="list-unstyled">Repetições: {{$treinoAluno->td_repeticoes}}</li>
            <li class="list-unstyled">Membro: {{$treinoAluno->exe_membro}}</li>
        </ul>
        @endforeach
    </body>
</html>
