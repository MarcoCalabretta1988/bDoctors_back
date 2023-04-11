@extends('layouts.app')
@section('title', 'Review')
@section('content')

    <section id='review'>
      <div class="container py-5">
        @if(session('msg'))
  <div class="alert alert-{{session('type') ?? 'info'}} " >
            {{ session('msg')}}
  </div>
@endif
@if (!$reviews[0])
<h1 class="p-blu t-shadow text-center">Non ci sono nuove recensioni!</h1>                      
@else
        
        
            <table class="table table-dark ">
                <thead>
                  <tr>
                    <th scope="col">Nome:</th>
                    <th scope="col">Testo:</th>
                    <th scope="col">Inviato:</th> 
                    <th></th>
                  </tr>
                </thead>
                <tbody >
                  
                    @foreach ($reviews as $review)
                    <tr class="{{ $review->is_read ? "text-secondary" : "text-white"}}">    
                    <th scope="row">{{$review->name}}</th>
                    <td>{{$review->text}}</td>
                    <td>{{$review->created_at}}</td>
    
                    <td>
                      <div class="button-box d-flex justify-content-end">
                        <a href="{{route('admin.reviews.show',$review->id)}}" class="btn btn-sm btn-primary me-3"><i class="fa-sharp fa-solid fa-eye"></i></a>
                       
              
                         <form action="{{ route('admin.reviews.destroy' , $review->id)}}" method="POST" class="trash-form">
                          @method('DELETE')
                          @csrf
                          <button  technology="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                         </form>
                      </div>
                      </td>
                  </tr>
                    @endforeach
                </tbody>
              </table>
              <div class="d-flex justify-content-between align-items-center">
                <a href="{{route('dashboard')}}" class="btn btn-warning"><i class="fa-solid fa-arrow-rotate-left"></i> Indietro</a>
                <a href="{{ route('admin.reviews.trash')}}" class="btn btn-info"><i class="fa-solid fa-trash"></i> Cestino</a>
                @if($reviews->hasPages())
                {{ $reviews->links()}}
                @endif
              </div>
            </div>
    </section>
    @endif
@endsection