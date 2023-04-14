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
        {{-- Reviews Table --}}
        <h1 class="p-blu t-shadow text-center">Recensioni:</h1>
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
            
                <a href="{{ route('admin.reviews.trash')}}" class="btn btn-info"><i class="fa-solid fa-trash"></i> Cestino</a>
                @if($reviews->hasPages())
                {{ $reviews->links()}}
                @endif
              </div>
              {{-- Votes Table --}}
              <h1 class="p-blu t-shadow text-center">Voti:</h1>
              <table class="table table-dark ">
                  <thead>
                    <tr>
                      <th scope="col">Voto:</th>
                      <th scope="col">Stelle:</th> 
                    </tr>
                  </thead>
                  <tbody >
                    
                      @foreach ($votes as $vote)
                      <tr>    
                      <th scope="row" ><span class="p-1 rounded" style="background-color: {{$vote['color']}}">@if($vote['label'] === 'Nessun voto')Pessimo @else{{$vote['label']}}@endif</span></th>
                     
                      <td class="text-warning">
                        @for ($i = 0; $i < 5; $i++)
                            @if ($i<$vote['value'])
                            &#9733
                            @else    
                            &#9734
                            @endif
                        @endfor
                      </td>
      
                    
                    </tr>
                      @endforeach
                  </tbody>
                </table>
                <a href="{{route('dashboard')}}" class="btn btn-warning"><i class="fa-solid fa-arrow-rotate-left"></i> Indietro</a>
            </div>
          </section>
    @endif
@endsection