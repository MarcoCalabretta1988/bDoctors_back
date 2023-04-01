<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    CREATE
    <a href="{{ route('dashboard')}}" class="btn btn-warning">Dashboard</a>
    <form action="{{route('admin.doctors.store')}}" method="POST" enctype="multipart/form-data">
        @include('includes.form')
    </form>
</body>
</html>