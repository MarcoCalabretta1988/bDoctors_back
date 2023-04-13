@extends('layouts.app')
@section('content')
    <div class="login-bg pt-5">
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
                <div class="col-7">
               
                    <div class="col-md-4">
                        <div class="title-wrapper d-flex justify-content-between">
                            <label for="validationDefault01" class="form-label">Numero carta</label>
                            <div class="card-logo-wrapper d-flex">
                                {{-- LOGHI CARTE --}}
                                <div class="card-int">
                                    <img src="{{url('/img/MS-logo.png')}}" class="img-fluid" alt="circuit logo">
                                </div>
                                <div class="card-int">
                                    <img src="{{url('/img/visa-logo.png')}}" class="img-fluid" alt="circuit logo">
                                </div>
                                <div class="card-int">
                                    <img src="{{'/img/AME-logo.png'}}" class="img-fluid" alt="circuit logo">
                                </div>
                            </div>
                        </div>
                        <input type="text" class="form-control" placeholder="1234 5678 9102 3456" required>
                    </div>
                    {{-- SCADENZA --}}
                    <div class="col-md-4">
                        <label for="validationDefault02" class="form-label">Data di scadenza</label>
                        <input type="date" class="form-control" required>
                    </div>
                    {{-- CVv --}}
                    <div class="py-4 d-flex col-8">
                        <div class="col-md-3 me-5">
                            <label for="validationDefault03" class="form-label">CVV</label>
                            <input type="number" placeholder="123" class="form-control" required>
                        </div>
                        <div class="col-1 cvv">
                            <img src="{{url('/img/cvv-icon-27.jpg')}}" class="img-fluid " alt="cvv illustration">
                        </div>
                    </div>
                    {{-- TERMINI E CONDIZIONI --}}
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                            <label class="form-check-label" for="invalidCheck2">
                                Agree to terms and conditions
                            </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <form action="{{route('admin.orders.payment')}}" method="POST" class="row g-3 py-5" novalidate>
                            @csrf
                            <input type="hidden" id="custId" name="token" value="fake-valid-nonce">
                            <input type="hidden" id="custId" name="sponsored" value="{{$sponsorization->id}}">
                            <button class="btn btn-primary" type="submit">Procedi al pagamento</button>
                        </form>
                    </div>
                </div>
                {{-- NUMERO CARTA --}}

                <div class="col-5">
                   <h3 class="text-center py-3">Riepilogo ordine</h3>
                   <ul class="list-group list-group-flush text-center">
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
@endsection
