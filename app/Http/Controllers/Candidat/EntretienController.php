<?php

namespace App\Http\Controllers\Candidat;

use App\Http\Controllers\Controller;
use App\Models\Candidature;
use App\Models\Entretien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntretienController extends Controller
{
    public function index()
    {
        $entretiens = Entretien::whereHas('candidature', function ($query) {
            $query->where('user_id', Auth::id());
        })->with('candidature.offre')->paginate(10);
        
        return view('candidat.entretiens.index', compact('entretiens'));
    }

    public function show(Entretien $entretien)
    {
        // Vérifier que l'entretien appartient bien à l'utilisateur
        if ($entretien->candidature->user_id !== Auth::id()) {
            abort(403, 'Non autorisé');
        }
        
        return view('candidat.entretiens.show', compact('entretien'));
    }
}