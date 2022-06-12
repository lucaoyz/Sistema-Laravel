@extends('admin.layouts')
@section('title', 'Treino')
@section('treino', 'active bg-gradient-primary')
@section('pagina', 'Treino')
@section('content')

<div class="container-fluid py-4">
    <div class="row">
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-header p-3 pt-2">
            <div class="pt-1">
              <p class="text-sm mb-0 text-capitalize">Exercicios</p>
              <h5 class="mb-0"><a href="" class="text-success">Registre um novo exercicio</a></h5>
            </div>
          </div>
          <hr class="dark horizontal my-0">
          <div class="card-footer p-3">
            <p class="mb-0"><span class="text-sm font-weight-bolder">Atualmente contando com ** exercicios!</span></p>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-header p-3 pt-2">
            <div class="pt-1">
              <p class="text-sm mb-0 text-capitalize">Treinos</p>
              <h5 class="mb-0"><a href="" class="text-success">Crie o treino para um aluno</a></h5>
            </div>
          </div>
          <hr class="dark horizontal my-0">
          <div class="card-footer p-3">
            <p class="mb-0"><span class="text-sm font-weight-bolder">Atualmente contando com ** treinos!</span></p>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-header p-3 pt-2">
            <div class="pt-1">
              <p class="text-sm mb-0 text-capitalize">Treinos</p>
              <h5 class="mb-0"><a href="" class="text-primary">Altere o treino de um aluno</a></h5>
            </div>
          </div>
          <hr class="dark horizontal my-0">
          <div class="card-footer p-3">
            <p class="mb-0"><span class="text-sm font-weight-bolder">Passou a data? troque o treino!</span></p>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-header p-3 pt-2">
            <div class="pt-1">
              <p class="text-sm mb-0 text-capitalize">Treinos</p>
              <h5 class="mb-0"><a href="" class="text-danger">Remova o treino de um aluno</a></h5>
            </div>
          </div>
          <hr class="dark horizontal my-0">
          <div class="card-footer p-3">
            <p class="mb-0"><span class="text-sm font-weight-bolder">Aluno saiu? remova o treino dele!</span></p>
          </div>
        </div>
      </div>
      </div>
    </div>
  </div>
  @endsection
</main>
<!--   Core JS Files   -->
</body>
</html>

