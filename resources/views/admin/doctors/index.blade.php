@extends('layouts.app')
@section('title', 'Home')
@section('content')

    <section id='profile'>
        <div class="container">
            <div class="profile-box p-5">
                <h1 class="text-center t-shadow pb-5">PROFILO</h1>
                <div class="row">
                    <div class="col-3">
                        @if ( $doctor->photo)
                        <img src="{{ asset('storage/'. $doctor->photo)}}" alt="{{ $doctor->user->name }}" class="img-fluid">
                        @else
                        <img src="https://st2.depositphotos.com/1743476/5738/i/450/depositphotos_57385697-stock-photo-confident-mature-doctor.jpg" alt="placeholder" class="img-fluid">                            
                        @endif

                       </div>
                   
                       <div class="col-7 d-flex flex-column align-items-start justify-content-center t-shadow px-5">
                          <h4>Nome: <span class="text-white ">{{ $doctor->user->name }}</span></h4>
                          <h4 class="py-3">Indirizzo: <span class="text-white ">{{ $doctor->address }}</span></h4>
                          <h4 class="pb-3">Città: <span class="text-white ">{{ $doctor->city }}</span></h4>
                          <h4>Telefono: <span class="text-white ">{{ $doctor->phone }}</span></h4>
                        </div>

                        <div class="col-12 d-flex justify-content-between align-items-center">
                           <h3 class="py-5">Media Voto: <span class="text-warning">&#9733; &#9733; &#9733; &#9734; &#9734;</span>
                           </h3>
                        </div>
                           <div class=" col-12 py-3">
                               <h3>Specializzazioni:</h3>
                               <ul class="text-white">
       
                                   @foreach ($specializations as $specialization )
                               
                                      <li>{{$specialization['name']}} </li>
                                   @endforeach
                               </ul>
                           </div>
                           <div class="col-12 my-3">
                            <h3 class="mb-5">Curriculum:</h3>
                            <img src="{{ asset('storage/'. $doctor->curriculum)}}" alt="{{ $doctor->user->name }}" class="img-fluid">
                           </div>
                <div class="col-12 d-flex justify-content-end">
                    <a href="{{ route('dashboard') }}" class="btn btn-warning me-2"><i class="fa-solid fa-arrow-rotate-left"></i> Indietro</a>
                    <a href="{{ route('admin.doctors.edit', $doctor->id) }}" class="btn btn-success"><i class="fa-solid fa-pencil"></i> Modifica</a>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
