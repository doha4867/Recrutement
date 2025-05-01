@extends('layouts.app')

@section('title', $offre->titre)

@section('content')
<div class="container my-4">
    <!-- Bouton Retour -->
    <div class="mb-4">
        <a href="{{ route('offres-public.index')}}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Retour aux offres
        </a>
    </div>

    <!-- Carte principale -->
    <div class="card shadow-sm border-0 rounded-4 mb-4">
        <div class="card-body pb-0">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="fw-bold mb-0">{{ $offre->titre }}</h1>
            </div>
            
            <!-- Informations dates -->
            <div class="d-flex flex-wrap gap-4 mt-3 text-secondary">
                <div>
                    <i class="far fa-calendar-alt me-2"></i>
                    Publiée le {{ $offre->date_publication->format('d/m/Y') }}
                </div>
                
            </div>
        </div>

        <div class="card-body">
            <!-- Description -->
            <h5 class="fw-semibold">Description du poste</h5>
            <p class="text-secondary">{{ $offre->description }}</p>
            
            
            <!-- Section postulation -->
            <div class="mt-4 text-end">
                @auth
                    @if($hasApplied)
                        <div class="alert alert-info d-inline-block">
                            Vous avez déjà postulé à cette offre.
                            <a href="{{ route('candidat.candidatures.index') }}" class="alert-link">Voir vos candidatures</a>
                        </div>
                    @else
                        <a href="{{ route('offres.show', $offre) }}" class="btn btn-mn rounded-3 px-4" style="background-color:var(--primary-light);color:white">
                            <i class="fas fa-paper-plane me-1"></i> Postuler 
                        </a>
                    @endif
                @else
                    <div class="alert alert-light text-start">
                        <p>Pour postuler à cette offre :</p>
                        <div class="d-flex gap-2">
                            <a href="{{ route('login') }}" class="btn btn-primary rounded-3 px-4">
                                <i class="fas fa-sign-in-alt me-1"></i> Se connecter
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-outline-balck rounded-3 px-4">
                                <i class="fas fa-user-plus me-1"></i> Créer un compte
                            </a>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</div>

<style>
    .btn-primary {
        background-color: var(--primary-light);
        border: none;
        color: white;
    }
    .btn-primary:hover {
        background-color: var(--primary-dark);
    }
    .card {
        border-radius: 12px;
    }
    .list-unstyled li {
        padding: 4px 0;
    }
</style>
@endsection