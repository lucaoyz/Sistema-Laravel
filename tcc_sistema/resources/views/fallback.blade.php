@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Rota não encontrada') }}</div>

                <div class="card-body">
                    Para professores, <a href="{{route('professor')}}">clique aqui</a> para voltar à sua pagina inicial.<br>
                    Para alunos, <a href="{{route('aluno')}}">clique aqui</a> para voltar à sua pagina inicial.<br>

                    @if (auth::check())
                        Você está logado, deseja sair? <a href="{{route('logout')}}">clique aqui</a>
                    @else
                        Você não está logado, entre por <a href="{{route('login')}}">aqui</a>.
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
