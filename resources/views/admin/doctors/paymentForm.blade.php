@extends('layouts.app')
@section('content')
<section class="login-bg">


    <div class="pt-5 container">
        
        {{-- error bag --}}
        @if ($errors->any())
            <div class="alert alert-danger my-3" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="container bg-light welcome-box rounded">

            <div class="row">
                <div class="col-5 px-3 ">
                    <form action="{{route('admin.orders.payment')}}" method="POST" class="mt-5 p-2 border border-primary rounded">
                        @csrf
                    <div class="d-flex justify-content-between align-item-center p-5">
                        <h3><i class="fa-regular fa-credit-card"></i> Paga con carta </h3>
                        <div>
                            <img src="{{asset('img/visa-logo.png')}}" alt=""  style="height: 30px">
                            <img src="{{asset('img/AME-logo.png')}}" alt=""   style="height: 30px">
                            <img src="{{asset('img/MS-logo.png')}}" alt=""  style="height: 30px">
                        </div>
                    </div>
                     {{-- Numero Carta --}}
                       <label for="validationDefault01" class="form-label">Numero carta</label>
                        <input type="text" class="form-control" placeholder="1234 5678 9102 3456" name="card" required>

                    {{-- SCADENZA E CVV --}}
                    <div class="d-flex justify-content-between py-3">
                        <div>
                            <label for="validationDefault02" class="form-label">Data di scadenza</label>
                            <input type="date" class="form-control" name="expired" required>

                        </div>
                        <div>

                            <label for="validationDefault03" class="form-label">CVV</label>
                            <input type="number" placeholder="123" class="form-control" name="cvv" min="100" max="999" required>
                        </div>
                    </div>
                   {{-- Condition --}}
                   
                    <div class="form-check">
                        <label class="form-check-label" for="invalidCheck2">
                            Accetto termini e condizioni
                        </label>
                        <input class="form-check-input" type="checkbox" value="true" id="invalidCheck2" required>
                    </div>
              <div class="d-flex justify-content-center">

                  <input type="hidden" id="custId" name="token" value="fake-valid-nonce">
                  <input type="hidden" id="custId" name="sponsored" value="{{$sponsorization->id}}">
                  <button class="btn btn-primary mt-3" type="submit">Procedi al pagamento</button>
                  
              </div>
                    </form>
                </div>

                <div class="col-7 my-5 p-3">
                   <h3 class="text-center py-3">Riepilogo ordine</h3>
                   <ul class="list-group list-group-flush">
                    <li class="list-group-item">Nome: <strong class="ms-5">{{$sponsorization->name}}</strong></li>
                    <li class="list-group-item">Durata: <strong class="ms-5">{{$sponsorization->duration}} ore</strong></li>
                    <li class="list-group-item">Costo: <strong class="ms-5">{{$sponsorization->cost}} €</strong></li>
                   
                  </ul>
                </div>
        </div>
        <div class="d-flex justify-content-end py-3">
       
            <a href="{{ route('admin.doctors.sponsored') }}" class="btn btn-warning"><i class="fa-solid fa-arrow-rotate-left"></i>Torna indietro</a>
        </div>
        </div>
    </div>
</section>
@endsection
