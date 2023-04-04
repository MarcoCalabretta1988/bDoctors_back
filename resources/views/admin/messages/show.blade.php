@extends('layouts.app')
@section('title', 'Dettaglio Messaggio')
@section('content')


<section id="message-detail" class="py-5">
    <div class="container py-5">

        <div class="card text-bg-dark b-border">
            <h5 class="card-header border-bottom">Da: {{$message->email}}</h5>
            <h5 class="card-header border-bottom">Il: {{$message->created_at}}</h5>
            <div class="card-body">
                <h5 class="card-title my-3">Nome: {{$message->name}}</h5>
                <p class="card-text">{{$message->text}}</p>
                
            </div>
        </div>
        
<div class="button-box d-flex justify-content-end mt-3">
  
   <form action="{{ route('admin.messages.destroy' , $message->id)}}" method="POST" class="delete-form">
    @method('DELETE')
    @csrf
    <button  type="submit" class="btn btn-danger mx-2"><i class="fa-solid fa-trash"></i> Cancella</button>
   </form>
    <a href="{{ route('admin.messages.index')}}" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i> Indietro </a>

</div>
    </div>
    </section>

  @endsection