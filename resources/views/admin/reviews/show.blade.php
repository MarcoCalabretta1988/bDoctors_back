@extends('layouts.app')
@section('title', 'Dettaglio Recensione')
@section('content')


<section id="review-detail" class="py-5">
    <div class="container py-5">

        <div class="card text-bg-dark b-border">
            <h5 class="card-header border-bottom">Da: {{$review->email}}</h5>
            <h5 class="card-header border-bottom">Il: {{$review->created_at}}</h5>
            <div class="card-body">
                <h5 class="card-title my-3">Nome: {{$review->name}}</h5>
                <p class="card-text">{{$review->text}}</p>
                
            </div>
        </div>
        
<div class="button-box d-flex justify-content-end mt-3">
  
   <form action="{{ route('admin.reviews.destroy' , $review->id)}}" method="POST" class="delete-form">
    @method('DELETE')
    @csrf
    <button  type="submit" class="btn btn-danger mx-2"><i class="fa-solid fa-trash"></i> Cancella</button>
   </form>
    <a href="{{ route('admin.reviews.index')}}" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i> Indietro </a>

</div>
    </div>
    </section>

  @endsection