<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;

class AuthController extends Controller
{
    // Affiche le formulaire de connexion
    public function showLoginForm()
    {
        return view("auth.login");
    }

    // Affiche le formulaire d'inscription
    public function showUserRegistrationForm()
    {
        return view("auth.register");
    }

    // Gère l'inscription d'un nouvel utilisateur
    public function registerUser(Request $request)
    {
        // Validation des données de la requête
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        // Création d'un nouvel utilisateur
        $user = User::create([
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Gestion des résultats de la sauvegarde
        if ($user) {
            return redirect()->route('login')->with('success', 'Inscription réussie. Veuillez vous connecter.');
        } else {
            return back()->with('fail', 'Échec de l\'inscription. Veuillez réessayer plus tard.');
        }
    }

    // Gère la connexion d'un utilisateur
    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        $user = User::where('email', '=', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $request->session()->put('loginId', $user->id);
                return redirect('dashboard');
            }else{
                return back()->with('fail', 'Mot de passe incorrecte');
            }
        } else {
            return back()->with('fail', 'Email incorrecte');
        }
    }

    public function dashboard(Request $request)
    {
        $data = array();
        if (Session::has('loginId')) {
            $data = User::where('id', '=', Session::get('loginId'))->first();
        }
        return view('dashboard', compact('data'));
    }

    public function logout()
    {
        if (Session::has('loginId')) {
            Session::pull('loginId');
            return redirect('login');
        }
    }
}
