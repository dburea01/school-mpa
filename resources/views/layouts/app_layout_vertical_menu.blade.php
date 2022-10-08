<!DOCTYPE html>
<html lang="zxx">

<head>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="icon" href="img/carre_vert_48_48.png" type="image/png">
    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <title>Vertical Responsive Menu - Demonstration</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500' rel='stylesheet'>
        <link href='normalize.css/normalize.css' rel='stylesheet'>
        <link href='fontawesome/css/font-awesome.min.css' rel='stylesheet'>
        <link href="vertical-responsive-menu.min.css" rel="stylesheet">
        <link href="demo.css" rel="stylesheet">
    </head>

<body>

    <header class="header clearfix">
        <button type="button" id="toggleMenu" class="toggle_menu">
            <i class="fa fa-bars"></i>
        </button>
        <h1>Vertical Responsive Menu</h1>
    </header>

    <nav class="vertical_nav">

        <ul id="js-menu" class="menu">

            <li class="menu--item  menu--item__has_sub_menu">

                <label class="menu--link" title="Item 1">
                    <i class="menu--icon  fa fa-fw fa-user"></i>
                    <span class="menu--label">Item 1</span>
                </label>

                <ul class="sub_menu">
                    <li class="sub_menu--item">
                        <a href="#" class="sub_menu--link sub_menu--link__active">Submenu</a>
                    </li>
                    <li class="sub_menu--item">
                        <a href="#" class="sub_menu--link">Submenu</a>
                    </li>
                    <li class="sub_menu--item">
                        <a href="#" class="sub_menu--link">Submenu</a>
                    </li>
                </ul>
            </li>

            <li class="menu--item">
                <a href="#" class="menu--link" title="Item 2">
                    <i class="menu--icon  fa fa-fw fa-briefcase"></i>
                    <span class="menu--label">Item 2</span>
                </a>
            </li>

            <li class="menu--item">
                <a href="#" class="menu--link" title="Item 3">
                    <i class="menu--icon  fa fa-fw fa-cog"></i>
                    <span class="menu--label">Item 3</span>
                </a>
            </li>

            <li class="menu--item  menu--item__has_sub_menu">

                <label class="menu--link" title="Item 4">
                    <i class="menu--icon  fa fa-fw fa-database"></i>
                    <span class="menu--label">Item 4</span>
                </label>

                <ul class="sub_menu">
                    <li class="sub_menu--item">
                        <a href="#" class="sub_menu--link">Submenu</a>
                    </li>
                    <li class="sub_menu--item">
                        <a href="#" class="sub_menu--link">Submenu</a>
                    </li>
                    <li class="sub_menu--item">
                        <a href="#" class="sub_menu--link">Submenu</a>
                    </li>
                </ul>
            </li>

            <li class="menu--item">
                <a href="#" class="menu--link" title="Item 5">
                    <i class="menu--icon  fa fa-fw fa-globe"></i>
                    <span class="menu--label">Item 5</span>
                </a>
            </li>

        </ul>

        <button id="collapse_menu" class="collapse_menu">
            <i class="collapse_menu--icon  fa fa-fw"></i>
            <span class="collapse_menu--label">Recolher menu</span>
        </button>

    </nav>


    <div class="wrapper">

        <section>
            @yield('content')
        </section>

    </div>

    <script src="vertical-responsive-menu.min.js"></script>

</body>

</html>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

<link rel="stylesheet" href="css/style.css">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="template admin">
<title>template dom</title>
</head>

<body class="container">
    @yield('content')
</body>

</html>
