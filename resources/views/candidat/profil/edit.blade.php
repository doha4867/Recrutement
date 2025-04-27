@extends('layouts.app')

@section('title', 'Modifier mon profil')

@section('content')

    <!-- Bouton Retour -->
    <div class="mb-4">
        <a href="{{ route('candidat.profil.show') }}" class="btn btn-light">
            <i class="fas fa-arrow-left me-2"></i> Retour à mon profil
        </a>
    </div>


 <!-- Titre -->
 <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2 " style="color:var(--primary-light);">
        <i class="fas fa-user-edit me-2"></i>Modifier mon profil
    </h1>
</div>


<div class="card mt-4">
    <div class="card-body">
        <form method="POST" action="{{ route('candidat.profil.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nom" class="form-label">Nom</label><span class="text-danger">*</span>
                    <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom', $user->nom) }}">
                    @error('nom')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="prenom" class="form-label">Prénom</label><span class="text-danger">*</span>
                    <input type="text" class="form-control @error('prenom') is-invalid @enderror" id="prenom" name="prenom" value="{{ old('prenom', $user->prenom) }}">
                    @error('prenom')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="telephone" class="form-label">Téléphone</label>
                    <input type="text" class="form-control @error('telephone') is-invalid @enderror" id="telephone" name="telephone" value="{{ old('telephone', $profil->telephone) }}">
                    @error('telephone')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="adresse" class="form-label">Adresse</label>
                    <input type="text" class="form-control @error('adresse') is-invalid @enderror" id="adresse" name="adresse" value="{{ old('adresse', $profil->adresse) }}">
                    @error('adresse')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            
            <div class="mb-3">
                <label for="profil" class="form-label">À propos de moi</label>
                <textarea class="form-control @error('profil') is-invalid @enderror" id="profil" name="profil" rows="5">{{ old('profil', $profil->profil) }}</textarea>
                @error('profil')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <h3 class="h5 mb-3 text-dark border-bottom pb-2">
                        <i class="fas fa-camera me-2"></i>Photo de profil
                    </h3>
                    <input type="file" class="form-control @error('photo_profil') is-invalid @enderror" id="photo_profil" name="photo_profil">
                    @error('photo_profil')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                   
                </div>
                
                <div class="col-md-6 mb-3">
                    <h3 class="h5 mb-3 text-dark border-bottom pb-2">
                        <i class="fas fa-file-alt me-2"></i>CV
                    </h3>
                    <input type="file" class="form-control @error('cv') is-invalid @enderror" id="cv" name="cv">
                    @error('cv')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                   
                </div>
            </div>
            
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-md" style="background-color:var(--primary-light);">Enregistrer les modifications</button>
            </div>
        </form>
    </div>
</div>
@endsection