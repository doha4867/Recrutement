<?php

namespace App\Http\Controllers\Candidat;

use App\Http\Controllers\Controller;
use App\Models\Candidature;
use App\Models\Offre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidatureController extends Controller
{
    public function index()
    {
        $candidatures = Auth::user()->candidatures()
            ->with('offre', 'entretien')
            ->latest()
            ->paginate(10);
            
        return view('candidat.candidatures.index', compact('candidatures'));
    }

    public function show(Candidature $candidature)
    {
        // Vérifier que la candidature appartient bien à l'utilisateur
        if ($candidature->user_id !== Auth::id()) {
            abort(403, 'Non autorisé');
        }
        
        return view('candidat.candidatures.show', compact('candidature'));
    }

    public function store(Request $request, Offre $offre)
    {
        $user = Auth::user();
        
        // Vérifier si l'utilisateur a déjà postulé
        $existingApplication = Candidature::where('user_id', $user->id)
            ->where('offre_id', $offre->id)
            ->exists();
            
        if ($existingApplication) {
            return redirect()->route('candidat.offres.show', $offre)
                ->with('warning', 'Vous avez déjà postulé à cette offre.');
        }
        
        // Créer la candidature
        Candidature::create([
            'user_id' => $user->id,
            'offre_id' => $offre->id,
            'statut' => 'Soumise',
            'date_soumission' => now(),
        ]);
        
        return redirect()->route('candidat.candidatures.index')
            ->with('success', 'Votre candidature a été soumise avec succès.');
    }
}