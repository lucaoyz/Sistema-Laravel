@extends('admin.layoutsModals.layouts')
@section('title', 'Financeiro')
@section('financeiro', 'active bg-gradient-primary')
@section('pagina', 'Financeiro')
@section('content')

    <div class="container-fluid py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">

                            <div class="card-header p-3 pt-2">
                              <div class="pt-1">
                                <p class="text-sm mb-0 text-capitalize">Clique abaixo para voltar para tela inicial</p>
                                <h5 class="mb-0"><a href="{{route('admin.home')}}" class="text-success">Em breve</a></h5>
                              </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer p-3">
                              <p class="mb-0"><span class="text-sm font-weight-bolder">
                                  Sistema financeiro ainda em desenvolvimento.
                                  </span></p>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
