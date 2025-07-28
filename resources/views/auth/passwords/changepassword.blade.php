<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Changement du mot de passe</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #2c3e50, #3498db);
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
            max-width: 500px;
            width: 100%;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.4s ease-in-out;
        }

        .card h2 {
            text-align: center;
            margin-bottom: 15px;
            color: #2c3e50;
        }

        .card p {
            text-align: center;
            color: #555;
            margin-bottom: 25px;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .form-control:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.1);
        }

        .btn {
            width: 100%;
            padding: 12px;
            background-color: #3498db;
            color: white;
            border: none;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #2980b9;
        }

        .btn-link {
            display: block;
            margin-top: 15px;
            text-align: center;
            color: #3498db;
            text-decoration: none;
            font-size: 14px;
        }

        .btn-link:hover {
            text-decoration: underline;
        }

        .invalid-feedback {
            color: #e74c3c;
            font-size: 14px;
            margin-top: -15px;
            margin-bottom: 10px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(15px);
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
        <h2>Changer le mot de passe</h2>
@if (session('error'))
    <div class="alert alert-warning" role="alert">
        {{ session('error') }}
    </div>
@endif

        <form method="POST" action="{{ route('password_change') }}">
            @csrf

            <input id="password" type="password"
                class="form-control @error('password') is-invalid @enderror"
                name="password" required placeholder="Mot de passe">

            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn">Changer</button>
        </form>
    </div>

</body>
</html>

