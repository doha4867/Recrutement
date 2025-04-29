<?php

use App\Http\Controllers\Admin\CompteController as AdminCompteController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\SystemController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Candidat\CandidatureController;
use App\Http\Controllers\Candidat\CvController;
use App\Http\Controllers\Candidat\DashboardController as CandidatDashboardController;
use App\Http\Controllers\Candidat\EntretienController;
use App\Http\Controllers\Candidat\OffreController;
use App\Http\Controllers\Candidat\ProfileController;
use Illuminate\Support\Facades\Route;

// Routes publiques
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Routes d'authentification
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// Route de déconnexion
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

// Routes nécessitant authentification
Route::middleware('auth')->group(function () {
    
    // Routes administrateur
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        // Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        
        // Gestion des comptes
        Route::get('/comptes', [AdminCompteController::class, 'index'])->name('comptes.index');
        Route::get('/comptes/{compte}', [AdminCompteController::class, 'show'])->name('comptes.show');
        Route::patch('/comptes/{compte}/statut', [AdminCompteController::class, 'verifierStatut'])->name('comptes.statut');
        Route::patch('/comptes/user/{user}/password', [AdminCompteController::class, 'changerMotDePasse'])->name('comptes.password');
        Route::delete('/comptes/{compte}', [AdminCompteController::class, 'destroy'])->name('comptes.destroy');
        

    });
    
    // Routes candidat
    Route::middleware('role:candidat')->prefix('candidat')->name('candidat.')->group(function () {
        // Dashboard
        Route::get('/dashboard', [CandidatDashboardController::class, 'index'])->name('dashboard');
        
        // Gestion du profil
        Route::get('/profil', [ProfileController::class, 'show'])->name('profil.show');
        Route::get('/profil/edit', [ProfileController::class, 'edit'])->name('profil.edit');
        Route::patch('/profil', [ProfileController::class, 'update'])->name('profil.update');
        
        // Gestion des offres
        Route::get('/offres', [OffreController::class, 'index'])->name('offres.index');
        Route::get('/offres/{offre}', [OffreController::class, 'show'])->name('offres.show');
        
        // Gestion des candidatures
        Route::get('/candidatures', [CandidatureController::class, 'index'])->name('candidatures.index');
        Route::get('/candidatures/{candidature}', [CandidatureController::class, 'show'])->name('candidatures.show');
        Route::post('/offres/{offre}/postuler', [CandidatureController::class, 'store'])->name('offres.postuler');
        
        // Gestion des entretiens
        Route::get('/entretiens', [EntretienController::class, 'index'])->name('entretiens.index');
        Route::get('/entretiens/{entretien}', [EntretienController::class, 'show'])->name('entretiens.show');
        
        // Création de CV
        Route::get('/cv/create', [CvController::class, 'create'])->name('cv.create');
    });
});