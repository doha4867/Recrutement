@extends('layouts.app')

@section('title', 'Tableau de bord administrateur')

@section('content')
<div class="container-fluid py-4">
    <!-- Titre -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2" style="color: var(--primary-light);">
            <i class="fas fa-tachometer-alt me-2"></i>Tableau de bord
        </h1>
        <div class="dropdown" >
            <button style="color: var(--primary-light);" class="btn btn dropdown-toggle"  type="button" id="dashboardActions" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-cog me-1"></i> Actions
            </button>
            <ul class="dropdown-menu" aria-labelledby="dashboardActions">
                <li><a class="dropdown-item" href="{{ route('admin.comptes.index') }}"><i class="fas fa-users me-2"></i>Gérer les comptes</a></li>

                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-chart-line me-2"></i>Voir les statistiques</a></li>
            </ul>
        </div>
    </div>

    <!-- Cartes statistiques -->
    <div class="row mt-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5 class="card-title">Comptes</h5>
                <p class="card-text display-4">{{ $totalComptes }}</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5 class="card-title">Candidats</h5>
                <p class="card-text display-4">{{ $totalCandidats }}</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h5 class="card-title">Offres</h5>
                <p class="card-text display-4">{{ $totalOffres }}</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card bg-warning text-dark">
            <div class="card-body">
                <h5 class="card-title">Candidatures</h5>
                <p class="card-text display-4">{{ $totalCandidatures }}</p>
            </div>
        </div>
    </div>
</div>

    
@endsection

@push('styles')
<style>
    .icon-shape {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .bg-primary-light {
        background-color: rgba(75, 139, 173, 0.1);
    }
    .bg-success-light {
        background-color: rgba(40, 167, 69, 0.1);
    }
    .bg-info-light {
        background-color: rgba(23, 162, 184, 0.1);
    }
    .bg-warning-light {
        background-color: rgba(255, 193, 7, 0.1);
    }
    .card {
        border-radius: 0.5rem;
    }
</style>
@endpush