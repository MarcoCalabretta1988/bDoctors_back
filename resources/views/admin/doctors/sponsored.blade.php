@extends('layouts.app')
@section ('title','Sponsorizzate')
@section('content')
<section id="plans" >
    <div class="container">
    <h2 class="text-center py-5 t-shadow">- Trova il piano di sponsorizzazione che fa per te -</h2>
    <hr>

    <div class="row justify-content-center align-items-center">
        @foreach ($sponsoreds as $sponsored )
        <div class="col-4 text-center">
    
                <div class="column-title">
                <h3>{{$sponsored->name}}</h3>
                   <hr>
                </div>
                <div>
                   
                   <ul>
                       <li class="flex">
                           <span><i class="fa-regular fa-clock"></i></span> 
                           <span>{{$sponsored->duration == 1 ? '24': $sponsored->duration /60}} Ore</span>
                       </li>
                       <li class="flex">
                        <span><i class="fa-solid fa-money-bill-wave"></i></span> 
                        <strong>{{$sponsored->cost}}</strong>
                    </li>
                       <li class="flex">
                           <span><i class="fa-solid fa-eye"></i></span>
                            <span>Presenza in home page</span>
                       </li>
                       <li class="flex">
                           <span><i class="fa-solid fa-ranking-star"></i> </span>
                           <span>Appari tra i primi risultati della ricerca</span></li>
                       <li><a href="{{route('admin.doctors.paymentForm' , $sponsored->id)}}" class="btn btn-primary">Acquista ora!</a></li>
                
                   </ul>
                   <hr>
                </div>
        </div>
            
        @endforeach
    
    <div class="col-2 text-center pb-5">

        <a href="{{ route('admin.doctors.index') }}" class="btn btn-warning"><i
            class="fa-solid fa-arrow-rotate-left"></i> Indietro</a>
    </div>
</div>
</div>


</div>
</section>
@endsection
