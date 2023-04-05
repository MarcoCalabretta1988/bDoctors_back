@extends('layouts.app')


@section('content')
    {{-- ERROR ALERT --}}
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($doctor->exists)
        <form action="{{ route('admin.doctors.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
        @else
            {{-- form store --}}
            <form action="{{ route('admin.doctors.store') }}" method="POST" enctype="multipart/form-data">
    @endif


    <div class="container">
        @csrf

        <div class="my-5 bg-light p-5 rounded border border-primary">
            {{-- adress --}}
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Indirizzo</label>
                <input type="text" required class="form-control" id="address" name="address"
                    value="{{ old('address', $doctor->address) }}"
                    placeholder="inserisci l'indirizzo, o la struttura del tuo luogo di lavoro">
            </div>
            {{-- photo --}}
            <div class="d-flex">
                <div class="col-5 me-4">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Foto Profilo</label>
                        <input type="file" class="form-control" id="photo" name="photo"
                            placeholder="mandaci una tua foto" accept="image/*">
                    </div>
                </div>
            </div>
            {{-- curriculum --}}
            <div class="col-5">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Curriculum</label>
                    <input type="file" class="form-control" id="curriculum" name="curriculum"
                        placeholder="inserisci una foto del tuo curriculum" accept="image/*">
                </div>
            </div>
            {{-- phone --}}
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Numero di Recapito</label>
                <input type="text" class="form-control" id="phone" name="phone"
                    value="{{ old('phone', $doctor->phone) }}" placeholder="il tuo numero di telefono">
            </div>
            <div class="d-flex">
                @foreach ($specializations as $specialization)
                    <label for="{{ $specialization->name }}">{{ $specialization->name }}</label>
                    <input type="checkbox" class="form-check-input me-3" name="specialization[]"
                        id="{{ $specialization->id }}" @checked(in_array($specialization->id, $doctor_spec)) value="{{ $specialization->id }}"
                        class="me-4">
                @endforeach
            </div>
            <div class="text-end mt-3">
                <button type="submit" class="btn btn-success">salva</button>

                <a href="{{ route('admin.doctors.index') }}" class="btn btn-warning">Indietro</a>
            </div>
        </div>
    </div>

    </form>
    </div>
@endsection
