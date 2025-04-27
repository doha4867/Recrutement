<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidature;
use App\Models\Compte;
use App\Models\Offre;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistiques
        $totalComptes = Compte::count();
        $totalCandidats = User::where('role', 'candidat')->count();
        $totalOffres = Offre::count();
        $totalCandidatures = Candidature::count();
    
        // Données pour les listes
        $recentOffres = Offre::with(['user', 'offre'])
            ->latest()
            ->take(5);
    
        $recentCandidatures = Candidature::with(['user', 'offre'])
            ->latest()
            ->take(5)
            ->get();
    
        return view('admin.dashboard', compact(
            'totalComptes',
            'totalCandidats',
            'totalOffres',
            'totalCandidatures',
            'recentOffres',
            'recentCandidatures'
        ));
    }
}