<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Worqly - Plateforme de Recrutement')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- CSS personnalisé -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js']) 

    <style>
        .navbar {
    padding-top: 0.5rem; /* Réduit l'espacement vertical en haut */
    padding-bottom: 0.5rem; /* Réduit l'espacement vertical en bas */
}

.navbar-brand img {
    height: 60px; /* Réduit aussi le logo pour correspondre */
}

    </style>
    
    
    @yield('styles')
</head>
<body>
    <!-- Navigation moderne -->
    <nav class="navbar navbar-expand-md">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/worqly-logo-.png') }}" alt="Worqly Logo">
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Connexion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Inscription</a>
                        </li>
                    @else
                        @if(auth()->user()->isAdmin())
                            @include('partials.admin_nav')
                        @elseif(auth()->user()->isCandidat())
                            @include('partials.candidat_nav')
                        @endif
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user me-2"></i>
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-sign-out-alt me-2"></i> Déconnexion
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-5">
        <div class="container">
            @yield('content')
        </div>
    </main>

<!-- Footer -->
<footer class="footer fixed-bottom py-1" style="background-color: white;">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div class="footer-logo">
                <img src="{{ asset('images/worqly-logo-.png') }}" alt="Worqly Logo" height="50" width="auto" style="filter: none;">
            </div>
            <div class="text-muted small">
                &copy; 2025 Worqly. Tous droits réservés.
            </div>
        </div>
    </div>
</footer>

    <!-- Bootstrap JS Bundle avec Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @yield('scripts')
</body>
</html>