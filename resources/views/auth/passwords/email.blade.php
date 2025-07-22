<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>E-délais - Réinitialisation mot de passe</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #3498db, #2c3e50);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
            animation: fadeIn 0.5s ease-in-out;
        }

        .card h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .card p {
            text-align: center;
            color: #555;
            margin-bottom: 30px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
            transition: border 0.3s;
        }

        .form-control:focus {
            border-color: #3498db;
            outline: none;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background-color: #3498db;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #2980b9;
        }

        .alert {
            background-color: #e6ffed;
            color: #2f855a;
            border: 1px solid #c6f6d5;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .invalid-feedback {
            color: #e74c3c;
            font-size: 14px;
            margin-top: -10px;
            margin-bottom: 15px;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #3498db;
            text-decoration: none;
            font-weight: 500;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 600px) {
            .card {
                padding: 30px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="card">
        <h2>Mot de passe oublié ?</h2>
        <p>Entrez votre adresse e-mail pour recevoir un lien de réinitialisation.</p>

        @if (session('status'))
            <div class="alert">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <input type="email" name="email" id="email"
                class="form-control @error('email') is-invalid @enderror" placeholder="Adresse e-mail"
                value="{{ old('email') }}" required autofocus>

            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn">Envoyer le lien</button>
        </form>

        <a href="{{ route('login') }}" class="back-link">← Retour à la connexion</a>
    </div>
</body>

</html>
