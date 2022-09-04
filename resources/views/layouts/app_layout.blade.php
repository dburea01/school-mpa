<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="template admin bootstrap">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">

    <title>Dashboard Template · essai dom</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="icon" href="img/carre_vert_48_48.png" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">


    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>

<body class="d-flex flex-column h-100">

    <!-- menu -->
    <x-horizontal-menu />


    <!-- Begin page content -->
    <main class="flex-shrink-0">
        <div class="container" id="container">
            @yield('content')
        </div>
    </main>

    <footer class=" footer mt-auto py-3">
        <div class="container">
            &copy;Dom {{ now()->year }} | About | CGU
        </div>
    </footer>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>

    <script src="https://unpkg.com/vue@next"></script>


    @yield('extra_js')



</body>

</html>