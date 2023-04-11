@extends('layouts.app')
@section('title', 'Messagges')
@section('content')

    <section id='messages'>
      <div class="container py-5">
        @if(session('msg'))
  <div class="alert alert-{{session('type') ?? 'info'}} " >
            {{ session('msg')}}
  </div>
@endif

@if (!$messages[0])
<h1 class="p-blu t-shadow text-center">Non ci sono nuovi messaggi !</h1>                      
@else
            <table class="table table-dark ">
                <thead>
                  <tr>
                    <th scope="col">Nome:</th>
                    <th scope="col">Email:</th>
                    <th scope="col">Testo:</th>
                    <th scope="col">Inviato:</th> 
                    <th></th>
                  </tr>
                </thead>
                <tbody >
                  @foreach ($messages as $message)
                <tr class="{{ $message->is_read ? "text-secondary" : "text-white"}}">    
                  <th scope="row">{{$message->name}}</th>
                  <td>{{$message->email}}</td>
                  <td>{{$message->text}}</td>
                  <td>{{$message->created_at}}</td>
  
                  <td>
                    <div class="button-box d-flex justify-content-end">
                      <a href="{{route('admin.messages.show',$message->id)}}" class="btn btn-sm btn-primary me-3"><i class="fa-sharp fa-solid fa-eye"></i></a>
                      <form action="{{ route('admin.messages.destroy' , $message->id)}}" method="POST" class="trash-form">
                        @method('DELETE')
                        @csrf
                        <button  technology="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                      </form>
                    </div>
                    </td>
                </tr>
                  @endforeach
                  @endif
                </tbody>
              </table>
              <div class="d-flex justify-content-between align-items-center">
                <a href="{{route('dashboard')}}" class="btn btn-warning"><i class="fa-solid fa-arrow-rotate-left"></i> Indietro</a>
                <a href="{{ route('admin.messages.trash')}}" class="btn btn-info"><i class="fa-solid fa-trash"></i> Cestino</a>
                @if($messages->hasPages())
                {{ $messages->links()}}
                @endif
              </div>
            </div>
    </section>
@endsection