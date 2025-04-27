@extends('layouts.app')

@section('title', 'Liste des Offres')

@section('content')
<div class="container my-4">
    <!-- Bouton Retour -->
    <div class="mb-4">
        <a href="{{ route('candidat.dashboard') }}" class="btn btn-light" >
            <i class="fas fa-arrow-left me-2"></i> Retour au tableau de bord
        </a>
    </div>

    <!-- Titre et recherche -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 style="color: var( --primary-dark);">Liste des Offres Disponibles</h1>
    </div>

    <!-- Liste des offres -->
    @if($offres->count() > 0)
        <div class="row row-cols-1 row-cols-md-2 g-4">
            @foreach($offres as $offre)
                <div class="col">
                    <div class="card border-0 shadow h-100">
                        <!-- En-tête de la carte -->
                        <div class="card-header bg-light text-black py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h2 class="h4 mb-0">{{ $offre->titre }}</h2>
                            </div>
                        </div>

                        <!-- Corps de la carte -->
                        <div class="card-body">
                            <div class="mb-3">
                                <p class="card-text">{{ Str::limit($offre->description, 200) }}</p>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                  
                                    <span class="badge bg-light text-dark">
                                        <i class="fas fa-calendar me-1"></i>
                                        Publiée le {{ $offre->date_publication->format('d/m/Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Pied de carte -->
                        <div class="card-footer bg-transparent border-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted small">
                                    {{ $offre->candidatures_count }} candidature(s)
                                </span>
                                <div>
                                   
                                    <a href="{{ route('candidat.offres.show', $offre) }}" 
                                       class="btn btn-light" style="background-color: var( --primary-light); ; color:white">
                                       <i class="fas fa-eye me-1"></i> Voir détails
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $offres->links() }}
        </div>
 
    @endif
</div>
@endsection