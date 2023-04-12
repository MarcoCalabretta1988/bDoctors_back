@extends('layouts.app')
@section ('title','Sponsorizzate')
@section('content')
<section id="plans" >
    <div class="container">
    <h2 class="text-center py-5 t-shadow">- Trova il piano di sponsorizzazione che fa per te -</h2>
    <hr>

    <div class="row justify-content-center align-items-center">
    <div class="col-4 text-center">

            <div class="column-title">
            <h3>Bronze</h3>
               <hr>
            </div>
            <div>
               
               <ul>
                   <li class="flex">
                       <span><i class="fa-regular fa-clock"></i></span> 
                       <span>24 Ore</span>
                   </li>
                   <li class="flex">
                    <span><i class="fa-solid fa-money-bill-wave"></i></span> 
                    <strong>€ 2,99</strong>
                </li>
                   <li class="flex">
                       <span><i class="fa-solid fa-eye"></i></span>
                        <span>Presenza in home page</span>
                   </li>
                   <li class="flex">
                       <span><i class="fa-solid fa-ranking-star"></i> </span>
                       <span>Appari tra i primi risultati della ricerca</span></li>
                   <li><a href="{{route('admin.doctors.paymentForm' , 1)}}" class="btn btn-primary">Acquista ora!</a></li>
            
               </ul>
               <hr>
            </div>
    </div>
    <div class="col-4  text-center">
        <div class="column-title">
            <h3>Medium</h3>
               <hr>
            </div>
            <div>
               
               <ul>
                   <li class="flex">
                       <span><i class="fa-regular fa-clock"></i></span> 
                       <span>72 Ore</span>
                   </li>
                   <li class="flex">
                    <span><i class="fa-solid fa-money-bill-wave"></i></span> 
                    <strong>€ 5,99</strong>
                </li>
                   <li class="flex">
                       <span><i class="fa-solid fa-eye"></i></span>
                        <span>Presenza in home page</span>
                   </li>
                   <li class="flex">
                       <span><i class="fa-solid fa-ranking-star"></i> </span>
                       <span>Appari tra i primi risultati della ricerca</span></li>
                   <li><a href="{{route('admin.doctors.paymentForm' , 2)}}" class="btn btn-primary">Acquista ora!</a></li>
            
               </ul>
               <hr>
            </div>
    </div>

    <div class="col-4  text-center"> 
        <div class="column-title">
            <h3>Top</h3>
               <hr>
            </div>
            <div>
               
               <ul>
                   <li class="flex">
                       <span><i class="fa-regular fa-clock"></i></span> 
                       <span>144 Ore</span>
                   </li>
                   <li class="flex">
                    <span><i class="fa-solid fa-money-bill-wave"></i></span> 
                    <strong>€ 9,99</strong>
                </li>
                   <li class="flex">
                       <span><i class="fa-solid fa-eye"></i></span>
                        <span>Presenza in home page</span>
                   </li>
                   <li class="flex">
                       <span><i class="fa-solid fa-ranking-star"></i> </span>
                       <span>Appari tra i primi risultati della ricerca</span></li>
                   <li><a href="{{route('admin.doctors.paymentForm' , 3)}}" class="btn btn-primary">Acquista ora!</a></li>
            
               </ul>
               <hr>
            </div>
    </div>
    <div class="col-2 text-center pb-5">

        <a href="{{ route('admin.doctors.index') }}" class="btn btn-warning"><i
            class="fa-solid fa-arrow-rotate-left"></i> Indietro</a>
    </div>
</div>
</div>


</div>
</section>
@endsection
