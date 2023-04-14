@extends('layouts.app')
@section('title', 'Home')
@section('content')

    <section id='profile'>
        <div class="container">
            @if (session('msg'))
  <div class="alert alert-{{ session('type') ?? 'info' }} mt-5">
    {{ session('msg') }}
  </div>
@endif
            <div class="profile-box p-5">
                <h1 class="text-center t-shadow pb-5">PROFILO</h1>
               
                <div class="row">
                    <div class="col-3 position-relative">
                        @if ($doctor->photo)
                            <img src="{{ asset('storage/' . $doctor->photo) }}" alt="{{ $doctor->user->name }}"
                                class="img-fluid position-relative ">
                                @else
                                <img src="https://st2.depositphotos.com/1743476/5738/i/450/depositphotos_57385697-stock-photo-confident-mature-doctor.jpg"
                                alt="placeholder" class="img-fluid position-relative">
                                @endif
                                @if ($doctor->is_sponsored)
                                <img src="{{ asset('img/Sponsored.png') }}" alt="{{ $doctor->user->name }}"
                                    class="img-fluid position-absolute" style="width: 80px; top:-10px; left:0">
                                  @endif

                    </div>

                    <div class="col-7 d-flex flex-column align-items-start justify-content-center t-shadow px-5">
                        <h4>Nome: <span class="text-white ">{{ $doctor->user->name }}</span></h4>
                        <h4 class="py-3">Indirizzo: <span class="text-white ">{{ $doctor->address }}</span></h4>
                        <h4 class="pb-3">Città: <span class="text-white ">{{ $doctor->city }}</span></h4>
                        <h4>Telefono: <span class="text-white ">{{ $doctor->phone }}</span></h4>
                    </div>

                    <div class="col-12 d-flex justify-content-between align-items-center">
                        <h3 class="py-5">Media Voto:
                             <span class="text-warning">
                                @for ($i = 0; $i < 5; $i++)
                                @if ($media && $i<$media)
                                &#9733
                                @else    
                                &#9734
                                @endif
                            @endfor
                             </span>
                        </h3>
                    </div>
                    <div class=" col-12 py-3">
                        <h3>Specializzazioni:</h3>
                        <ul class="text-white">

                            @foreach ($specializations as $specialization)
                                <li>{{ $specialization['name'] }} </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-12 my-3">
                        @if($doctor->curriculum)
                        <h3 class="mb-5">Curriculum:</h3>
                        <a href="{{ asset('storage/' . $doctor->curriculum) }}" alt="{{ $doctor->user->name }}">Visualizza Curriculum</a>
                        @else
                        <h5>Nessun Curriculum caricato</h5>
                        @endif
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <a href="{{ route('dashboard') }}" class="btn btn-warning me-2"><i
                                class="fa-solid fa-arrow-rotate-left"></i> Indietro</a>
                        <a href="{{ route('admin.doctors.edit', $doctor->id) }}" class="btn btn-success me-2"><i
                                class="fa-solid fa-pencil"></i> Modifica</a>
                        <a href="{{ route('admin.doctors.sponsored') }}" class="btn btn-info"><i class="fa-solid fa-turn-up"></i> Passa a pro</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
