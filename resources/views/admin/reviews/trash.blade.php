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
                 
                    <th scope="col">Testo:</th>
                    <th scope="col">Inviato:</th> 
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($reviews as $review)
                    <tr>    
                    <th scope="row">{{$review->name}}</th>
    
                    <td>{{$review->text}}</td>
                    <td>{{$review->created_at}}</td>
    
                    <td>
                      <div class="button-box d-flex justify-content-end align-items-center">
                       
                        <form action="{{ route('admin.reviews.restore' , $review->id)}}" method="POST">
                          @method('PATCH')
                          @csrf
                          <button  type="submit" class="btn btn-success btn-sm me-3"><i class="fa-solid fa-trash-can-arrow-up"></i></button>
                         </form>
              
                         <form action="{{ route('admin.reviews.delete' , $review->id)}}" method="POST" class="delete-form">
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
                <a href="{{ route('admin.reviews.index')}}" class="btn btn-primary"><i class="fa-solid fa-arrow-left"></i> Indietro </a>
                @if($reviews->hasPages())
                {{ $reviews->links()}}
                @endif
              </div>
            </div>
    </section>
@endsection