@extends('admin.layouts')
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
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://scontent.fcpq5-1.fna.fbcdn.net/v/t1.6435-9/81519045_2192862607482485_8190455268572659712_n.jpg?_nc_cat=111&ccb=1-7&_nc_sid=e3f864&_nc_eui2=AeFFbfQUsbQrwz_jGSP-a7OeRLOuezaHOXNEs657Noc5c9aE3-kw-R2ckuMv_TXdf7z_h5sZhG3PMCZTfTo4rgqc&_nc_ohc=0XmqUZJC2tEAX-B6w_K&_nc_ht=scontent.fcpq5-1.fna&oh=00_AT-v9wtAUg4bHmGHpIoc3anBWhryVJOuP00vrMc8BMZz9A&oe=62C33C58');">
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
                <a class="btn btn-primary" href="{{ route('admin.change-password') }}">Alterar senha</a>
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
                        <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                      </a>
                    </div>
                  </div>
                </div>
                <div class="card-body p-3">
                  <hr class="horizontal gray-light my-4">
                  <ul class="list-group">
                    <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Nome:</strong> &nbsp; {{ Auth::user()->name }}</li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Telefone ou celular:</strong> &nbsp; (19) 19191-9191</li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; {{ Auth::user()->email }}</li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Endereço:</strong> &nbsp; Santa Barbara d'Oeste</li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">CPF:</strong> &nbsp; 111.111.111-11</li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-12 col-xl-4">
              <div class="card card-plain h-100">
                <div class="card-header pb-0 p-3">
                  <h6 class="mb-0">Treino</h6>
                </div>
                <div class="card-body p-3">
                  <ul class="list-group">
                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2 pt-0">
                      <div class="d-flex align-items-start flex-column justify-content-center">
                        <h6 class="mb-0 text-sm"></h6>
                        <p class="list-group-item border-0 ps-0 pt-0 text-sm">Acesse seu treino clicando no texto a frente!</p>
                      </div>
                      <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto w-25 w-md-auto" href="{{route('treinos.index')}}">Clique aqui</a>
                    </li>
                  </ul>
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
