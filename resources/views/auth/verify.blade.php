@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifique seu email') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Um link de verificação foi enviado a seu email.') }}
                        </div>
                    @endif

                    {{ __('Chegue o seu email para prosseguir. Caso não encontre, procure no spam.') }}
                    {{ __('Caso você não tenha recebido') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Clique aqui para enviar novamente') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
