<!DOCTYPE HTML>
<!--
 Forty by HTML5 UP
 html5up.net | @ajlkn
 Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>

<head>
    <title>E-delais</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <noscript>
        <link rel="stylesheet" href="{{ asset('assets/css/noscript.css') }}" />
    </noscript>
</head>
<style>
    * {
        list-style: none;
        text-decoration: none;
    }

    a {
        text-decoration: none;
    }
</style>

<body class="">

    <!-- Wrapper -->
    <div id="wrapper">

        <!-- Header -->
        <header id="header" class="alt">
            <a href="{{ url('/') }}" class="logo"><strong>Gestion</strong> <span>Délais</span></a>
            @guest
                {{--         <nav>
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Se connecter') }}</a>
                        </li>
                    @endif
                </nav> --}}
                {{--           <nav>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('S\'inscrire') }}</a>
                        </li>
                    @endif
                </nav> 
                            @else
--}} @if (Auth::user())
                    <nav>
                        <li class="nav-item nav-profile dropdown border-0">
                            <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown">
                                <span class="profile-name">{{ Auth::user()->nom }} {{ Auth::user()->prenoms }}</span>
                            </a>
                            <div class="dropdown-menu navbar-dropdown w-100" aria-labelledby="profileDropdown">
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf

                                    <button type="submit" style="width: min-content"
                                        class=" dropdown-item btn btn-danger btn-sm">Deconnexion</button>
                                </form>
                            </div>
                        </li>
                    </nav>
                @endif

            @endguest
        </header>

        <!-- Menu -->


        <!-- Banner -->
        <section id="banner" class="major">
            <div class="inner">
                <header class="major">
                    <h1>Plate-forme de suivie des délais des dossiers</h1>
                </header>
                <div class="content">
                    <ul class="row">
                        <li><a href="{{ route('login') }}" class="button primary large">Connexion</a></li>
                    </ul>
                </div>
            </div>
        </section>
    </div>
</body>

</html>
