@extends('layouts.app')

@section('content')

<!-- HEADER IMAGE -->
<header id="register-header" class="header-image text-white d-none d-md-block">
  <div class="col" style="position:absolute; padding:20px;">
      <h1 class="display-1">Login</h1>
    <p>Mari bergabung untuk pengalaman yang lebih menyenangkan!</p>
    </div>
  <img src="{{ asset('img/header.jpeg') }}" style="height:300px; width:1216.5px;">
</header>

<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-7">
      <h1 class="text-center">Login</h1>
      <hr>

      <form method="POST" action="{{ route('login') }}">
        @csrf
        
        <div class="mb-3 row">
          <label for="email" class="col-md-4 col-form-label text-md-end">
          Email</label>
          <div class="col-md-6">
            <input id="email" type="email" class="form-control @error('email')
            is-invalid @enderror" name="email" value="{{ old('email') }}"
            required autocomplete="email" autofocus>
            @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
        </div>

        <div class="mb-3 row">
          <label for="password" class="col-md-4 col-form-label text-md-end">
          Password</label>
          <div class="col-md-6">
            <input id="password" type="password" class="form-control
            @error('password') is-invalid @enderror" name="password"
            required autocomplete="current-password">
            @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
        </div>

        <div class="mb-3 row">
          <div class="col-md-6 offset-md-4">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="remember"
              id="remember" {{ old('remember') ? 'checked' : '' }}>
              <label class="form-check-label" for="remember">
                {{ __('Remember Me') }}
              </label>
            </div>
          </div>
        </div>

        <div class="form-group row mb-0">
          <div class="col-md-8 offset-md-4">
            <button type="submit" class="btn btn-outline-dark">
              {{ __('Login') }}
            </button>
            @if (Route::has('password.request'))
              <a class="btn btn-link text-decoration-none" 
              href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
              </a>
            @endif
          </div>
        </div>
      </form>

    </div>
  </div>
</div>
@endsection
