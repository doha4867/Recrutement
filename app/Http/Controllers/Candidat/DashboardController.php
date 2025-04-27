<?php

namespace App\Http\Controllers\Candidat;

use App\Http\Controllers\Controller;
use App\Models\Candidature;
use App\Models\Offre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Récupérer les données pour le dashboard candidat
        $candidatures = Candidature::where('user_id', $user->id)
            ->with('offre')
            ->latest()
            ->take(5)
            ->get();
            
        $offresRecentes = Offre::where('date_publication', '<=', now())
            ->latest('date_publication')
            ->take(3)
            ->get();
            
        $entretiens = Candidature::where('user_id', $user->id)
            ->whereHas('entretien')
            ->with('entretien', 'offre')
            ->get();

        return view('candidat.dashboard', compact(
            'candidatures',
            'offresRecentes',
            'entretiens'
        ));
    }
}