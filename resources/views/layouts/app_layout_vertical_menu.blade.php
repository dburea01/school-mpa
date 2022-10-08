<!DOCTYPE html>
<html lang="zxx">

<head>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="icon" href="img/carre_vert_48_48.png" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">


    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="template admin">
    <title>template dom</title>
    @vite(['resources/css/style.css', 'resources/js/burger.js'])
</head>

<body>

    <div class="wrapper">
        <div class="section">
            <div class="top_navbar">
                <div class="hamburger">
                    <a href="#" aria-label="hamburger button"><i class="bi bi-list"></i></a>
                </div>
                <span class="text-truncate navbartitle">
                    {{ isset(Auth::user()->school) ? Auth::user()->school->name : 'no school' }} -
                    {{ isset($currentPeriod->name) ? $currentPeriod->name : 'no current period' }}
                </span>
                <form style="display: inline" action="http://example.com/" method="get">


                    <div class="dropdown">
                        <button class="btn dropdown-toggle btn-sm dropdown-flag" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="img/flag_en.png" alt="en">
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#"><img src="img/flag_en.png" alt="en" width="20"
                                        height="13"> English</a></li>
                            <li><a class="dropdown-item" href="#"><img src="img/flag_fr.png" alt="fr" width="20"
                                        height="13"> Français</a></li>
                        </ul>
                    </div>


                </form>
            </div>


            <div class="container">
                @yield('content')
            </div>

            <div class="bottom_navbar">

                &copy;Dom | About | CGU

            </div>
        </div>
        <x-vertical-menu />


    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>



</body>

</html>
