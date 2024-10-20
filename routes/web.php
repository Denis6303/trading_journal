<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

// Rediriger vers la page de connexion lorsqu'on accède à l'URL racine
Route::get('/', function () {
    return redirect()->route('login');
});

// Routes d'authentification
Route::group(['controller' => AuthController::class], function () {
    Route::group(['middleware' => 'guest'], function () {
        // Route pour afficher le formulaire de connexion
        Route::get('/login', 'showLoginForm')->name('login');
        
        // Route pour traiter la connexion de l'utilisateur
        Route::post('/login-user', 'loginUser')->name('login.user');

        // Route pour afficher le formulaire d'inscription
        Route::get('/register', 'showUserRegistrationForm')->name('register');

        // Route pour traiter l'inscription de l'utilisateur
        Route::post('/register-user', 'registerUser')->name('register.user');

        Route::get('/dashboard','dashboard')->name('dashboard.home');
    });

    // Routes accessibles uniquement aux utilisateurs connectés
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/logout', 'logout')->name('logout');
    });
});
