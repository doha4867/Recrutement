/**
 * Worqly - Enhanced JavaScript with Animations
 * Interactive features and animations for the enhanced homepage
 */

// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Initialize the application
    initApp();
});

// Initialize the application
function initApp() {
    // Hide loader after page is loaded
    setTimeout(hideLoader, 2500);
    
    // Initialize navigation
    initNavigation();
    
    // Initialize testimonials slider
    initTestimonialsSlider();
    
    // Initialize stats counter
    initStatsCounter();
    
    // Initialize authentication modal
    initAuthModal();
    
    // Initialize scroll animations
    initScrollAnimations();
}

// Hide the loader
function hideLoader() {
    const loader = document.querySelector('.loader-container');
    loader.style.opacity = '0';
    setTimeout(() => {
        loader.style.display = 'none';
    }, 500);
}

// Initialize navigation
function initNavigation() {
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const navMenu = document.querySelector('.nav-menu');
    
    // Toggle mobile menu
    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', function() {
            this.classList.toggle('active');
            navMenu.classList.toggle('active');
        });
    }
    
    // Smooth scroll for navigation links
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
            if (targetId && targetId !== '#') {
                e.preventDefault();
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
                
                // Close mobile menu if open
                if (navMenu.classList.contains('active')) {
                    navMenu.classList.remove('active');
                    mobileMenuToggle.classList.remove('active');
                }
            }
        });
    });
    
    // Change navbar style on scroll
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            navbar.style.padding = '0.5rem 0';
            navbar.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
        } else {
            navbar.style.padding = '1rem 0';
            navbar.style.boxShadow = 'none';
        }
    });
}

// Initialize testimonials slider
function initTestimonialsSlider() {
    const testimonialCards = document.querySelectorAll('.testimonial-card');
    const indicators = document.querySelectorAll('.indicator');
    const prevBtn = document.querySelector('.testimonial-control.prev');
    const nextBtn = document.querySelector('.testimonial-control.next');
    let currentIndex = 0;
    
    // Show testimonial at specified index
    function showTestimonial(index) {
        // Hide all testimonials
        testimonialCards.forEach(card => {
            card.classList.remove('active');
        });
        
        // Deactivate all indicators
        indicators.forEach(indicator => {
            indicator.classList.remove('active');
        });
        
        // Show current testimonial
        testimonialCards[index].classList.add('active');
        indicators[index].classList.add('active');
        currentIndex = index;
    }
    
    // Event listeners for controls
    if (prevBtn) {
        prevBtn.addEventListener('click', function() {
            let newIndex = currentIndex - 1;
            if (newIndex < 0) {
                newIndex = testimonialCards.length - 1;
            }
            showTestimonial(newIndex);
        });
    }
    
    if (nextBtn) {
        nextBtn.addEventListener('click', function() {
            let newIndex = currentIndex + 1;
            if (newIndex >= testimonialCards.length) {
                newIndex = 0;
            }
            showTestimonial(newIndex);
        });
    }
    
    // Event listeners for indicators
    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', function() {
            showTestimonial(index);
        });
    });
    
    // Auto slide every 5 seconds
    setInterval(function() {
        let newIndex = currentIndex + 1;
        if (newIndex >= testimonialCards.length) {
            newIndex = 0;
        }
        showTestimonial(newIndex);
    }, 5000);
}

// Initialize stats counter
function initStatsCounter() {
    const statNumbers = document.querySelectorAll('.stat-number');
    
    // Check if element is in viewport
    function isInViewport(element) {
        const rect = element.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }
    
    // Animate counter
    function animateCounter(element) {
        const target = parseInt(element.getAttribute('data-count'));
        const duration = 2000; // 2 seconds
        const step = target / (duration / 16); // 60fps
        let current = 0;
        
        const timer = setInterval(function() {
            current += step;
            if (current >= target) {
                element.textContent = target.toLocaleString();
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(current).toLocaleString();
            }
        }, 16);
    }
    
    // Start counter when in viewport
    function checkCounters() {
        statNumbers.forEach(statNumber => {
            if (isInViewport(statNumber) && !statNumber.classList.contains('counted')) {
                animateCounter(statNumber);
                statNumber.classList.add('counted');
            }
        });
    }
    
    // Check on scroll
    window.addEventListener('scroll', checkCounters);
    
    // Initial check
    checkCounters();
}

