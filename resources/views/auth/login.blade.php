@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
<style>
    body {
        background-color: #f5f9fc;
    }

    .card {
        border: none;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #4b8bad;
        color: white;
        font-weight: bold;
        text-align: center;
    }

    .btn-custom {
        background-color: #4b8bad;
        color: white;
        border: none;
    }

    .btn-custom:hover {
        background-color: #3d7894;
    }

    label {
        color: #4b8bad;
    }

    .form-control:focus {
        border-color: #4b8bad;
        box-shadow: 0 0 0 0.2rem rgba(75, 139, 173, 0.25);
    }

    .form-check-label {
        color: #4b8bad;
    }
</style>

<div class="row justify-content-center">
    <div class="col-md-6 mt-5">
        <div class="card">
            <div class="card-header">Connexion</div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Adresse e-mail</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">Se souvenir de moi</label>
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-custom">Connexion</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
