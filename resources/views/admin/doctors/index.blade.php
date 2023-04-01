@extends('layouts.app')
@section('content')

<section id='profile'>
    <div class="container">
        <div class="profile-box d-flex justify-content-center p-5">
            <h1>Benvenuto {{ucfirst($user)}}</h1>
           <div class="row">
            <div class="col-6">
                <img src="https://static.vecteezy.com/system/resources/thumbnails/007/986/570/small/woman-doctor-icon-doctor-woman-with-stereoscopic-glyph-isolated-blue-background-vector.jpg" alt="foto">

            </div>
           </div>
        </div>

    </div>
</section>
@endsection