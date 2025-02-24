@extends('layouts.app')

@section('content')

<!-- SLIDER -->
<header id="main-slide">
<div id="mySlide" class="carousel slide carousel-fade" data-bs-ride="carousel">
  <ul class="carousel-indicators">
    <li data-bs-target="#mySlide" data-bs-slide-to="0" class="active" style="list-style-type: none;"></li>
    <li data-bs-target="#mySlide" data-bs-slide-to="1" style="list-style-type: none;"></li>
    <li data-bs-target="#mySlide" data-bs-slide-to="2" style="list-style-type: none;"></li>
  </ul>
  <div class="carousel-inner text-white">
    <div class="carousel-item active" id="slide1">
      <div class="container">
        <div class="d-none d-md-block" style="position:absolute; padding:20px;">
          <h1 class="display-1 bg-black px-4 pb-2 d-inline-block">
            Rule the <strong>Multiverse</strong>
          </h1>
          <br>
          <p class="bg-dark px-2 pb-1 d-inline-block">Lorem ipsum dolor, sit
            amet consectetur adipisicing elit. Aut cumque molestias asperiores
            ipsam officiis? Doloremque.</p>
        </div>
      </div>
      <img src="{{ asset('img/header01.jpg') }}" style="height:700px;">
    </div>
    <div class="carousel-item" id="slide2">
      <div class="container">
        <div class="d-none d-md-block text-end" style="position:absolute; padding:20px;">
          <h1 class="display-1 bg-dark px-4 pb-2 d-inline-block">
            Be an <strong> Inspiration</strong>
          </h1>
          <br>
          <p class="bg-black px-2 pb-1 d-inline-block">Lorem ipsum dolor, sit
            amet consectetur adipisicing elit. Aut cumque molestias asperiores
            ipsam officiis? Doloremque.</p>
        </div>
      </div>
      <img src="{{ asset('img/header03.jpg') }}">
    </div>
    <div class="carousel-item" id="slide3">
      <div class="container">
        <div class="d-none d-md-block" style="position:absolute; padding:20px;">
          <h1 class="display-1 bg-black px-4 pb-2 d-inline-block">
            Hone your <strong>Vision</strong>
          </h1>
          <br>
          <p class="bg-dark px-2 pb-1 d-inline-block">Lorem ipsum dolor, sit
            amet consectetur adipisicing elit. Aut cumque molestias asperiores
            ipsam officiis? Doloremque.</p>
        </div>
      </div>
      <img src="{{ asset('img/header06.jpg') }}" style="height:700px;">
    </div>
    
  <a class="carousel-control-prev" href="#mySlide" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#mySlide" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</header>

<!-- MEMBER LIST -->
<section id="member-list" class="py-5 bg-light text-center">
  <div class="container">
    <div class="row">
      <div class="col text-center" >
        <h1>Member List</h1>
        <hr class="w-25 mx-auto">
        <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing
          elit. Dignissimos, vitae!</p>

          {{-- Untuk flash message --}}
          @if(session()->has('pesan'))
            @if(session()->get('pesan')== 'update')
            <div class="alert alert-success alert-dismissible w-50 mx-auto
                       fade show">
              Data <b>{{session()->get('nama')}}</b> berhasil di update
              <button type="button" class="btn-close" data-bs-dismiss="alert">
              </button>
            </div>
            @endif
            @if(session()->get('pesan')== 'delete')
            <div class="alert alert-danger alert-dismissible w-50 mx-auto
                       fade show">
              Data <b>{{session()->get('nama')}}</b> sudah dihapus
              <button type="button" class="btn-close" data-bs-dismiss="alert">
              </button>
            </div>
            @endif
          @endif

      </div>
    </div>

    {{-- Proses looping untuk menampilkan semua user --}}
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
      @forelse ($users as $user)
      <div class="col mt-3">
        <div class="card">
          <img class="card-img-top"
               src="{{ asset('img/bg'.$user->background_profil.'.jpeg')}}">
          <div class="card-body">
            <img src="{{ asset('storage/uploads/'.$user->gambar_profil)}}"
                 class="rounded-circle img-thumbnail">
            <h5 class="card-title">{{$user->nama}}</h5>
            <p class="card-text">"{{$user->bio_profil  ?? '. . .'}}"</p>
            <ul class="fa-ul text-start">
              <li class="mb-2">
                <span class="fa-li"><i class="far fa-clock"></i></span>
                Join in {{ date('F Y', strtotime($user->created_at)) }}
              </li>
              <li class="mb-2">
                <span class="fa-li"><i class="fas fa-briefcase"></i></span>
                {{$user->pekerjaan ?? '. . .'}}
              </li>
              <li class="mb-2">
                <span class="fa-li"><i class="fas fa-home"></i></span>
                {{$user->kota  ?? '. . .'}}
              </li>
              <li class="mb-2">
                <span class="fa-li"><i class="fas fa-birthday-cake"></i></span>
                {{ date_diff(date_create($user->tanggal_lahir ),
                   date_create('now'))->y }} tahun
              </li>
              <li class="mb-2">
                <span class="fa-li"><i class="fas fa-envelope"></i></span>
                {{$user->email}}
              </li>
            </ul>
            {{-- Tombol edit & hapus hanya untuk user sendiri atau admin --}}
            {{-- Ini menggunakan laravel policy --}}
            @can('update', $user)
            <div class="btn-action">
              <a href="{{ url('/users/'.$user->id.'/edit')}}"
                 class="btn btn-light d-inline-block">Edit</a>
              <button class="btn btn-dark btn-hapus" 
              data-id="{{$user->id}}" data-bs-toggle="modal" 
              data-bs-target="#DeleteModal">Hapus</button>
            </div>
            @endcan
          </div>
        </div>
      </div>
      @empty
        <p>Tidak ada data...</p>
      @endforelse
    </div>
  </div>
</section>

{{-- Modal untuk konfirmasi proses delete --}}

<div id="DeleteModal" class="modal fade" role="dialog">
  <div class="modal-dialog ">
  <!-- Modal content-->
    <form action="" id="deleteForm" method="POST">
    @csrf
    @method('DELETE')
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-center">Konfirmasi</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal">
        </button>
      </div>
      <div class="modal-body">
        <p class="text-center mb-0">Anda yakin akan menghapus User ini?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">
            Cancel</button>
        <button type="submit" class="btn btn-outline-dark" data-bs-dismiss="modal">
            Ya, Hapus</button>
      </div>
    </div>
    </form>
  </div>
</div>

@endsection