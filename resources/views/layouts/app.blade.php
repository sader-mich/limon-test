<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>Trazabilidad del Limón</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=3.0, user-scalable=1" />
    <meta name="description" content="Portal ciudadano del Gobierno del Estado de Michoacán">
    <meta name="keywords"
        content="gobierno, michoacan, portal, sitio web, dependencia michoacan, cgcs, comunicacion social">
    <meta name="author" content="Coordinación General de Comunicación Social">
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7, IE=9" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="Michoacán">
    <meta name="twitter:card" value="summary">
    <meta property="og:title" content="TÍTULO DE LA PÁGINA" />
    <meta property="og:image" content="http://10.8.30.211/limon/favicon.ico" />
    <meta property="og:description" content="DESCRIPCIÓN DE LA PÁGINA" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- HTML-QRCODE 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js" integrity="sha512-r6rDA7W6ZeQhvl8S7yRVQUKVHdexq+GAlNkNNqVC7YyIV+NwqCTJe2hDWCiffTyRNOeGEzRRJ9ifvRm/HCzGYg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    -->
    <!-- Bootstrap -->
    <link href="https://michoacan.gob.mx/cdn/css/bootstrap.min.css" rel="stylesheet">
    <!-- JQuery JS -->
    <script type="text/javascript" src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script type="text/javascript" src="{{ asset('js/bootstrap.js') }}"></script>
    <!-- Search JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>
    <!-- DataTables JS -->
    <script type="text/javascript" src="{{ asset('js/pdfmake.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/vfs_fonts.js') }}"></script>
    <script
        src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.1/af-2.7.0/b-3.0.0/b-colvis-3.0.0/b-html5-3.0.0/b-print-3.0.0/fh-4.0.0/r-3.0.0/rg-1.5.0/sb-1.7.0/sl-2.0.0/datatables.min.js">
    </script>
    <!-- Scripts 
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
    -->
    <!-- Form Validations JS -->
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    <!-- Contador JS -->
    <script src="{{ asset('js/jquery.flipper-responsive.js') }}"></script>
    <!-- FAVICON -->
    <link rel="shortcut icon" href="http://10.8.30.211/limon/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="http://10.8.30.211/limon/favicon.ico" />
    <!-- Hoja de Estilos -->
    <link rel="stylesheet" href="{{ asset('css/estilosGob.css') }}">
    <!-- <link href="https://michoacan.gob.mx/cdn/css/dependencias.css" rel="stylesheet"> 
    <link href="https://michoacan.gob.mx/cdn/css/estilos.css" rel="stylesheet">
    -->
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">
    <!-- Accesibility CSS -->
    <link href="{{ asset('css/accesibility.css') }}" rel="stylesheet">
    <!-- Iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Search -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" />
    <!-- DataTables CSS-->
    <link
        href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.1/af-2.7.0/b-3.0.0/b-colvis-3.0.0/b-html5-3.0.0/b-print-3.0.0/fh-4.0.0/r-3.0.0/rg-1.5.0/sb-1.7.0/sl-2.0.0/datatables.min.css"
        rel="stylesheet">
    @yield('css')
</head>

