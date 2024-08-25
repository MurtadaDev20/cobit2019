<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="keywords" content="HTML5 Template" />
  <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
  <meta name="author" content="potenzaglobalsolutions.com" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  @include('layouts.head')
</head>

<body>


  <section class="height-100vh d-flex align-items-center page-section-ptb login"
    style="background-image: url(images/login-bg.jpg);">
    <div class="container">
      <div class="row justify-content-center g-0 vertical-align">
        <div class="col-lg-4 col-md-6 login-fancy-bg bg" style="background-image: url(images/login-inner-bg.jpg);">
          <div class="login-fancy">
            <h2 class="text-white mb-20">Cobit 2019</h2>
            {{-- <p class="mb-20 text-white">Create tailor-cut websites with the exclusive multi-purpose responsive template
              along with powerful features.</p> --}}
            <ul class="list-unstyled  pos-bot pb-30">
              <li class="list-inline-item"><a class="text-white" href="#"> Terms of Use</a> </li>
              <li class="list-inline-item"><a class="text-white" href="#"> Privacy Policy</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 bg-white">
          <div class="login-fancy pb-40 clearfix">
            <h3 class="mb-30">Sign In To Admin</h3>
            <form method="POST" action="{{ route('login') }}">
              <div class="section-field mb-20">

                @csrf

                <label class="mb-10" for="name">Email </label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                  value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

              <div class="section-field mb-20">
                <label class="mb-10" for="Password">Password* </label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
              </div>

              <div class="section-field">
                <div class="remember-checkbox mb-30">
                  <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                  <label for="two"> Remember me</label>
                  @if (Route::has('password.request'))
                  <a class="float-end" href="{{ route('password.request') }}">
                      {{ __('Forgot Your Password?') }}
                  </a>
              @endif
                </div>
              </div>
              <button type="submit" class="button">
                {{ __('Login') }}
            </button>


          </div>
          </form>
          {{-- <p class="mt-20 mb-0">Don't have an account? <a href="register.html"> Create one here</a></p> --}}
        </div>
      </div>
    </div>
    </div>
  </section>


  @section('js')

  @endsection
