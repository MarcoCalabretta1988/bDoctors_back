@extends('layouts.app')


@section('content')
<section id="form">


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
            <form action="{{ route('admin.doctors.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                <h1 class="text-center py-5 p-blu t-shadow">Modifica il tuo profilo</h1>
            @else
                {{-- form store --}}
                <form action="{{ route('admin.doctors.store') }}" method="POST" enctype="multipart/form-data">
                    <h1 class="text-center py-5 p-blu t-shadow">Crea il tuo profilo</h1>
        @endif


        @csrf

        <div class=" p-5 rounded border border-primary" id="form-board">
            <div class="row">
                {{-- adress --}}
                <div class="col-5 mb-3">
                    <label for="address" class="form-label">Indirizzo</label>
                    <input type="text" required class="form-control @error('address') is-invalid @enderror"
                        id="address" name="address" value="{{ old('address', $doctor->address) }}"
                        placeholder="inserisci l'indirizzo, o la struttura del tuo luogo di lavoro">
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                {{-- CITY --}}
                <div class="col-3">
                    <label for="city" class="form-label">Città</label>
                    <input type="text" required class="form-control @error('city') is-invalid @enderror" id="city"
                        name="city" value="{{ old('city', $doctor->city) }}">
                    @error('city')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            {{-- photo --}}
            <div class="row">
                <div class="col-7 ">
                    <div class="mb-3">
                        <label for="photo" class="form-label ">Foto Profilo</label>
                        <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo"
                            name="photo" placeholder="mandaci una tua foto" accept="image/*">
                        @error('photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                {{-- PHOTO PREVIEW --}}
                <div class="col-2">
                    <label for="img-prev" class="form-label ">Anteprima foto:</label>
                    <img src="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : 'https://media.istockphoto.com/id/1357365823/vector/default-image-icon-vector-missing-picture-page-for-website-design-or-mobile-app-no-photo.jpg?s=612x612&w=0&k=20&c=PM_optEhHBTZkuJQLlCjLz-v3zzxp-1mpNQZsdjrbns=' }}"
                        alt="{{ old('name', $doctor->name) }}" class="img-fluid" id="img-prev" style="max-height: 150px">
                </div>
            </div>

            {{-- curriculum --}}
            <div class="row my-2">

                <div class="col-7">
                    <div class="mb-3">
                        <label for="curriculum" class="form-label ">Curriculum</label>
                        <input type="file" class="form-control @error('curriculum') is-invalid @enderror" id="curriculum"
                            name="curriculum" placeholder="Carica un curriculum"
                            accept="application/pdf,application/vnd.ms-excel">
                        @error('curriculum')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>

                </div>
                {{-- CURRICULUM PREVIEW --}}
                {{-- <div class="col-2">
                    <label for="curriculum-prev" class="form-label ">Anteprima curriculum:</label>
                    <img src="{{ $doctor->curriculum ? asset('storage/' . $doctor->curriculum) : 'https://media.istockphoto.com/id/1357365823/vector/default-image-icon-vector-missing-picture-page-for-website-design-or-mobile-app-no-photo.jpg?s=612x612&w=0&k=20&c=PM_optEhHBTZkuJQLlCjLz-v3zzxp-1mpNQZsdjrbns=' }}"
                        alt="{{ old('name', $doctor->name) }}" class="img-fluid" id="curriculum-prev"
                        style="max-height: 150px">
                </div> --}}

                {{-- sponsored select --}}
                {{-- @if ($doctor->exists)
                    <div class="col-5">

                        <select class="form-select" name="sponsored_ad">
                            <option value="" selected>Scegli un piano di sponsorizazione</option>
                            @foreach ($sponsoreds as $sponsored)
                                <option value="{{ $sponsored->id }}">{{ $sponsored->name }} costo:
                                    {{ $sponsored->cost }}€</option>
                            @endforeach

                        </select>
                    </div>
                @endif --}}
            </div>


            {{-- phone --}}
            <div class=" col-3 mb-3">
                <label for="phone" class="form-label">Numero di Recapito</label>
                <input type="text" class="form-control  @error('phone') is-invalid @enderror" id="phone"
                    name="phone" value="{{ old('phone', $doctor->phone) }}" placeholder="il tuo numero di telefono">
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            {{-- Specialization --}}
            <h3>Specializzazioni:</h3>
            <div class="d-flex flex-wrap">
                @foreach ($specializations as $specialization)
                    <label for="{{ $specialization->name }}">{{ $specialization->name }}</label>
                    <input type="checkbox" class="form-check-input mx-3 @error('specialization') is-invalid @enderror"
                        name="specialization[]" id="{{ $specialization->id }}" @checked(in_array($specialization->id, $doctor_spec))
                        value="{{ $specialization->id }}" class="me-4">
                    @error('specialization')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                @endforeach
            </div>



            <div class="text-end mt-3">
                <button type="submit" class="btn btn-success me-2"><i class="fa-solid fa-floppy-disk"></i> Salva</button>
                @if ($doctor->exists)
                    <a href="{{ route('admin.doctors.index') }}" class="btn btn-warning"><i
                            class="fa-solid fa-arrow-rotate-left"></i> Indietro</a>
                @endif
            </div>
        </div>
    </div>

    </form>
    </div>
</section>
@endsection

@section('scripts')
    <script>
        const placeHolder =
            'https://media.istockphoto.com/id/1357365823/vector/default-image-icon-vector-missing-picture-page-for-website-design-or-mobile-app-no-photo.jpg?s=612x612&w=0&k=20&c=PM_optEhHBTZkuJQLlCjLz-v3zzxp-1mpNQZsdjrbns=';
        const imageInput = document.getElementById('photo');
        const curriculumInput = document.getElementById('curriculum');
        const imagePreview = document.getElementById('img-prev');
        const curriculumPreview = document.getElementById('curriculum-prev');

        imageInput.addEventListener('change', () => {

            if (imageInput.files && imageInput.files[0]) {
                const reader = new FileReader();
                reader.readAsDataURL(imageInput.files[0]);
                reader.onload = e => {
                    imagePreview.src = e.target.result;
                }
            } else imagePreview.src = placeHolder;
        })

        curriculumInput.addEventListener('change', () => {

            if (curriculumInput.files && curriculumInput.files[0]) {
                const reader = new FileReader();
                reader.readAsDataURL(curriculumInput.files[0]);
                reader.onload = e => {
                    curriculumPreview.src = e.target.result;
                }
            } else curriculumPreview.src = placeHolder;
        })
    </script>
@endsection
