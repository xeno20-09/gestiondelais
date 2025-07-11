<!DOCTYPE HTML>
<html lang="fr">

<head>
    <title>E-délais - Accueil</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <noscript>
        <link rel="stylesheet" href="{{ asset('assets/css/noscript.css') }}" />
    </noscript>

    <style>
        * {
            list-style: none;
            text-decoration: none;
        }

        a {
            text-decoration: none;
        }

        .profile-name {
            color: #fff;
            font-weight: 600;
            margin-right: 10px;
        }

        .dropdown-menu {
            border-radius: 5px;
            padding: 10px;
        }

        .btn-danger {
            background: #e74c3c;
            color: #fff;
            border: none;
            padding: 5px 15px;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-danger:hover {
            background: #c0392b;
        }
    </style>
</head>

<body class="">
    <!-- Wrapper -->
    <div id="wrapper">
        <!-- Header -->
        <header id="header" class="alt">
            <a href="{{ url('/') }}" class="logo"><strong>E-délais</strong> <span>Gestion des délais</span></a>

            @if (Auth::check())
                <nav>
                    <ul>
                        <li class="nav-item nav-profile dropdown border-0">
                            <a class="nav-link dropdown-toggle" href="#">
                                <span class="profile-name">{{ Auth::user()->nom }} {{ Auth::user()->prenoms }}</span>
                            </a>
                            <div class="dropdown-menu navbar-dropdown w-100">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="dropdown-item btn btn-danger btn-sm">Déconnexion</button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </nav>
            @endif
        </header>

        <!-- Banner -->
        <section id="banner" class="major">
            <div class="inner">
                <header class="major">
                    <h1>Plateforme de suivi des délais des dossiers</h1>
                </header>

                @if (!Auth::user())
                    <div class="content">
                        <ul class="actions">
                            <li>
                                <a href="{{ route('login') }}" class="button primary large">Connexion</a>
                            </li>
                        </ul>
                    </div>
                @endif

            </div>
        </section>
    </div>
</body>

</html>
