@extends('aluno.layoutsModals.layouts')
@section('title', 'Perfil')
@section('perfil', 'active bg-gradient-primary')
@section('pagina', 'Perfil')
@section('content')

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    @if ($message = Session::get('error'))
    <div class="alert alert-danger">
        <p>{{ $message }}</p>
    </div>
    @endif
    <div class="container-fluid px-2 px-md-4">
    <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url({{asset('img/gv2bg.jpg')}});">
        <span class="mask  bg-gradient-primary  opacity-6"></span>
    </div>
    <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="row gx-4 mb-2">
        <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
            <img src="{{asset('img/halter.png')}}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
        </div>
        <div class="col-auto my-auto">
            <div class="h-100">
            <h5 class="mb-1">
                {{ Auth::user()->name }}
            </h5>
            <p class="mb-0 font-weight-normal text-sm">
                {{ Auth::user()->email }}
            </p>
            </div>
        </div>
        <div class="col-auto my-auto">
            <div class="h-100" >
                <a class="btn btn-primary" href="{{ route('aluno.change-password') }}">Alterar senha</a>
            </div>
        </div>
        </div>
        <div class="row">
        <div class="row">
            <div class="col-12 col-xl-4">
            <div class="card card-plain h-100">
                <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                    <h6 class="mb-0">Informações</h6>
                    </div>
                    <div class="col-md-4 text-end">
                    <a href="javascript:;">
                        <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar perfil"></i>
                    </a>
                    </div>
                </div>
                </div>
                <div class="card-body p-3">
                <hr class="horizontal gray-light my-4">
                <ul class="list-group">
                    <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Nome completo:</strong> &nbsp; {{ Auth::user()->name }}</li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Telefone ou celular:</strong> &nbsp; {{$aluno->alu_celular}}</li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; {{ Auth::user()->email }}</li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Endereço:</strong> &nbsp; {{$aluno->alu_endereco}}</li>
                </ul>
                <h6 class="mb-0"><a href="{{route('aluno.treino')}}">Acesse seu treino clicando aqui</a></h6>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
@endsection
</body>

</html>
