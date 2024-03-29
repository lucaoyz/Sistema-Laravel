@extends('admin.layoutsModals.layouts')
@section('title', 'Início')
@section('dashboard', 'active bg-gradient-primary')
@section('pagina', 'Início')
@section('content')
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
                <a href="{{route('treinos.index')}}">
              <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">fitness_center</i>
              </div>
            </a>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Treinos registrados</p>
                <h4 class="mb-0">{{$treinos}}</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <p class="mb-0"><span class="text-danger text-sm font-weight-bolder"><a href="{{route('treinos.index')}}">Registre um novo treino</a></span></p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
                <a href="{{route('admin.usuarios')}}">
              <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">person</i>
              </div>
                </a>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Usuários registrados</p>
                <h4 class="mb-0">{{ $usuarios }}</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <p class="mb-0"><span class="text-danger text-sm font-weight-bolder"><a href="{{route('admin.usuarios')}}">Registre um novo usuário</a></span></p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
                <a href="{{route('admin.usuarios')}}">
              <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">person</i>
              </div>
                </a>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Alunos registrados</p>
                <h4 class="mb-0">{{ $alunos }}</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-danger text-sm font-weight-bolder"><a href="{{route('admin.usuarios')}}">Registre um novo aluno</a></span></p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-header p-3 pt-2">
                <a href="{{route('admin.alterarInfos')}}">
              <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">weekend</i>
              </div>
            </a>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Alterar informações gerais</p>
                <h4 class="mb-0"><a href="{{route('admin.alterarInfos')}}">Acesse aqui</a></h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <p class="mb-0"><span class="text-danger text-sm font-weight-bolder"><a href="{{route('admin.alterarInfos')}}">Clique aqui para alterar informações</a></span></p>
            </div>
          </div>
        </div>
      </div><br>
      <div class="row">
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-header p-3 pt-2">
                <a href="https://api.whatsapp.com/send?phone=5519991415811&text=Ol%C3%A1%2C%20vim%20pelo%20sistema%20e%20preciso%20de%20uma%20ajuda!">
              <div class="icon icon-lg icon-shape bg-gradient-secondary shadow-secondary text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">settings_accessibility</i>
              </div>
            </a>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Suporte</p>
                <h4 class="mb-0"><a href="https://api.whatsapp.com/send?phone=5519991415811&text=Ol%C3%A1%2C%20vim%20pelo%20sistema%20e%20preciso%20de%20uma%20ajuda!">Fale conosco</a></h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <p class="mb-0"><span class="text-danger text-sm font-weight-bolder"><a href="https://api.whatsapp.com/send?phone=5519991415811&text=Ol%C3%A1%2C%20vim%20pelo%20sistema%20e%20preciso%20de%20uma%20ajuda!">Clique aqui caso para alguma dúvida!</a></span></p>
            </div>
          </div>
        </div>
      </div>
    </div>
      @endsection
