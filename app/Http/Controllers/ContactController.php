<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactController extends Controller
{

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',    // Changé de 'nom' à 'name'
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255', // Changé de 'sujet' à 'subject'
            'message' => 'required|string'
        ]);
    
        // Sauvegarde en base de données
        Contact::create([
            'name' => $validated['name'],     // Mapping des champs
            'email' => $validated['email'],
            'subject' => $validated['subject'],
            'message' => $validated['message']
        ]);
    
        return back()->with('success', 'Merci pour votre message! Nous vous contacterons bientôt.');
    }
}