<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Compte;
use App\Models\User;
use Illuminate\Http\Request;

class CompteController extends Controller
{
    public function index()
    {
        $comptes = Compte::with('user')->paginate(10);
        return view('admin.comptes.index', compact('comptes'));
    }

    public function show(Compte $compte)
    {
        return view('admin.comptes.show', compact('compte'));
    }

    public function verifierStatut(Compte $compte)
    {
        // Changer le statut
        $compte->statut = $compte->statut === 'actif' ? 'inactif' : 'actif';
        $compte->save();

        return back()->with('success', 'Statut du compte modifié avec succès.');
    }

    public function changerMotDePasse(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->password = bcrypt($request->password);
        $user->save();

        return back()->with('success', 'Mot de passe modifié avec succès.');
    }

    public function destroy(Compte $compte)
    {
        // Supprimer l'utilisateur (la suppression en cascade supprimera également le compte)
        $user = $compte->user;
        $user->delete();

        return redirect()->route('admin.comptes.index')
            ->with('success', 'Compte supprimé avec succès.');
    }
}