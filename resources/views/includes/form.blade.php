@extends('layouts.app')


@section('content')
    <div class="container">
        @csrf
        <div class="my-5 bg-light p-5 rounded border border-primary">
            {{-- adress --}}
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Indirizzo</label>
                <input type="text" required class="form-control" id="address" name="address"
                    placeholder="inserisci l'indirizzo, o la struttura del tuo luogo di lavoro"
                    value="{{ old('address', $doctor->address) }}">
            </div>
            {{-- photo --}}
            <div class="d-flex">
                <div class="col-5 me-4">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Foto Profilo</label>
                        <input type="file" class="form-control" id="photo" name="photo"
                            placeholder="mandaci una tua foto" value="{{ old('photo', $doctor->photo) }}">
                    </div>
                </div>
                {{-- curriculum --}}
                <div class="col-5">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Curriculum</label>
                        <input type="file" class="form-control" id="curriculum" name="curriculum"
                            placeholder="inserisci una foto del tuo curriculum">
                    </div>
                </div>
            </div>
            {{-- phone --}}
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Numero di Recapito</label>
                <input type="text" class="form-control" id="phone" name="phone"
                    placeholder="il tuo numero di telefono" value="{{ old('phone', $doctor->phone) }}">
            </div>
            <div class="d-flex">
                @foreach ($specializations as $specialization)
                    <label for="{{ $specialization->name }}">{{ $specialization->name }}</label>
                    <input type="checkbox" name="specialization[]" @checked(in_array($specialization->id, old('specialization', $doctor_specializations ?? [])))
                        id="{{ $specialization->id }}" value="{{ $specialization->id }}" class="me-4">
                @endforeach
            </div>
            <div class="text-center my-2">
                <button class="btn btn-primary">Iscriviti</button>
            </div>
        </div>

    </div>
@endsection
