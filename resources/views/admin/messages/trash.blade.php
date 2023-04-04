@extends('layouts.app')
@section('title', 'Cestino')
@section('content')

    <section id='trash'>
      <div class="container py-5">
        @if(session('msg'))
  <div class="alert alert-{{session('type') ?? 'info'}} " >
            {{ session('msg')}}
  </div>
@endif
        
        
            <table class="table table-dark table-striped ">
                <thead>
                  <tr>
                    <th scope="col">Nome:</th>
                    <th scope="col">Email:</th>
                    <th scope="col">Testo:</th>
                    <th scope="col">Inviato:</th> 
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($messages as $message)
                    <tr>    
                    <th scope="row">{{$message->name}}</th>
                    <td>{{$message->email}}</td>
                    <td>{{$message->text}}</td>
                    <td>{{$message->created_at}}</td>
    
                    <td>
                      <div class="button-box d-flex justify-content-end align-items-center">
                       
                        <form action="{{ route('admin.messages.restore' , $message->id)}}" method="POST">
                          @method('PATCH')
                          @csrf
                          <button  type="submit" class="btn btn-success btn-sm me-3"><i class="fa-solid fa-trash-can-arrow-up"></i></button>
                         </form>
              
                         <form action="{{ route('admin.messages.delete' , $message->id)}}" method="POST" class="delete-form">
                          @method('DELETE')
                          @csrf
                          <button  type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                         </form>
                      </div>
                      </td>
                  </tr>
                    @endforeach
                </tbody>
              </table>
              <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('admin.messages.index')}}" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i> Indietro </a>
                @if($messages->hasPages())
                {{ $messages->links()}}
                @endif
              </div>
            </div>
    </section>
@endsection