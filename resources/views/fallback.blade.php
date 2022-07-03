@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Rota não encontrada') }}</div>

                <div class="card-body">


                    @if (\Auth::check())
                    @if(auth()->user()->type == 'admin')
                            <a href="{{route('admin')}}">Clique aqui</a> para voltar à sua pagina inicial.<br>
                            @elseif(auth()->user()->type == 'professor')
                            <a href="{{route('professor')}}">Clique aqui</a> para voltar à sua pagina inicial.<br>
                            @else
                            <a href="{{route('aluno')}}">Clique aqui</a> para voltar à sua pagina inicial.<br>
                            @endif

                        <br>Você está logado, deseja sair? <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                         <i class="fa fa-sign-out me-sm-1"></i>clique aqui.
                     </a>

                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                         @csrf
                     </form></a>

                    @else

                        Você não está logado, entre por <a href="{{route('login')}}">aqui</a>.

                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
