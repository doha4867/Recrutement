@extends('layouts.app')

@section('title', $offre->titre)

@section('content')
<div class="mb-4">
    <a href="{{ route('candidat.offres.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left"></i> Retour aux offres
    </a>
</div>

<div class="card shadow-sm border-0 rounded-4 mb-4">
    <div class="card-body pb-0">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="fw-bold mb-0">{{ $offre->titre }}</h1>
            
        </div>
        <div class="d-flex flex-wrap gap-4 mt-3 text-secondary">
            <div>
                <i class="far fa-calendar-alt me-2"></i>
                @if($offre->date_debut && $offre->date_fin)
                    {{ $offre->date_debut->format('d/m/Y') }} - {{ $offre->date_fin->format('d/m/Y') }}
                @elseif($offre->date_debut)
                    {{ $offre->date_debut->format('d/m/Y') }}
                @elseif($offre->date_fin)
                    {{ $offre->date_fin->format('d/m/Y') }}
                @else
                    Dates non précisées
                @endif
            </div>
            <div><i class="far fa-clock me-2"></i>{{ $offre->duree }} mois</div>
            <div><i class="fas fa-user-friends me-2"></i>{{ $offre->places }} place(s) disponible(s)</div>
        </div>
    </div>

    <div class="card-body">
        <h5 class="fw-semibold">Description du stage</h5>
        <p class="text-secondary">{{ $offre->description }}</p>
        <div class="mt-4 text-end">
            @if($hasApplied)
                <div class="alert alert-info d-inline-block">
                    Vous avez déjà postulé à cette offre.
                    <a href="{{ route('candidat.candidatures.index') }}" class="alert-link">Voir vos candidatures</a>
                </div>
            @else
                <form action="{{ route('candidat.offres.postuler', $offre) }}" method="POST" class="d-inline-block">
                    @csrf
                    <button type="submit" class="btn btn-mn rounded-3 px-4"style="background-color:var(--primary-light);color:white">Postuler</button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
<style>
    .btn-primary {
    background-color: #5b4fff;
    border: none;
}
.btn-primary:hover {
    background-color: #3d2fd6;
}
</style>