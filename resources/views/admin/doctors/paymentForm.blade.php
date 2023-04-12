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

            <form action="{{ route('admin.doctors.updatepro', $doctor->id) }}" id="payment-form" method="POST" class="row g-3 py-5" novalidate>
                @csrf
                <div id="dropin-container"></div>
                <input type="hidden" id="nonce" name="payment_method_nonce"/>
                {{-- NUMERO CARTA --}}
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
                <div class="py-4 d-flex">
                    <div class="col-md-3 me-5">
                        <label for="validationDefault03" class="form-label">CVV</label>
                        <input type="number" placeholder="123" class="form-control" required>
                    </div>
                    <div class="col-3 cvv">
                        <img src="{{url('/img/cvv-icon-27.jpg')}}" class="img-fluid " alt="cvv illustration">
                    </div>
                </div>
                {{-- PIANO --}}
                <div class="col-md-3">
                    <label for="validationDefault03" class="form-label">Scegli un piano</label>
                    <select class="form-select" id="validationDefault04" name="sponsored_ad">
                        <option value="" selected>---</option>
                        @foreach ($sponsoreds as $sponsored)
                            <option value="{{ $sponsored->id }}">{{ $sponsored->name }} costo:
                                {{ $sponsored->cost }}€</option>
                        @endforeach

                    </select>
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
                    <button class="btn btn-primary" type="submit">Procedi al pagamento</button>
                </div>

            </form>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    //! script per pagamento -daniele

    const form = document.getElementById('payment-form');

    braintree.dropin.create({
    authorization: 'CLIENT_AUTHORIZATION',
    container: '#dropin-container'
    }, 
    (error, dropinInstance) => {
        if (error) console.error(error);

        form.addEventListener('submit', event => {
            event.preventDefault();

            dropinInstance.requestPaymentMethod((error, payload) => {
                if (error) console.error(error);
                document.getElementById('nonce').value = payload.nonce;
                form.submit();
            });
        });
    });
</script>
@endsection