// Initialize authentication modal
function initAuthModal() {
    const loginBtn = document.getElementById('loginBtn');
    const registerBtn = document.getElementById('registerBtn');
    const authModal = document.getElementById('authModal');
    const closeModal = document.querySelector('.close-modal');
    const tabBtns = document.querySelectorAll('.tab-btn');
    
    // // Open modal with login tab
    // if (loginBtn) {
    //     loginBtn.addEventListener('click', function() {
    //         authModal.classList.add('active');
    //         showTab('login');
    //     });
    // }
    
    // // Open modal with register tab
    // if (registerBtn) {
    //     registerBtn.addEventListener('click', function() {
    //         authModal.classList.add('active');
    //         showTab('register');
    //     });
    // }
    
    // // Close modal
    // if (closeModal) {
    //     closeModal.addEventListener('click', function() {
    //         authModal.classList.remove('active');
    //     });
    // }
    
    // // Close modal when clicking outside
    // window.addEventListener('click', function(e) {
    //     if (e.target === authModal) {
    //         authModal.classList.remove('active');
    //     }
    // });
    
    // Switch tabs
    function showTab(tabId) {
        // Deactivate all tabs
        tabBtns.forEach(btn => {
            btn.classList.remove('active');
        });
        
        // Hide all tab contents
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden');
        });
        
        // Activate selected tab
        document.querySelector(`.tab-btn[data-tab="${tabId}"]`).classList.add('active');
        document.getElementById(`${tabId}-tab`).classList.remove('hidden');
    }
    
    // Tab button click event
    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const tabId = this.getAttribute('data-tab');
            showTab(tabId);
        });
    });
    
    // Form submission
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            // In a real application, this would send a request to the server
            alert('Connexion réussie! Redirection vers votre tableau de bord...');
            authModal.classList.remove('active');
        });
    }
    
    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            e.preventDefault();
            // In a real application, this would send a request to the server
            alert('Inscription réussie! Bienvenue sur Worqly!');
            authModal.classList.remove('active');
        });
    }
}

// Initialize scroll animations
function initScrollAnimations() {
    // Get all elements that need to be animated
    const animatedElements = document.querySelectorAll('.partner-logo, .job-card, .step, .stat-item');
    
    // Check if element is in viewport
    function isInViewport(element) {
        const rect = element.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }
    
    // Add animation class when element is in viewport
    function checkAnimations() {
        animatedElements.forEach(element => {
            if (isInViewport(element) && !element.classList.contains('animated')) {
                element.style.opacity = '1';
                element.style.transform = 'translateY(0)';
                element.classList.add('animated');
            }
        });
    }
    
    // Check on scroll
    window.addEventListener('scroll', checkAnimations);
    
    // Initial check
    checkAnimations();
}

// Job application functionality
function initJobApplication() {
    const applyBtns = document.querySelectorAll('.apply-job-btn');
    const viewBtns = document.querySelectorAll('.view-job-btn');
    
    // Apply button click event
    applyBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const jobId = this.getAttribute('data-id');
            // In a real application, this would open a job application modal
            alert('Pour postuler à cette offre, veuillez vous connecter ou créer un compte.');
            document.getElementById('loginBtn').click();
        });
    });
    
    // View button click event
    viewBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const jobId = this.getAttribute('data-id');
            // In a real application, this would open a job details modal
            alert('Affichage des détails de l\'offre...');
        });
    });
}

// Contact form submission
function initContactForm() {
    const contactForm = document.getElementById('contactForm');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            // In a real application, this would send a request to the server
            alert('Votre message a été envoyé avec succès! Nous vous répondrons dans les plus brefs délais.');
            contactForm.reset();
        });
    }
}

// Initialize job application functionality
initJobApplication();

// Initialize contact form
initContactForm();