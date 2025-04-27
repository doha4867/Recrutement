<?php

namespace App\Http\Controllers\Candidat;

use App\Http\Controllers\Controller;
use App\Models\Candidature;
use App\Models\Offre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OffreController extends Controller
{
    public function index()
    {
        $offres = Offre::where('date_publication', '<=', now())
            ->latest('date_publication')
            ->paginate(10);
            
        return view('candidat.offres.index', compact('offres'));
    }

    public function show(Offre $offre)
    {
        $user = Auth::user();
        
        $hasApplied = Candidature::where('user_id', $user->id)
            ->where('offre_id', $offre->id)
            ->exists();
            
        return view('candidat.offres.show', compact('offre', 'hasApplied'));
    }
}