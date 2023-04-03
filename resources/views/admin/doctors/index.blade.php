@extends('layouts.app')
@section('title','Home')
@section('content')

<section id='profile'>
    <div class="container">
        <div class="profile-box p-5">
            <h1 class="text-center t-shadow">PROFILO</h1>
           <div class="row">
            <div class="col-3">
               
                <img src="{{$img[0]}}" alt="{{$name}}">

            </div>
            <div class="col-9 d-flex flex-column justify-content-center t-shadow">
                <div>Nome: {{ucfirst($name)}}</div>
                <div class="py-3">Indirizzo: {{$address[0]}}</div>
                <div>Telefono: {{$phone[0]}}</div>
            </div>
            <div class="col-12 d-flex justify-content-between align-items-center">
                <div class="py-5">Media Voto: <span class="text-warning">&#9733; &#9733; &#9733; &#9734; &#9734;</span></div>
                <a href="{{ route('admin.doctors.edit' , $doctor->id)}}" class="btn btn-warning">Modifica</a>
            </div>
           </div>
        </div>

    </div>
</section>
@endsection