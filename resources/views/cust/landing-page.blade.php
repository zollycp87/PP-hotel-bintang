<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p>{{ Session::get('success') }}</p>
    <form action="/logout" method="post">
        @csrf
        <button type="submit" class="dropdown-item d-flex align-items-center">
            <i class="bi bi-box-arrow-right"></i>
            <span>Keluar</span>
        </button>
    </form>
</body>
</html>