@extends('layouts.app')


@section('content')
<div class="container">

    <form action="{{route('admin.doctors.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container">
            {{-- adress --}}
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Indirizzo</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="inserisci l'indirizzo, o la struttura del tuo luogo di lavoro">
            </div>
            {{-- photo --}}
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Foto Profilo</label>
                <input type="file" class="form-control" id="photo" name="photo" placeholder="mandaci una tua foto">
            </div>
            {{-- phone --}}
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Numero di Recapito</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="il tuo numero di telefono">
            </div>
            {{-- curriculum --}}
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Curriculum</label>
                <input type="file" class="form-control" id="curriculum" name="curriculum" placeholder="inserisci una foto del tuo curriculum">
            </div>
        </div>
        <button class="btn btn-success">invia</button>
    </form>
</div>
@endsection