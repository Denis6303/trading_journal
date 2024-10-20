<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="{{ mix('css/styles.css') }}">
</head>
<body>
    <div class="container">
        <h2>Connexion</h2>

        <!-- Afficher les messages d'erreur -->
        @if (session('fail'))
            <div class="alert alert-danger">
                {{ session('fail') }}
            </div>
        @endif

        <form action="{{ route('login.user') }}" method="post">
            @csrf
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Votre Email" required>

            <!-- Afficher les erreurs pour l'email -->
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" placeholder="Votre mot de passe" required>

            <!-- Afficher les erreurs pour le mot de passe -->
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <input type="submit" value="Se connecter">
        </form>

        <div class="forgot-password">
            <a href="#">Mot de passe oublié ?</a>
        </div>
        <div class="toggle-btn" onclick="window.location.href='{{ route('register') }}'">Créer un compte</div>
    </div>

    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>