<body class="body-wrapper">

    <div id="app">
        <nav class="navbar main-nav fixed-top">
            <div class="container-fluid">
                <div class="navbar-header" style="margin-left: 2rem">
                    <button class="navbar-toggler collapsed" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#sidebar" aria-controls="sidebar">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand" href="{{ route('home') }}" style="margin-left: 2rem">
                        <img src="https://michoacan.gob.mx/cdn/img/logo.svg" height="85px;" alt="logo">
                    </a>
                </div>
                <div class="d-flex">
                    <ul class="navbar-nav" style="display: contents;">
                        @if(Auth::guard('web')->check())
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @if(Auth::guard('web')->check())
                                        {{ Auth::guard('web')->user()->name }}
                                    @endif
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                        Cerrar sesión
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @else
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('documentos.preregistro') }}">{{ __('Pre Registro') }}</a>
                                </li>
                            @endif
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.facebook.com/AgriculturaMich/" target="_blank"><i
                                    class="fab fa-facebook-f"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://twitter.com/SaderMich" target="_blank"><i
                                    class="fab fa-twitter"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
            <nav class="acc-toolbar" role="navigation" style="top: 106px;">

            <div class="acc-toolbar-toggle">
                <a class="acc-toolbar-toggle-link">
                    <img src="{{ url('logos/accesibility.svg')}}" width="30px">
                </a>
            </div>
            <div class="acc-toolbar-overlay">
                <div>
                    <p class="acc-toolbar-title">Herramientas de Accesibilidad</p>
                    <ul class="acc-toolbar-items">
                        <li class="acc-toolbar-list" id="increaseTextSize">
                            <span class="acc-toolbar-icons">
                                <em class="fas fa-search-plus"></em>
                            </span>
                            <span class="acc-toolbar-text">Aumentar tamaño texto</span>
                        </li>
                        <li class="acc-toolbar-list" id="decreaseTextSize">
                            <span class="acc-toolbar-icons">
                                <em class="fas fa-search-minus"></em>
                            </span>
                            <span class="acc-toolbar-text">Reducir tamaño texto</span>
                        </li>
                        <li class="acc-toolbar-list" id="grayscale">
                            <span class="acc-toolbar-icons">
                                <em class="fas fa-barcode"></em>
                            </span>
                            <span class="acc-toolbar-text">Escala de grises</span>
                        </li>
                        <li class="acc-toolbar-list" id="highContrast">
                            <span class="acc-toolbar-icons">
                                <em class="fas fa-adjust"></em>
                            </span>
                            <span class="acc-toolbar-text">Alto contraste</span>
                        </li>
                        <li class="acc-toolbar-list" id="negativeContrast">
                            <span class="acc-toolbar-icons">
                                <em class="far fa-eye"></em>
                            </span>
                            <span class="acc-toolbar-text">Negativo</span>
                        </li>
                        <li class="acc-toolbar-list" id="lightBackground">
                            <span class="acc-toolbar-icons">
                                <em class="far fa-lightbulb"></em>
                            </span>
                            <span class="acc-toolbar-text">Fondo de titulo claro</span>
                        </li>
                        <li class="acc-toolbar-list" id="underlineLinks">
                            <span class="acc-toolbar-icons">
                                <em class="fas fa-link"></em>
                            </span>
                            <span class="acc-toolbar-text">Subrayar enlaces</span>
                        </li>
                        <li class="acc-toolbar-list" id="readabilityFont">
                            <span class="acc-toolbar-icons">
                                <em class="fas fa-font"></em>
                            </span>
                            <span class="acc-toolbar-text">Fuente de lectura</span>
                        </li>
                        <li class="acc-toolbar-list" id="resetAccessibility">
                            <span class="acc-toolbar-icons">
                                <em class="fas fa-redo"></em>
                            </span>
                            <span class="acc-toolbar-text">Reset</span>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Barra lateral -->
        @if(Auth::guard('web')->check())
            <div class="offcanvas offcanvas-start" id="sidebar" style="z-index: 2000;">
                <div class="offcanvas-header">
                    <h5 class="texto-guinda">Menú</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body container-fluid">
                    <ul class="navbar-nav">

                            <li class="texto-guinda"><a class="nav-link" href="{{ route('users.profile', Auth::user()->id) }}"><em
                                            class="fas fa-house-user"></em> Perfil</a></li>
                        @hasrole('Administrador')
                            <li class="texto-guinda"><a class="nav-link" href="{{ route('log') }}"><em
                                        class="fas fa-history"></em> Historial</a></li>
                        @endhasrole
                        @canany(['crear_rol', 'editar_rol', 'eliminar_rol'])
                            <li class="texto-guinda"><a class="nav-link" href="{{ route('roles.index') }}"><em
                                            class="fas fa-users-cog"></em> Administrar Roles</a></li>
                        @endcanany

                        @canany(['crear_usuario', 'editar_usuario', 'eliminar_usuario'])
                            <li class="texto-guinda"><a class="nav-link" href="{{ route('users.index') }}"><em
                                            class="fas fa-users"></em> Administrar Usuarios</a></li>
                        @endcanany
                        @canany(['crear_productor', 'editar_productor', 'eliminar_productor', 'show'])
                            <li class="texto-guinda"><a class="nav-link" href="{{ route('producers.index') }}"><em
                                            class="fas fa-tractor"></em> Administrar Productores</a></li>
                        @endcanany
                        @canany(['crear_registro', 'editar_registro', 'eliminar_registro', 'show'])
                            <li class="texto-guinda"><a class="nav-link" href="{{ route('documentos.index') }}"><em
                                            class="fas fa-briefcase"></em> Gestión de pre-registro</a></li>
                        @endcanany
                        @canany(['trazabilidad'])
                            <li class="texto-guinda"><a class="nav-link" href="{{ route('producers.trace') }}"><em
                                            class="fas fa-store-alt"></em> Trazabilidad</a></li>
                        @endcanany

                    </ul>
                </div>
            </div>
        @endif

        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center mt-3">
                    <div class="col-md-12">

                        @if ($message = Session::get('success'))
                            <div class="alert alert-success text-center" style="color: #4A001F; background-color: #FFC4D0; font-size: 16px; padding: 20px 30px;" role="alert">
                                {{ $message }}
                            </div>
                        @endif

                        <br><br><br><br>
                        <div class="container" style="width: 330px;">
                            <div class="row" style="padding:0px 0px;">
                                <div class="col-12 text-center">
                                <img src="{{ url('/img/sader.png') }}" class="img-fluid" alt="">
                                </div>
                            </div>
                        </div><br>
                        @yield('content')
                        <br><br><br><br>



                    </div>
                </div>
            </div>
        </main>

        <footer style="position: 0px;bottom:0px;left:0px;right:0px;">
            <div class="container footer-main">
                <div class="row">
                    <div class="col-lg-4 text-center">
                        <div class="footer-logo">
                            <img src="https://michoacan.gob.mx/images/logo-gris.png?1222259157" class="logoFooter"
                                alt="footer-logo">
                        </div>

                    </div>
                    <div class="col-md-4 text-center">
                        <!-- Social Icons -->
                        <ul class="social-icons list-inline">
                            <li class="list-inline-item">
                                <br>
                                <a href="https://twitter.com/SaderMich" target="_blank"><i
                                        class="fab fa-2x fa-twitter"></i></a>&nbsp;&nbsp;
                            </li>
                            <li class="list-inline-item">
                                <br>
                                <a href="https://www.facebook.com/AgriculturaMich/" target="_blank"><i
                                        class="fab fa-2x fa-facebook"></i></a>&nbsp;&nbsp;
                            </li>
                            <li class="list-inline-item">
                                <br>
                                <a href="https://www.instagram.com/gobmichoacan/?hl=es" target="_blank"><i
                                        class="fab fa-2x fa-instagram"></i></a>&nbsp;&nbsp;
                            </li>
                            <li class="list-inline-item">
                                <br>
                                <a href="https://t.me/GobiernodeMichoacan" target="_blank"><i
                                        class="fab fa-2x fa-telegram-plane"></i></a>&nbsp;&nbsp;
                            </li>
                            <li class="list-inline-item">
                                <br>
                                <a href="https://open.spotify.com/user/rr3zgtpveoxmy02i5t9bj9l7z" target="_blank"><i
                                        class="fab fa-2x fa-spotify"></i></a>&nbsp;&nbsp;
                            </li>
                        </ul>
                        <!-- Footer Links -->
                        <a href="http://smo.michoacan.gob.mx">Correo institucional</a><br>
                        <a href="https://www.michoacan.gob.mx/aviso-de-privacidad/">Aviso de privacidad</a> <br>
                    </div>
                    <div class="col-lg-4 text-center">
                        <br>
                        <h4 class="textoGris">#GobiernoDeMichoacán</h4>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                    <div class="col-12 text-center">
                        © Diseñado por el Departamento de Informática de la SADER | <b
                            class="texto-guinda">Gobierno del Estado de Michoacán 2025</b>
                    </div>
                </div>
            </div>
            <div class="container-fluid footer-pleca">
                <div class="row">
                    <div class="col">
                        <br><br>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- Accesibility JS -->
    <script type="text/javascript" id="pojo-a11y-js-extra">
        /* <![CDATA[ */
        var PojoA11yOptions = {"focusable":"","remove_link_target":"","add_role_links":"","enable_save":"","save_expiration":""};
        /* ]]> */
        </script>
        <script src="{{ asset('js/accesibility.js') }}"></script>
    
        @stack('scripts')

    <script>
        $(document).ready(function() {
            $('.nav-link').click(function(e) {
                $('#searchform').removeAttr('hidden');
            });
            $('#close-search').click(function(e) {
                $('#searchform').attr('hidden', 'hidden');
            });
        });

        window.onload = function() {
            adjustFooterPosition();
        };

        // Función para ajustar la posición del footer
        function adjustFooterPosition() {
            var mainContentHeight = document.querySelector('main').offsetHeight;
            var footer = document.querySelector('footer');

            // Calcula la posición del footer
            var newFooterPosition = mainContentHeight + footer.offsetHeight;

            // Ajusta la posición del footer
            if (newFooterPosition > window.innerHeight) {
                footer.style.position =
                    'static'; // Si el contenido supera la altura de la ventana, cambia a posición estática
            } else {
                footer.style.position = 'fixed'; // Si no, mantiene el footer fijo
                footer.style.bottom = '0';
                footer.style.left = '0';
                footer.style.right = '0';
            }
        }

        // Llama a la función cada vez que cambie el tamaño de la ventana
        window.onresize = adjustFooterPosition;
    </script>
</body>

</html>
