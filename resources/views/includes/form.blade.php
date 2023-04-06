@extends('layouts.app')


@section('content')
<div class="container">
    {{-- ERROR ALERT --}}
    @if ($errors->any())
        <div class="alert alert-danger my-3" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($doctor->exists)
        <form action="{{ route('admin.doctors.update', $doctor->id) }}" method="POST" enctype="multipart/form-data" novalidate>
            @method('PUT')
        @else
            {{-- form store --}}
            <form action="{{ route('admin.doctors.store') }}" method="POST" enctype="multipart/form-data" novalidate>
    @endif


        @csrf

        <div class="my-5 p-5 rounded border border-primary" id="form-board">
            {{-- adress --}}
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Indirizzo</label>
                <input type="text" required class="form-control @error('address') is-invalid @enderror" id="address" name="address"
                    value="{{ old('address', $doctor->address) }}"
                    placeholder="inserisci l'indirizzo, o la struttura del tuo luogo di lavoro">
                    @error('address')
                    <div class="invalid-feedback">{{ $message}}</div>
       
                 @enderror
            </div>
            {{-- photo --}}
            <div class="d-flex">
                <div class="col-5 me-4">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label ">Foto Profilo</label>
                        <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo"
                            placeholder="mandaci una tua foto" accept="image/*">
                            @error('photo')
                            <div class="invalid-feedback">{{ $message}}</div>
                  
                         @enderror
                    </div>
                </div>

                <div class="col-3" id="img-prev"></div>
            </div>
            {{-- curriculum --}}
            <div class="col-5">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label ">Curriculum</label>
                    <input type="file" class="form-control @error('curriculum') is-invalid @enderror" id="curriculum" name="curriculum"
                        placeholder="inserisci una foto del tuo curriculum" accept="image/*">
                        @error('curriculum')
                        <div class="invalid-feedback">{{ $message}}</div>
             
                     @enderror
                </div>
            </div>
            {{-- phone --}}
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Numero di Recapito</label>
                <input type="text" class="form-control  @error('phone') is-invalid @enderror" id="phone" name="phone"
                    value="{{ old('phone', $doctor->phone) }}" placeholder="il tuo numero di telefono">
                    @error('phone')
                    <div class="invalid-feedback">{{ $message}}</div>
             
                 @enderror
            </div>
            <div class="d-flex">
                @foreach ($specializations as $specialization)
                    <label for="{{ $specialization->name }}">{{ $specialization->name }}</label>
                    <input type="checkbox" class="form-check-input mx-3 @error('specialization') is-invalid @enderror" name="specialization[]"
                        id="{{ $specialization->id }}" @checked(in_array($specialization->id, $doctor_spec)) value="{{ $specialization->id }}"
                        class="me-4">
                        @error('specialization')
                        <div class="invalid-feedback">{{ $message}}</div>
                     @enderror
                @endforeach
            </div>
            <div class="text-end mt-3">
                <button type="submit" class="btn btn-success me-2"><i class="fa-solid fa-floppy-disk"></i> Salva</button>

                <a href="{{ route('admin.doctors.index') }}" class="btn btn-warning"><i class="fa-solid fa-arrow-rotate-left"></i> Indietro</a>
            </div>
        </div>
    </div>

    </form>
    </div>
@endsection

@section('scripts')
<script>

const placeHolder = 'https://media.istockphoto.com/id/1357365823/vector/default-image-icon-vector-missing-picture-page-for-website-design-or-mobile-app-no-photo.jpg?s=612x612&w=0&k=20&c=PM_optEhHBTZkuJQLlCjLz-v3zzxp-1mpNQZsdjrbns=';
const imageInput = document.getElementById('photo');
const imagePreview = document.getElementById('img-prev');
console.log(imageInput);
imageInput.addEventListener('change', () => {
    
    if (imageInput.files && imageInput.files[0]) {
        const reader = new FileReader();
        reader.readAsDataURL(imageInput.files[0]);
        reader.onload = e => {
            imagePreview.src = e.target.result;
        }
    }
    else imagePreview.src = placeHolder;
})
</script>
@endsection
