@extends('layouts.app')
@section('content')
    <div class="login-bg">
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

        <div class="container bg-light welcome-box">

            <form action="{{ route('admin.doctors.updatepro', $doctor->id) }}" method="POST" class="row g-3 py-5" novalidate>
                @method('PUT')
                @csrf

                <div class="col-md-4">
                    <label for="validationDefault01" class="form-label">Numero carta</label>
                    <input type="text" class="form-control" placeholder="1234 5678 9102 3456" required>
                </div>
                <div class="col-md-4">
                    <label for="validationDefault02" class="form-label">Data di scadenza</label>
                    <input type="date" class="form-control" required>
                </div>

                <div class="col-md-3">
                    <label for="validationDefault03" class="form-label">CVC</label>
                    <input type="number" placeholder="123" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label for="validationDefault03" class="form-label">Scegli piano</label>
                    <select class="form-select" id="validationDefault04" name="sponsored_ad">
                        <option value="" selected>Scegli un piano di sponsorizazione</option>
                        @foreach ($sponsoreds as $sponsored)
                            <option value="{{ $sponsored->id }}">{{ $sponsored->name }} costo:
                                {{ $sponsored->cost }}€</option>
                        @endforeach

                    </select>
                </div>

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
