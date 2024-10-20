<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="{{ mix('css/styles.css') }}">
</head>
<body>
    <div class="container">
        <h2>Inscription</h2>

        <!-- Afficher les messages d'erreur -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.user') }}" method="post">
            @csrf
            <label for="username">Nom d'utilisateur</label>
            <input type="text" id="username" name="username" placeholder="Votre nom d'utilisateur" required>

            <!-- Afficher les erreurs pour le nom d'utilisateur -->
            @error('username')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

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

            <label for="password_confirmation">Confirmer le mot de passe</label>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirmer votre mot de passe" required>

            <!-- Afficher les erreurs pour la confirmation du mot de passe -->
            @error('password_confirmation')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <input type="submit" value="S'inscrire">
        </form>
        <div class="toggle-btn" onclick="window.location.href='{{ route('login') }}'">Vous avez déjà un compte ? Se connecter</div>
    </div>

    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>
