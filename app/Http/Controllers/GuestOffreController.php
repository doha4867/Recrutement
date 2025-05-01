<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use Illuminate\Http\Request;

class GuestOffreController extends Controller
{
    public function index()
    {
        $offres = Offre::where('date_publication', '<=', now())
            ->latest('date_publication')
            ->paginate(10);
            
        return view('guest.offres.index', compact('offres'));
    }

    public function show(Offre $offre)
    {
        $hasApplied = false;
        
        if (auth()->check()) {
            $hasApplied = auth()->user()->candidatures()
                                ->where('offre_id', $offre->id)
                                ->exists();
        }
            
        return view('guest.offres.show', compact('offre', 'hasApplied'));
    }
}