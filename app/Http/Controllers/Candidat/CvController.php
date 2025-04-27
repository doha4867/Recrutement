<?php

namespace App\Http\Controllers\Candidat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CvController extends Controller
{
    public function create()
    {
        // Rediriger vers un service de création de CV en ligne
        return redirect()->away('https://www.canva.com/fr_fr/cv/');
    }
}