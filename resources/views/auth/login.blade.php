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
            <a href="index.html" class="logo"><strong>Gestion</strong> <span>Délais</span></a>

            <nav>
                <a href="{{ route('login') }}">Se connecter</a>
            </nav>
            <nav>
                <a href="{{ route('register') }}">S'inscrire</a>
            </nav>
        </header>

        <!-- Menu -->


        <!-- Banner -->z
        <section id="banner" class="major">
            <div class="inner">
                <header class="major">
                    <h1>Se connecter</h1>
                </header>
                <div class="content">
                    <p>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row" style="padding-bottom: 50px;">
                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Identifiant') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Mot de passe') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>




                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4" style="display: flex;gap: 50px;">
                                <button type="submit" class="btn btn-primary justify-content-center">
                                    {{ __('Se connecter') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Mot de passe oublié?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                    </p>
                </div>
            </div>
        </section>


    </div>



</body>

</html>
