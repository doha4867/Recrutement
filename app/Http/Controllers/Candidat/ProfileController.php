<?php

namespace App\Http\Controllers\Candidat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $profil = $user->profilCandidat;
        return view('candidat.profil.show', compact('user', 'profil'));
    }

    public function edit()
    {
        $user = Auth::user();
        $profil = $user->profilCandidat;
        return view('candidat.profil.edit', compact('user', 'profil'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        // Valider les données personnelles
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string|max:255',
            'profil' => 'nullable|string',
            'photo_profil' => 'nullable|image|max:2048',
            'cv' => 'nullable|mimes:pdf,doc,docx|max:2048',
        ]);

        // Mettre à jour l'utilisateur
        $user->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
        ]);

        // Gérer l'upload de la photo de profil
        if ($request->hasFile('photo_profil')) {
            if ($user->profilCandidat->photo_profil) {
                Storage::delete($user->profilCandidat->photo_profil);
            }
            $photoPath = $request->file('photo_profil')->store('photos_profil', 'public');
        }

        // Gérer l'upload du CV
        if ($request->hasFile('cv')) {
            if ($user->profilCandidat->cv) {
                Storage::delete($user->profilCandidat->cv);
            }
            $cvPath = $request->file('cv')->store('cvs', 'public');
        }

        // Mettre à jour ou créer le profil candidat
        $user->profilCandidat()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'telephone' => $request->telephone,
                'adresse' => $request->adresse,
                'profil' => $request->profil,
                'photo_profil' => $request->hasFile('photo_profil') ? $photoPath : $user->profilCandidat->photo_profil,
                'cv' => $request->hasFile('cv') ? $cvPath : $user->profilCandidat->cv,
            ]
        );

        return redirect()->route('candidat.profil.show')
            ->with('success', 'Profil mis à jour avec succès.');
    }
}