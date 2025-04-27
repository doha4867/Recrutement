<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Worqly - Plateforme de Recrutement Innovante</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

          <!-- Loader Animation -->
 

    <div class="loader-container">
        <div class="loader">
            <img class="loader-logo" src="{{ asset('images/worqly-icon-color.png') }}" alt="">
            
        </div>
    </div>

    <!-- Navbar -->
    <header class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" class="logo-link">
                    <img src="{{ asset('images/worqly-logo-.png') }}" alt="Logo">
                </a>
            </div>
            <nav class="nav-menu">
                <ul class="nav-list">
                    <li class="nav-item"><a href="#" class="nav-link active">Accueil</a></li>
                    <li class="nav-item"><a href="#jobs" class="nav-link">Offres</a></li>
                    <li class="nav-item"><a href="#about" class="nav-link">À propos</a></li>
                    <li class="nav-item"><a href="#contact" class="nav-link">Contact</a></li>
                </ul>
            </nav>

            @guest
                <div class="auth-buttons">
                    <a class="btn btn-outline" href="{{ route('login') }}" role="button" id="loginBtn">Connexion</a>
                    <a class="btn btn-primary" href="{{ route('register') }}" role="button" id="registerBtn">Inscription</a>
                </div>
            @else
                @if(auth()->user()->isAdmin())
                    <a class="btn btn-primary btn-lg" href="{{ route('admin.dashboard') }}" role="button">Tableau de bord</a>
                @else
                    <a class="btn btn-primary btn-lg" href="{{ route('candidat.dashboard') }}" role="button">Tableau de bord</a>
                @endif
            @endguest
        
            <div class="mobile-menu-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">Trouvez votre <span class="highlight">prochain emploi</span> avec Worqly</h1>
                <p class="hero-subtitle">La plateforme qui connecte les talents aux meilleures opportunités professionnelles</p>
                <div class="search-box">
                    <div class="search-input-container">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" class="search-input" placeholder="Rechercher un poste, une compétence...">
                    </div>
                    <button class="btn btn-primary search-btn">Rechercher</button>
                </div>
                <div class="popular-searches">
                    <span class="popular-label">Recherches populaires:</span>
                    <div class="popular-tags">
                        <a href="#" class="tag">Développeur</a>
                        <a href="#" class="tag">Marketing</a>
                        <a href="#" class="tag">Finance</a>
                        <a href="#" class="tag">Remote</a>
                    </div>
                </div>
            </div>
            <div class="hero-image">
                <div class="hero-image-container">
                    <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Worqly Recruitment">
                    <div class="floating-card card-1">
                        <div class="card-icon"><i class="fas fa-briefcase"></i></div>
                        <div class="card-content">
                            <div class="card-title">5000+ Offres</div>
                            <div class="card-subtitle">Mises à jour quotidiennement</div>
                        </div>
                    </div>
                    <div class="floating-card card-2">
                        <div class="card-icon"><i class="fas fa-users"></i></div>
                        <div class="card-content">
                            <div class="card-title">500+ Entreprises</div>
                            <div class="card-subtitle">Partenaires de confiance</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </section>

    <!-- Partners Section -->
    <section class="partners">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Ils nous font confiance</h2>
                <p class="section-subtitle">Rejoignez les entreprises leaders qui utilisent Worqly pour leurs recrutements</p>
            </div>
            <div class="partners-logos">
                <div class="partner-logo">
                    <i class="fab fa-google"></i>
                    <span>Google</span>
                </div>
                <div class="partner-logo">
                    <i class="fab fa-microsoft"></i>
                    <span>Microsoft</span>
                </div>
                <div class="partner-logo">
                    <i class="fab fa-amazon"></i>
                    <span>Amazon</span>
                </div>
                <div class="partner-logo">
                    <i class="fab fa-apple"></i>
                    <span>Apple</span>
                </div>
                <div class="partner-logo">
                    <i class="fab fa-facebook"></i>
                    <span>Meta</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Jobs Section -->
    <section class="featured-jobs" id="jobs">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Offres en vedette</h2>
                <p class="section-subtitle">Découvrez les meilleures opportunités professionnelles du moment</p>
            </div>
            <div class="jobs-container" id="featuredJobsList">
                <!-- Job Card 1 -->
                <div class="job-card">
                    <div class="job-card-header">
                        <div class="job-logo">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div class="job-title">
                            <h3>Développeur Full Stack</h3>
                            <div class="job-company">TechCorp</div>
                        </div>
                    </div>
                    <div class="job-details">
                        <div class="job-detail">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Paris, France</span>
                        </div>
                        <div class="job-detail">
                            <i class="fas fa-clock"></i>
                            <span>Temps plein</span>
                        </div>
                        <div class="job-detail">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Publié le 10 avril 2025</span>
                        </div>
                    </div>
                    <div class="job-description">
                        Nous recherchons un développeur Full Stack expérimenté pour rejoindre notre équipe dynamique.
                    </div>
                    <div class="job-skills">
                        <span class="skill-tag">JavaScript</span>
                        <span class="skill-tag">React</span>
                        <span class="skill-tag">Node.js</span>
                    </div>
                    <div class="job-actions">
                        <button class="btn btn-outline view-job-btn">Voir détails</button>
                        <button class="btn btn-primary apply-job-btn">Postuler</button>
                    </div>
                </div>

                <!-- Job Card 2 -->
                <div class="job-card">
                    <div class="job-card-header">
                        <div class="job-logo">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div class="job-title">
                            <h3>Chef de Projet </h3>
                            <div class="job-company">MarketingPro</div>
                        </div>
                    </div>
                    <div class="job-details">
                        <div class="job-detail">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Lyon, France</span>
                        </div>
                        <div class="job-detail">
                            <i class="fas fa-clock"></i>
                            <span>Temps plein</span>
                        </div>
                        <div class="job-detail">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Publié le 8 avril 2025</span>
                        </div>
                    </div>
                    <div class="job-description">
                        Nous cherchons un chef de projet marketing pour gérer nos campagnes digitales.
                    </div>
                    <div class="job-skills">
                        <span class="skill-tag">SEO</span>
                        <span class="skill-tag">SEM</span>
                        <span class="skill-tag">Social Media</span>
                    </div>
                    <div class="job-actions">
                        <button class="btn btn-outline view-job-btn">Voir détails</button>
                        <button class="btn btn-primary apply-job-btn">Postuler</button>
                    </div>
                </div>

                <!-- Job Card 3 -->
                <div class="job-card">
                    <div class="job-card-header">
                        <div class="job-logo">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div class="job-title">
                            <h3>Data Scientist</h3>
                            <div class="job-company">DataInsight</div>
                        </div>
                    </div>
                    <div class="job-details">
                        <div class="job-detail">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Remote</span>
                        </div>
                        <div class="job-detail">
                            <i class="fas fa-clock"></i>
                            <span>Temps plein</span>
                        </div>
                        <div class="job-detail">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Publié le 5 avril 2025</span>
                        </div>
                    </div>
                    <div class="job-description">
                        Rejoignez notre équipe de data scientists pour analyser et interpréter des données complexes.
                    </div>
                    <div class="job-skills">
                        <span class="skill-tag">Python</span>
                        <span class="skill-tag">Machine Learning</span>
                        <span class="skill-tag">SQL</span>
                    </div>
                    <div class="job-actions">
                        <button class="btn btn-outline view-job-btn">Voir détails</button>
                        <button class="btn btn-primary apply-job-btn">Postuler</button>
                    </div>
                </div>
            </div>
            <div class="view-all-container">
                <button class="btn btn-outline-large">Voir toutes les offres</button>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="how-it-works">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Comment ça marche</h2>
                <p class="section-subtitle">Trouvez votre emploi idéal en quelques étapes simples</p>
            </div>
            <div class="steps-container">
                <div class="step">
                    <div class="step-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div class="step-number">1</div>
                    <h3 class="step-title">Créez votre compte</h3>
                    <p class="step-description">Inscrivez-vous gratuitement et créez votre profil professionnel en quelques minutes.</p>
                </div>
                <div class="step">
                    <div class="step-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <div class="step-number">2</div>
                    <h3 class="step-title">Trouvez des offres</h3>
                    <p class="step-description">Recherchez parmi des milliers d'offres d'emploi correspondant à vos compétences.</p>
                </div>
                <div class="step">
                    <div class="step-icon">
                        <i class="fas fa-paper-plane"></i>
                    </div>
                    <div class="step-number">3</div>
                    <h3 class="step-title">Postulez facilement</h3>
                    <p class="step-description">Envoyez votre candidature en un clic et suivez son statut en temps réel.</p>
                </div>
                <div class="step">
                    <div class="step-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <div class="step-number">4</div>
                    <h3 class="step-title">Décrochez votre emploi</h3>
                    <p class="step-description">Passez des entretiens et recevez des offres d'emploi directement sur la plateforme.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Ce que disent nos utilisateurs</h2>
                <p class="section-subtitle">Découvrez les expériences de ceux qui ont trouvé leur emploi idéal avec Worqly</p>
            </div>
            <div class="testimonials-slider">
                <div class="testimonial-card active">
                    <div class="testimonial-content">
                        <div class="quote-icon"><i class="fas fa-quote-left"></i></div>
                        <p class="testimonial-text">Grâce à Worqly, j'ai trouvé mon emploi de rêve en moins de deux semaines. L'interface est intuitive et les offres sont de qualité.</p>
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Sophie Martin">
                        </div>
                        <div class="author-info">
                            <h4 class="author-name">Sophie Martin</h4>
                            <p class="author-position">Développeuse Web chez TechCorp</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-content">
                        <div class="quote-icon"><i class="fas fa-quote-left"></i></div>
                        <p class="testimonial-text">En tant que recruteur, Worqly m'a permis de trouver des candidats qualifiés rapidement. La plateforme est un véritable atout pour notre entreprise.</p>
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Thomas Dubois">
                        </div>
                        <div class="author-info">
                            <h4 class="author-name">Thomas Dubois</h4>
                            <p class="author-position">Responsable RH chez InnovTech</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-content">
                        <div class="quote-icon"><i class="fas fa-quote-left"></i></div>
                        <p class="testimonial-text">La fonctionnalité de suivi des candidatures est exceptionnelle. J'ai pu gérer mes entretiens et recevoir des retours rapidement.</p>
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Camille Leroy">
                        </div>
                        <div class="author-info">
                            <h4 class="author-name">Camille Leroy</h4>
                            <p class="author-position">Chef de Projet Marketing</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="testimonial-controls">
                <button class="testimonial-control prev"><i class="fas fa-chevron-left"></i></button>
                <div class="testimonial-indicators">
                    <span class="indicator active"></span>
                    <span class="indicator"></span>
                    <span class="indicator"></span>
                </div>
                <button class="testimonial-control next"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats" id="about">
        <div class="container">
            <div class="stats-container">
                <div class="stat-item">
                    <div class="stat-icon"><i class="fas fa-building"></i></div>
                    <div class="stat-number" data-count="500">0</div>
                    <div class="stat-label">Entreprises</div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon"><i class="fas fa-users"></i></div>
                    <div class="stat-number" data-count="10000">0</div>
                    <div class="stat-label">Candidats</div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon"><i class="fas fa-briefcase"></i></div>
                    <div class="stat-number" data-count="5000">0</div>
                    <div class="stat-label">Offres d'emploi</div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon"><i class="fas fa-handshake"></i></div>
                    <div class="stat-number" data-count="3500">0</div>
                    <div class="stat-label">Recrutements réussis</div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <h2 class="section-title">À propos de Worqly</h2>
                    <p class="about-description">
                        Worqly est une plateforme innovante de recrutement qui facilite la mise en relation entre candidats et recruteurs. Notre mission est de simplifier le processus de recrutement et d'aider chacun à trouver sa place idéale dans le monde professionnel.
                    </p>
                    <p class="about-description">
                        Nous offrons des outils puissants pour les recruteurs afin de gérer efficacement leurs offres d'emploi et leurs entretiens, ainsi qu'une expérience intuitive pour les candidats à la recherche de nouvelles opportunités.
                    </p>
                    <div class="about-features">
                        <div class="feature">
                            <div class="feature-icon"><i class="fas fa-check-circle"></i></div>
                            <div class="feature-text">Plateforme intuitive et facile à utiliser</div>
                        </div>
                        <div class="feature">
                            <div class="feature-icon"><i class="fas fa-check-circle"></i></div>
                            <div class="feature-text">Offres d'emploi vérifiées et de qualité</div>
                        </div>
                        <div class="feature">
                            <div class="feature-icon"><i class="fas fa-check-circle"></i></div>
                            <div class="feature-text">Processus de candidature simplifié</div>
                        </div>
                        <div class="feature">
                            <div class="feature-icon"><i class="fas fa-check-circle"></i></div>
                            <div class="feature-text">Suivi en temps réel des candidatures</div>
                        </div>
                    </div>
                    <button class="btn btn-primary">En savoir plus</button>
                </div>
                <div class="about-image">
                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Équipe Worqly">
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="container">
            <div class="cta-content">
                <h2 class="cta-title">Prêt à trouver votre prochain emploi ?</h2>
                <p class="cta-description">Rejoignez des milliers de professionnels qui ont déjà trouvé leur emploi idéal avec Worqly</p>
                <div class="cta-buttons">
                    
                    <a  class="btn btn-light" href="{{ route('register') }}" role="button" id="registerBtn">Créer un compte</a>
                    
                    <button class="btn btn-outline-light" >Explorer les offres</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact" id="contact">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Contactez-nous</h2>
                <p class="section-subtitle">Nous sommes là pour répondre à toutes vos questions</p>
            </div>
            <div class="contact-container">
                <div class="contact-info">
                    <div class="contact-item">
                        <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div class="contact-text">
                            <h3>Adresse</h3>
                            <p>123 Avenue des Champs-Élysées, 75008 Paris, France</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon"><i class="fas fa-phone"></i></div>
                        <div class="contact-text">
                            <h3>Téléphone</h3>
                            <p>+33 1 23 45 67 89</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                        <div class="contact-text">
                            <h3>Email</h3>
                            <p>contact@worqly.com</p>
                        </div>
                    </div>
                    <div class="social-media">
                        <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="contact-form">
                    <form id="contactForm">
                        <div class="form-group">
                            <label for="name">Nom complet</label>
                            <input type="text" id="name" name="name" placeholder="Votre nom" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="Votre email" required>
                        </div>
                        <div class="form-group">
                            <label for="subject">Sujet</label>
                            <input type="text" id="subject" name="subject" placeholder="Sujet de votre message" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" placeholder="Votre message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Envoyer le message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <div class="logo">
                        <img src="{{ asset('images/worqly-logo-white.png') }}" alt="Logo">
                    </div>
                    <p class="footer-description">La plateforme de recrutement qui connecte les talents aux meilleures opportunités professionnelles.</p>
                </div>
                <div class="footer-links">
                    <div class="footer-column">
                        <h3 class="footer-title">Entreprise</h3>
                        <ul class="footer-list">
                            <li><a href="#">À propos</a></li>
                            <li><a href="#">Équipe</a></li>
                            <li><a href="#">Carrières</a></li>
                            <li><a href="#">Blog</a></li>
                        </ul>
                    </div>
                    <div class="footer-column">
                        <h3 class="footer-title">Candidats</h3>
                        <ul class="footer-list">
                            <li><a href="#">Rechercher des offres</a></li>
                            <li><a href="#">Créer un profil</a></li>
                            <li><a href="#">Conseils de carrière</a></li>
                            <li><a href="#">FAQ</a></li>
                        </ul>
                    </div>
                    <div class="footer-column">
                        <h3 class="footer-title">Recruteurs</h3>
                        <ul class="footer-list">
                            <li><a href="#">Publier une offre</a></li>
                            <li><a href="#">Rechercher des candidats</a></li>
                            <li><a href="#">Solutions entreprises</a></li>
                            <li><a href="#">Tarifs</a></li>
                        </ul>
                    </div>
                    <div class="footer-column">
                        <h3 class="footer-title">Support</h3>
                        <ul class="footer-list">
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Aide</a></li>
                            <li><a href="#">Politique de confidentialité</a></li>
                            <li><a href="#">Conditions d'utilisation</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="copyright">
                    &copy; 2025 Worqly. Tous droits réservés.
                </div>
                <div class="footer-social">
                    <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Authentication Modal -->
    <div class="modal" id="authModal">
        <div class="modal-content">
            <div class="modal-header">
                <div class="tabs">
                    <button class="tab-btn active" data-tab="login">Connexion</button>
                    <button class="tab-btn" data-tab="register">Inscription</button>
                </div>
                <button class="close-modal">&times;</button>
            </div>
            <div class="modal-body">
                <!-- Login Tab -->
                <div class="tab-content" id="login-tab">
                    <form id="loginForm">
                        <div class="form-group">
                            <label for="loginEmail">Email</label>
                            <input type="email" id="loginEmail" name="email" placeholder="Votre email" required>
                        </div>
                        <div class="form-group">
                            <label for="loginPassword">Mot de passe</label>
                            <input type="password" id="loginPassword" name="password" placeholder="Votre mot de passe" required>
                        </div>
                        <div class="form-options">
                            <div class="remember-me">
                                <input type="checkbox" id="rememberMe" name="rememberMe">
                                <label for="rememberMe">Se souvenir de moi</label>
                            </div>
                            <a href="#" class="forgot-password">Mot de passe oublié ?</a>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
                    </form>
                    <div class="social-login">
                        <p>Ou connectez-vous avec</p>
                        <div class="social-buttons">
                            <button class="social-btn google"><i class="fab fa-google"></i> Google</button>
                            <button class="social-btn linkedin"><i class="fab fa-linkedin-in"></i> LinkedIn</button>
                        </div>
                    </div>
                </div>
                
                <!-- Register Tab -->
                <div class="tab-content hidden" id="register-tab">
                    <form id="registerForm">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="registerNom">Nom</label>
                                <input type="text" id="registerNom" name="nom" placeholder="Votre nom" required>
                            </div>
                            <div class="form-group">
                                <label for="registerPrenom">Prénom</label>
                                <input type="text" id="registerPrenom" name="prenom" placeholder="Votre prénom" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="registerEmail">Email</label>
                            <input type="email" id="registerEmail" name="email" placeholder="Votre email" required>
                        </div>
                        <div class="form-group">
                            <label for="registerPassword">Mot de passe</label>
                            <input type="password" id="registerPassword" name="password" placeholder="Votre mot de passe" required>
                        </div>
                        <div class="form-group">
                            <label for="registerConfirmPassword">Confirmer le mot de passe</label>
                            <input type="password" id="registerConfirmPassword" name="confirmPassword" placeholder="Confirmez votre mot de passe" required>
                        </div>
                        <div class="form-group">
                            <label for="registerRole">Je suis un</label>
                            <select id="registerRole" name="role" required>
                                <option value="">Sélectionnez votre profil</option>
                                <option value="candidat">Candidat</option>
                                <option value="recruteur">Recruteur</option>
                            </select>
                        </div>
                        <div class="form-options">
                            <div class="terms-agree">
                                <input type="checkbox" id="termsAgree" name="termsAgree" required>
                                <label for="termsAgree">J'accepte les <a href="#">conditions d'utilisation</a> et la <a href="#">politique de confidentialité</a></label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">S'inscrire</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/enhanced_app.js') }}"></script>



</body>
</html>