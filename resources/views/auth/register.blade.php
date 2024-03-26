@extends('layouts.app')

@section('content')

<!-- HEADER IMAGE -->
<header id="register-header" class="header-image text-white d-none d-md-block">
  <div class="col" style="position:absolute; padding:20px;">
      <h1 class="display-1">Join our Community</h1>
      <p>Mari berintegerasi dengan salah satu blog komunitas ideal
          di Indonesia!</p>
      </div>
  <img src="{{ asset('img/header.jpeg') }}" style="height:300px; width:1216.5px;">
</header>

<div class="container my-5">
  <div class="row ">
    <div class="col-lg-8">
      <h1>Form Pendaftaran</h1>
      <hr>
      <form method="POST" action="{{ route('register') }}"
      enctype="multipart/form-data">
        @include('layouts.form',['tombol' => 'Daftar'])
      </form>
    </div>
  </div>
</div>

@endsection
