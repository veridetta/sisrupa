@extends('layouts/umumLayout')

@section('title', 'Register Page')

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/authentication.css')) }}">
@endsection

@section('content')
  <div class="auth-wrapper auth-basic px-2 bg-primary bg-darken-3">
    <div class="col-6 row my-2">
      <!-- Register Basic -->
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
            <h2 class="brand-text text-primary text-center ms-1">SISRUPA | MAJALENGKA</h2>
          </a>
          <form class="auth-register-form mt-2" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="col-12 my-2 justify-content-center">
              <input type="hidden" name="jabatan" value="warga"/>
                <div class="mb-1">
                  <label for="register-username" class="form-label">Username</label>
                  <input type="text" class="form-control @error('username') is-invalid @enderror" id="register-username" name="username" placeholder="userxxxx" aria-describedby="register-username" tabindex="1" autofocus value="{{ old('username') }}" />
                  @error('username')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="mb-1">
                  <label for="register-name" class="form-label">Nama Pedagang</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" id="register-name"
                    name="name" placeholder="H. Udin" aria-describedby="register-name" tabindex="2"
                    value="{{ old('name') }}" />
                  @error('name')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="mb-1">
                  <label for="register-ttl" class="form-ttl">Tempat/Tanggal Lahir</label>
                  <input type="text" class="form-control @error('ttl') is-invalid @enderror" id="register-ttl"
                    name="ttl" placeholder="Cirebon/17-xx-xxxx" aria-describedby="register-ttl" tabindex="2"
                    value="{{ old('ttl') }}" />
                  @error('ttl')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="mb-1">
                  <label for="register-name" class="form-label">Alamat</label>
                  <textarea type="text" class="form-control @error('alamat') is-invalid @enderror" id="register-alamat"
                    name="alamat" placeholder="" aria-describedby="register-alamat" tabindex="2"
                    value="{{ old('alamat') }}" ></textarea>
                  @error('alamat')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="mb-1">
                  <label for="register-telp" class="form-label">No Telp</label>
                  <input type="text" class="form-control @error('telp') is-invalid @enderror" id="register-telp"
                    name="telp" placeholder="08777xxxxx" aria-describedby="register-telp" tabindex="2"
                    value="{{ old('telp') }}" />
                  @error('telp')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="mb-1">
                  <label for="register-jk" class="form-label">Jenis Kelamin</label>
                  <select type="text" class="form-control @error('jk') is-invalid @enderror" id="register-jk"
                    name="jk" placeholder="" aria-describedby="register-jk" tabindex="2"
                    value="{{ old('jk') }}" >
                    <option>Laki-laki</option>
                    <option>Perempuan</option>
                  </select>
                  @error('jk')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="mb-1">
                  <label for="register-jenis" class="form-label">Jenis Dagangan</label>
                  <select type="text" class="form-control @error('jenis') is-invalid @enderror" id="register-jenis"
                    name="jenis" placeholder="" aria-describedby="register-jenis" tabindex="2"
                    value="{{ old('jenis') }}" >
                    <option value=""></option>
                  </select>
                  @error('jenis')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
                <div class="mb-1">
                  <label for="register-password" class="form-label">Password</label>
    
                  <div class="input-group input-group-merge form-password-toggle @error('password') is-invalid @enderror">
                    <input type="password" class="form-control form-control-merge @error('password') is-invalid @enderror"
                      id="register-password" name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="register-password" tabindex="3" />
                    <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                  </div>
                  @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
    
                <div class="mb-1">
                  <label for="register-password-confirm" class="form-label">Confirm Password</label>
    
                  <div class="input-group input-group-merge form-password-toggle">
                    <input type="password" class="form-control form-control-merge" id="register-password-confirm"
                      name="password_confirmation"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="register-password" tabindex="3" />
                    <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                  </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100" tabindex="5">Buat Akun</button>
          </form>

          <p class="text-center mt-2">
            <span class="text-black">Sudah mempunyai akun?</span>
            @if (Route::has('login'))
              <a href="{{ route('login') }}">
                <span>Masuk</span>
              </a>
            @endif
          </p>
      <!-- /Register basic -->
    </div>
  </div>
@endsection
