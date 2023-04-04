<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div class="bg-img">

        <form action="{{ route('admin.doctors.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @include('includes.form')
            @section('my-button')
                <button class="btn btn-primary">Aggiorna</button>
            @endsection
        </form>
<<<<<<< HEAD
        <a href="{{ route('dashboard') }}" class="btn btn-warning">Dashboard</a>
=======
>>>>>>> 2ce34a6fdcaded0c78f0ff9e992112332dd59aa7
    </div>
</body>

</html>
