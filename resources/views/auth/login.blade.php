<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>GV2 Academia</title>

    <link rel="halter" sizes="76x76" href="{{asset('img/logos/gv2.png')}}">
    <link rel="icon" type="image/png" href="{{asset('img/logos/gv2.png')}}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

@if ($message = Session::get('error'))
<div class="alert alert-danger">
    <p>{{ $message }}</p>
</div>
@endif
<body>


<section class="vh-100" style="background-color: #191919">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          <div class="card" style="border-radius: 1rem;">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-block">
                <img src="{{asset('img/gv2fora.jpg')}}"
                  alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                    <div class="d-flex align-items-center mb-3 pb-1">
                      <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                      <img src="{{asset('img/logos/GV2Logo_Compacta.png')}}" style="max-width: 200px; margin-left: 0;">
                    </div>

                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Entrar com sua conta</h5>

                    <div class="form-outline mb-4">
                      <label class="form-label" for="form2Example17">Endereço de email</label>
                      <input type="email" id="form2Example17" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />
                      @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                    </div>

                    <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example27">Senha</label>
                      <input type="password" id="form2Example27" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" />
                      @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                    </div>

                    <div class="pt-1 mb-4">
                      <button class="btn btn-dark btn-lg btn-block" type="submit">Entrar</button>
                    </div>

                    @if (Route::has('password.request'))
                                        <a class="small text-muted" href="{{ route('password.request') }}">Esqueceu sua senha?</a>
                                @endif
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>
</html>
