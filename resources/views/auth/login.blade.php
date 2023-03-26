@extends('layouts/umumLayout')

@section('title', 'Login')

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/authentication.css')) }}">
@endsection

@section('content')
  <div class="auth-wrapper auth-basic px-2 bg-gradient-primary bg-darken-3">
    <div class=" col-6 my-2">
      <!-- Login basic -->
      <div class="card mb-0">
        <div class="card-body">
          <div class="brand-logo">
            <div class=" bg-white">
              <img
                src="{{asset('images/logo/logo.png')}}"
                alt="avatar"
                width="70"
                height="80"
              />
            </div>
          </div>
          <a href="#" class="brand-logo">
            <h2 class="brand-text text-primary ms-1">SISRUPA | Majalengka</h2>
          </a>

          <h4 class="card-title mb-1 text-center">Selamat Datang!</h4>

          @if (session('status'))
            <div class="alert alert-success mb-1 rounded-0" role="alert">
              <div class="alert-body">
                {{ session('status') }}
              </div>
            </div>
          @endif

          <form class="auth-login-form mt-2" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-1">
              <label for="login-username" class="form-label">Username</label>
              <input type="text" class="form-control @error('username') is-invalid @enderror" id="login-username" name="username"
                placeholder="xxxx" aria-describedby="login-username" tabindex="1" autofocus
                value="{{ old('username') }}" />
              @error('username')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="mb-1">
              <div class="d-flex justify-content-between">
                <label class="form-label" for="login-password">Password</label>
                @if (Route::has('password.request'))
                  <a href="{{ route('password.request') }}">
                    <small>Forgot Password?</small>
                  </a>
                @endif
              </div>
              <div class="input-group input-group-merge form-password-toggle">
                <input type="password" class="form-control form-control-merge" id="login-password" name="password"
                  tabindex="2" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                  aria-describedby="login-password" />
                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
              </div>
            </div>
            <div class="mb-1">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember" name="remember" tabindex="3"
                  {{ old('remember') ? 'checked' : '' }} />
                <label class="form-check-label" for="remember"> Ingat saya </label>
              </div>
            </div>
            <button type="submit" class="btn btn-primary w-100" tabindex="4">Masuk</button>
          </form>

          <p class="text-center mt-2">
            <span>Pengguna baru?</span>
            @if (Route::has('register'))
              <a href="{{ route('register') }}">
                <span>Buat akun baru</span>
              </a>
            @endif
          </p>
        </div>
      </div>
      <!-- /Login basic -->
    </div>
  </div>
@endsection
