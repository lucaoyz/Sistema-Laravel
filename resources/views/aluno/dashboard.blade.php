@extends('aluno.layoutsModals.layouts')
@section('title', 'Início')
@section('dashboard', 'active bg-gradient-primary')
@section('pagina', 'Início')
@section('content')
    <div class="container-fluid py-4">
        <div class="card-header-tabs p-0 mt-n4 mx-3 border-radius-lg">
            <p>Seja bem vindo ao sistema da GV2 Academia!</p>
            </div><br>
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
                <a href="{{route('aluno.treino')}}">
              <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">fitness_center</i>
              </div>
            </a>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Treino</p>
                <h4 class="mb-0"></h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <p class="mb-0"><span class="text-danger text-sm font-weight-bolder"><a href="{{route('aluno.treino')}}">Clique aqui para visualizar seu treino</a></span></p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
                <a href="{{route('aluno.perfil')}}">
              <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">person</i>
              </div>
            </a>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Perfil</p>
                <h4 class="mb-0"></h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <p class="mb-0"><span class="text-danger text-sm font-weight-bolder"><a href="{{route('aluno.perfil')}}">Acesse seu perfil</a></span></p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-header p-3 pt-2">
                <a href="https://api.whatsapp.com/send?phone=551936292654&text=Ol%C3%A1%2C%20vim%20pelo%20sistema%20e%20preciso%20de%20uma%20ajuda!">
              <div class="icon icon-lg icon-shape bg-gradient-secondary shadow-secondary text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">settings_accessibility</i>
              </div>
            </a>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Suporte</p>
                <h4 class="mb-0"><a href="
                    https://api.whatsapp.com/send?phone=551936292654&text=Ol%C3%A1%2C%20vim%20pelo%20sistema%20e%20preciso%20de%20uma%20ajuda!
                ">Fale conosco</a></h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <p class="mb-0"><span class="text-danger text-sm font-weight-bolder"><a href="https://api.whatsapp.com/send?phone=551936292654&text=Ol%C3%A1%2C%20vim%20pelo%20sistema%20e%20preciso%20de%20uma%20ajuda!">Clique aqui caso para alguma dúvida!</a></span></p>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
