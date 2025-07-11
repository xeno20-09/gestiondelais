<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Connexion | E-délais</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
    <noscript>
        <link rel="stylesheet" href="{{ asset('assets/css/noscript.css') }}" />
    </noscript>

    <style>
        body {
            background: linear-gradient(135deg, #2c3e50, #3498db);
            margin: 0;
            padding: 0;
        }

        .login-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login-card {
            padding: 40px;
            border-radius: 10px;
            max-width: 500px;
            width: 100%;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #ccc;
        }

        label {
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
        }

        .form-group {
            margin-bottom: 20px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
        }

        input:focus {
            border-color: #3498db;
            outline: none;
        }

        .invalid-feedback {
            color: #e74c3c;
            font-size: 14px;
            margin-top: 5px;
        }

        .btn {
            width: max-content;
            padding: 4px;
            background-color: #3498db;
            border: none;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
        }


        .btn-link {
            display: block;
            margin-top: 15px;
            text-decoration: none;
        }


        @media (max-width: 600px) {
            .login-card {
                padding: 30px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="login-wrapper">
        <div class="login-card">
            <h2>Connexion</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Adresse e-mail</label>
                    <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input id="password" type="password" class="@error('password') is-invalid @enderror"
                        name="password" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn">Se connecter</button>

                @if (Route::has('password.request'))
                    <a class="btn-link" href="{{ route('password.request') }}">
                        Mot de passe oublié ?
                    </a>
                @endif
            </form>
        </div>
    </div>
</body>

</html>
