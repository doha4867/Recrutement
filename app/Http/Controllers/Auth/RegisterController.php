<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Compte;
use App\Models\ProfilCandidat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Valider les données
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Créer l'utilisateur

    $user = User::create([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'candidat',
    ]);

        // Créer le compte associé
        Compte::create([
            'user_id' => $user->id,
            'nom_utilisateur' => $user->nom . ' ' . $user->prenom,
            'email' => $user->email,
            'role' => 'candidat',
            'date_creation' => now(),
            'statut' => 'actif',
        ]);

        // Créer le profil candidat
        ProfilCandidat::create([
            'user_id' => $user->id,
        ]);

        // Connecter l'utilisateur
        auth()->login($user);

        // Rediriger vers le dashboard
        return redirect()->route('candidat.dashboard');
    }
}