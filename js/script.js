// Variables globales pour stocker les données
let candidates = [];
let jobs = [];
let activities = [];
let settings = {
    companyName: "Votre Entreprise",
    companyEmail: "contact@entreprise.com",
    companyLogo: "img/avatar.png",
    notifications: {
        newCandidate: true,
        interview: true,
        jobExpiry: true
    }
};

// Initialisation de l'application
document.addEventListener('DOMContentLoaded', function() {
    // Charger les données depuis le stockage local
    loadData();
    
    // Initialiser les graphiques
    initCharts();
    
    // Mettre à jour les compteurs du tableau de bord
    updateDashboardStats();
    
    // Remplir les tableaux de données
    renderCandidatesTable();
    renderJobsTable();
    
    // Remplir la liste des activités récentes
    renderActivitiesList();
    
    // Initialiser les événements de navigation
    initNavigation();
    
    // Initialiser les événements des modals
    initModals();
    
    // Initialiser les événements des formulaires
    initForms();
    
    // Initialiser les événements de recherche et filtrage
    initSearchAndFilter();
    
    // Initialiser les événements d'exportation
    initExport();
});

// Fonction pour charger les données depuis le stockage local
function loadData() {
    if (localStorage.getItem('candidates')) {
        candidates = JSON.parse(localStorage.getItem('candidates'));
    } else {
        // Données de démonstration pour les candidats
        candidates = [
            {
                id: 1,
                name: "Jean Dupont",
                email: "jean.dupont@email.com",
                phone: "06 12 34 56 78",
                job: "Développeur Frontend",
                status: "interview",
                date: "2025-03-15",
                resume: "",
                notes: "Candidat très prometteur avec 5 ans d'expérience en React."
            },
            {
                id: 2,
                name: "Marie Martin",
                email: "marie.martin@email.com",
                phone: "07 23 45 67 89",
                job: "Chef de Projet",
                status: "reviewing",
                date: "2025-03-20",
                resume: "",
                notes: "Expérience en gestion d'équipe et méthodologies agiles."
            },
            {
                id: 3,
                name: "Pierre Durand",
                email: "pierre.durand@email.com",
                phone: "06 34 56 78 90",
                job: "Développeur Backend",
                status: "new",
                date: "2025-04-01",
                resume: "",
                notes: "Spécialiste en Node.js et bases de données NoSQL."
            }
        ];
        saveData('candidates');
    }
    
    if (localStorage.getItem('jobs')) {
        jobs = JSON.parse(localStorage.getItem('jobs'));
    } else {
        // Données de démonstration pour les offres d'emploi
        jobs = [
            {
                id: 1,
                title: "Développeur Frontend",
                department: "Ingénierie",
                location: "Paris",
                type: "full-time",
                date: "2025-03-01",
                status: "active",
                applications: 5,
                description: "Nous recherchons un développeur frontend expérimenté pour rejoindre notre équipe.",
                requirements: "Expérience en React, HTML, CSS et JavaScript.",
                salary: "45 000€ - 55 000€"
            },
            {
                id: 2,
                title: "Chef de Projet",
                department: "Produit",
                location: "Lyon",
                type: "full-time",
                date: "2025-03-10",
                status: "active",
                applications: 3,
                description: "Poste de chef de projet pour gérer le développement de nos nouveaux produits.",
                requirements: "Expérience en gestion de projet et méthodologies agiles.",
                salary: "50 000€ - 60 000€"
            },
            {
                id: 3,
                title: "Développeur Backend",
                department: "Ingénierie",
                location: "Bordeaux",
                type: "full-time",
                date: "2025-03-15",
                status: "active",
                applications: 2,
                description: "Développeur backend pour notre équipe d'ingénierie.",
                requirements: "Expérience en Node.js, Express et bases de données.",
                salary: "45 000€ - 55 000€"
            }
        ];
        saveData('jobs');
    }
    
    if (localStorage.getItem('activities')) {
        activities = JSON.parse(localStorage.getItem('activities'));
    } else {
        // Données de démonstration pour les activités
        activities = [
            {
                id: 1,
                type: "candidate",
                action: "add",
                subject: "Jean Dupont",
                date: "2025-04-01T10:30:00",
                details: "Nouveau candidat ajouté pour le poste de Développeur Frontend"
            },
            {
                id: 2,
                type: "job",
                action: "update",
                subject: "Chef de Projet",
                date: "2025-04-01T11:15:00",
                details: "Offre d'emploi mise à jour"
            },
            {
                id: 3,
                type: "candidate",
                action: "status",
                subject: "Marie Martin",
                date: "2025-04-01T14:45:00",
                details: "Statut changé à 'En cours d'évaluation'"
            }
        ];
        saveData('activities');
    }
    
    if (localStorage.getItem('settings')) {
        settings = JSON.parse(localStorage.getItem('settings'));
    } else {
        saveData('settings');
    }
}

// Fonction pour sauvegarder les données dans le stockage local
function saveData(dataType) {
    switch(dataType) {
        case 'candidates':
            localStorage.setItem('candidates', JSON.stringify(candidates));
            break;
        case 'jobs':
            localStorage.setItem('jobs', JSON.stringify(jobs));
            break;
        case 'activities':
            localStorage.setItem('activities', JSON.stringify(activities));
            break;
        case 'settings':
            localStorage.setItem('settings', JSON.stringify(settings));
            break;
    }
}

// Fonction pour ajouter une nouvelle activité
function addActivity(type, action, subject, details) {
    const activity = {
        id: activities.length > 0 ? Math.max(...activities.map(a => a.id)) + 1 : 1,
        type,
        action,
        subject,
        date: new Date().toISOString(),
        details
    };
    
    activities.unshift(activity);
    
    // Limiter à 20 activités maximum
    if (activities.length > 20) {
        activities = activities.slice(0, 20);
    }
    
    saveData('activities');
    renderActivitiesList();
}

// Fonction pour mettre à jour les compteurs du tableau de bord
function updateDashboardStats() {
    document.querySelector('.stat-card:nth-child(1) .count').textContent = candidates.length;
    document.querySelector('.stat-card:nth-child(2) .count').textContent = jobs.length;
    
    // Calculer le nombre total de candidatures
    const totalApplications = jobs.reduce((sum, job) => sum + job.applications, 0);
    document.querySelector('.stat-card:nth-child(3) .count').textContent = totalApplications;
    
    // Calculer le nombre d'entretiens
    const interviewCount = candidates.filter(candidate => candidate.status === 'interview').length;
    document.querySelector('.stat-card:nth-child(4) .count').textContent = interviewCount;
}

// Fonction pour initialiser les graphiques
function initCharts() {
    // Graphique des candidatures par poste
    const jobLabels = jobs.map(job => job.title);
    const applicationData = jobs.map(job => job.applications);
    
    const jobApplicationsChart = new Chart(
        document.getElementById('jobApplicationsChart'),
        {
            type: 'bar',
            data: {
                labels: jobLabels,
                datasets: [{
                    label: 'Nombre de candidatures',
                    data: applicationData,
                    backgroundColor: 'rgba(74, 108, 247, 0.7)',
                    borderColor: 'rgba(74, 108, 247, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        }
    );
    
    // Graphique du statut des candidatures
    const statusLabels = ['Nouveau', 'En évaluation', 'Entretien', 'Offre envoyée', 'Embauché', 'Rejeté'];
    const statusCounts = [
        candidates.filter(c => c.status === 'new').length,
        candidates.filter(c => c.status === 'reviewing').length,
        candidates.filter(c => c.status === 'interview').length,
        candidates.filter(c => c.status === 'offered').length,
        candidates.filter(c => c.status === 'hired').length,
        candidates.filter(c => c.status === 'rejected').length
    ];
    
    const applicationStatusChart = new Chart(
        document.getElementById('applicationStatusChart'),
        {
            type: 'doughnut',
            data: {
                labels: statusLabels,
                datasets: [{
                    data: statusCounts,
                    backgroundColor: [
                        'rgba(23, 162, 184, 0.7)',
                        'rgba(255, 193, 7, 0.7)',
                        'rgba(74, 108, 247, 0.7)',
                        'rgba(40, 167, 69, 0.7)',
                        'rgba(40, 167, 69, 0.9)',
                        'rgba(220, 53, 69, 0.7)'
                    ],
                    borderColor: [
                        'rgba(23, 162, 184, 1)',
                        'rgba(255, 193, 7, 1)',
                        'rgba(74, 108, 247, 1)',
                        'rgba(40, 167, 69, 1)',
                        'rgba(40, 167, 69, 1)',
                        'rgba(220, 53, 69, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right',
                    }
                }
            }
        }
    );
}

// Fonction pour afficher la liste des activités récentes
function renderActivitiesList() {
    const activitiesList = document.getElementById('activities-list');
    activitiesList.innerHTML = '';
    
    if (activities.length === 0) {
        activitiesList.innerHTML = '<li>Aucune activité récente</li>';
        return;
    }
    
    activities.forEach(activity => {
        const li = document.createElement('li');
        
        // Déterminer l'icône et la couleur en fonction du type et de l'action
        let iconClass = '';
        let bgColor = '';
        
        if (activity.type === 'candidate') {
            if (activity.action === 'add') {
                iconClass = 'fas fa-user-plus';
                bgColor = 'rgba(40, 167, 69, 0.1)';
            } else if (activity.action === 'update') {
                iconClass = 'fas fa-user-edit';
                bgColor = 'rgba(74, 108, 247, 0.1)';
            } else if (activity.action === 'status') {
                iconClass = 'fas fa-exchange-alt';
                bgColor = 'rgba(255, 193, 7, 0.1)';
            } else if (activity.action === 'delete') {
                iconClass = 'fas fa-user-minus';
                bgColor = 'rgba(220, 53, 69, 0.1)';
            }
        } else if (activity.type === 'job') {
            if (activity.action === 'add') {
                iconClass = 'fas fa-briefcase-medical';
                bgColor = 'rgba(40, 167, 69, 0.1)';
            } else if (activity.action === 'update') {
                iconClass = 'fas fa-edit';
                bgColor = 'rgba(74, 108, 247, 0.1)';
            } else if (activity.action === 'delete') {
                iconClass = 'fas fa-trash-alt';
                bgColor = 'rgba(220, 53, 69, 0.1)';
            }
        }
        
        // Formater la date
        const activityDate = new Date(activity.date);
        const formattedDate = activityDate.toLocaleDateString('fr-FR', {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
        
        li.innerHTML = `
            <div class="activity-icon" style="background-color: ${bgColor}; color: var(--primary-color);">
                <i class="${iconClass}"></i>
            </div>
            <div class="activity-info">
                <div>${activity.details}</div>
                <div class="activity-time">${formattedDate}</div>
            </div>
        `;
        
        activitiesList.appendChild(li);
    });
}

// Fonction pour afficher le tableau des candidats
function renderCandidatesTable() {
    const tbody = document.querySelector('#candidates-table tbody');
    tbody.innerHTML = '';
    
    if (candidates.length === 0) {
        const tr = document.createElement('tr');
        tr.innerHTML = '<td colspan="7" style="text-align: center;">Aucun candidat trouvé</td>';
        tbody.appendChild(tr);
        return;
    }
    
    // Récupérer les filtres actifs
    const searchTerm = document.getElementById('candidate-search').value.toLowerCase();
    const statusFilter = document.getElementById('candidate-filter').value;
    
    // Filtrer les candidats
    let filteredCandidates = candidates;
    
    if (searchTerm) {
        filteredCandidates = filteredCandidates.filter(candidate => 
            candidate.name.toLowerCase().includes(searchTerm) ||
            candidate.email.toLowerCase().includes(searchTerm) ||
            candidate.job.toLowerCase().includes(searchTerm)
        );
    }
    
    if (statusFilter !== 'all') {
        filteredCandidates = filteredCandidates.filter(candidate => candidate.status === statusFilter);
    }
    
    // Afficher les candidats filtrés
    filteredCandidates.forEach(candidate => {
        const tr = document.createElement('tr');
        
        // Formater la date
        const candidateDate = new Date(candidate.date);
        const formattedDate = candidateDate.toLocaleDateString('fr-FR', {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric'
        });
        
        // Déterminer le texte et la classe du statut
        let statusText = '';
        let statusClass = '';
        
        switch(candidate.status) {
            case 'new':
                statusText = 'Nouveau';
                statusClass = 'status-new';
                break;
            case 'reviewing':
                statusText = 'En évaluation';
                statusClass = 'status-reviewing';
                break;
            case 'interview':
                statusText = 'Entretien';
                statusClass = 'status-interview';
                break;
            case 'offered':
                statusText = 'Offre envoyée';
                statusClass = 'status-offered';
                break;
            case 'hired':
                statusText = 'Embauché';
                statusClass = 'status-hired';
                break;
            case 'rejected':
                statusText = 'Rejeté';
                statusClass = 'status-rejected';
                break;
        }
        
        tr.innerHTML = `
            <td>${candidate.name}</td>
            <td>${candidate.email}</td>
            <td>${candidate.phone}</td>
            <td>${candidate.job}</td>
            <td><span class="status-badge ${statusClass}">${statusText}</span></td>
            <td>${formattedDate}</td>
            <td>
                <div class="action-buttons">
                    <button class="action-btn view" data-id="${candidate.id}" title="Voir"><i class="fas fa-eye"></i></button>
                    <button class="action-btn edit" data-id="${candidate.id}" title="Modifier"><i class="fas fa-edit"></i></button>
                    <button class="action-btn delete" data-id="${candidate.id}" title="Supprimer"><i class="fas fa-trash-alt"></i></button>
                </div>
            </td>
        `;
        
        tbody.appendChild(tr);
    });
    
    // Ajouter les événements aux boutons d'action
    document.querySelectorAll('#candidates-table .action-btn.edit').forEach(button => {
        button.addEventListener('click', function() {
            const candidateId = parseInt(this.getAttribute('data-id'));
            editCandidate(candidateId);
        });
    });
    
    document.querySelectorAll('#candidates-table .action-btn.delete').forEach(button => {
        button.addEventListener('click', function() {
            const candidateId = parseInt(this.getAttribute('data-id'));
            deleteCandidate(candidateId);
        });
    });
    
    document.querySelectorAll('#candidates-table .action-btn.view').forEach(button => {
        button.addEventListener('click', function() {
            const candidateId = parseInt(this.getAttribute('data-id'));
            viewCandidate(candidateId);
        });
    });
}

// Fonction pour afficher le tableau des offres d'emploi
function renderJobsTable() {
    const tbody = document.querySelector('#jobs-table tbody');
    tbody.innerHTML = '';
    
    if (jobs.length === 0) {
        const tr = document.createElement('tr');
        tr.innerHTML = '<td colspan="8" style="text-align: center;">Aucune offre d\'emploi trouvée</td>';
        tbody.appendChild(tr);
        return;
    }
    
    // Récupérer les filtres actifs
    const searchTerm = document.getElementById('job-search').value.toLowerCase();
    const statusFilter = document.getElementById('job-filter').value;
    
    // Filtrer les offres d'emploi
    let filteredJobs = jobs;
    
    if (searchTerm) {
        filteredJobs = filteredJobs.filter(job => 
            job.title.toLowerCase().includes(searchTerm) ||
            job.department.toLowerCase().includes(searchTerm) ||
            job.location.toLowerCase().includes(searchTerm)
        );
    }
    
    if (statusFilter !== 'all') {
        filteredJobs = filteredJobs.filter(job => job.status === statusFilter);
    }
    
    // Afficher les offres d'emploi filtrées
    filteredJobs.forEach(job => {
        const tr = document.createElement('tr');
        
        // Formater la date
        const jobDate = new Date(job.date);
        const formattedDate = jobDate.toLocaleDateString('fr-FR', {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric'
        });
        
        // Déterminer le texte et la classe du statut
        let statusText = '';
        let statusClass = '';
        
        switch(job.status) {
            case 'active':
                statusText = 'Active';
                statusClass = 'status-active';
                break;
            case 'draft':
                statusText = 'Brouillon';
                statusClass = 'status-draft';
                break;
            case 'closed':
                statusText = 'Fermée';
                statusClass = 'status-closed';
                break;
        }
        
        // Déterminer le texte du type de contrat
        let typeText = '';
        
        switch(job.type) {
            case 'full-time':
                typeText = 'CDI';
                break;
            case 'part-time':
                typeText = 'CDD';
                break;
            case 'contract':
                typeText = 'Intérim';
                break;
            case 'internship':
                typeText = 'Stage';
                break;
            case 'apprenticeship':
                typeText = 'Alternance';
                break;
        }
        
        tr.innerHTML = `
            <td>${job.title}</td>
            <td>${job.department}</td>
            <td>${job.location}</td>
            <td>${typeText}</td>
            <td>${formattedDate}</td>
            <td><span class="status-badge ${statusClass}">${statusText}</span></td>
            <td>${job.applications}</td>
            <td>
                <div class="action-buttons">
                    <button class="action-btn view" data-id="${job.id}" title="Voir"><i class="fas fa-eye"></i></button>
                    <button class="action-btn edit" data-id="${job.id}" title="Modifier"><i class="fas fa-edit"></i></button>
                    <button class="action-btn delete" data-id="${job.id}" title="Supprimer"><i class="fas fa-trash-alt"></i></button>
                </div>
            </td>
        `;
        
        tbody.appendChild(tr);
    });
    
    // Ajouter les événements aux boutons d'action
    document.querySelectorAll('#jobs-table .action-btn.edit').forEach(button => {
        button.addEventListener('click', function() {
            const jobId = parseInt(this.getAttribute('data-id'));
            editJob(jobId);
        });
    });
    
    document.querySelectorAll('#jobs-table .action-btn.delete').forEach(button => {
        button.addEventListener('click', function() {
            const jobId = parseInt(this.getAttribute('data-id'));
            deleteJob(jobId);
        });
    });
    
    document.querySelectorAll('#jobs-table .action-btn.view').forEach(button => {
        button.addEventListener('click', function() {
            const jobId = parseInt(this.getAttribute('data-id'));
            viewJob(jobId);
        });
    });
}

// Fonction pour initialiser la navigation
function initNavigation() {
    const navLinks = document.querySelectorAll('nav ul li a');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Supprimer la classe active de tous les liens
            navLinks.forEach(link => link.classList.remove('active'));
            
            // Ajouter la classe active au lien cliqué
            this.classList.add('active');
            
            // Récupérer l'ID de la section à afficher
            const sectionId = this.getAttribute('href').substring(1);
            
            // Masquer toutes les sections
            document.querySelectorAll('main section').forEach(section => {
                section.classList.remove('active');
            });
            
            // Afficher la section correspondante
            document.getElementById(sectionId).classList.add('active');
        });
    });
}

// Fonction pour initialiser les modals
function initModals() {
    // Modal des candidats
    const candidateModal = document.getElementById('candidate-modal');
    const addCandidateBtn = document.getElementById('add-candidate-btn');
    const closeCandidateBtn = document.querySelector('#candidate-modal .close');
    const cancelCandidateBtn = document.getElementById('cancel-candidate');
    
    addCandidateBtn.addEventListener('click', function() {
        document.getElementById('candidate-modal-title').textContent = 'Ajouter un candidat';
        document.getElementById('candidate-form').reset();
        document.getElementById('candidate-id').value = '';
        
        // Remplir le select des postes
        const jobSelect = document.getElementById('candidate-job');
        jobSelect.innerHTML = '';
        jobs.forEach(job => {
            const option = document.createElement('option');
            option.value = job.title;
            option.textContent = job.title;
            jobSelect.appendChild(option);
        });
        
        candidateModal.style.display = 'block';
    });
    
    closeCandidateBtn.addEventListener('click', function() {
        candidateModal.style.display = 'none';
    });
    
    cancelCandidateBtn.addEventListener('click', function() {
        candidateModal.style.display = 'none';
    });
    
    // Modal des offres d'emploi
    const jobModal = document.getElementById('job-modal');
    const addJobBtn = document.getElementById('add-job-btn');
    const closeJobBtn = document.querySelector('#job-modal .close');
    const cancelJobBtn = document.getElementById('cancel-job');
    
    addJobBtn.addEventListener('click', function() {
        document.getElementById('job-modal-title').textContent = 'Ajouter une offre d\'emploi';
        document.getElementById('job-form').reset();
        document.getElementById('job-id').value = '';
        jobModal.style.display = 'block';
    });
    
    closeJobBtn.addEventListener('click', function() {
        jobModal.style.display = 'none';
    });
    
    cancelJobBtn.addEventListener('click', function() {
        jobModal.style.display = 'none';
    });
    
    // Fermer les modals en cliquant en dehors
    window.addEventListener('click', function(event) {
        if (event.target === candidateModal) {
            candidateModal.style.display = 'none';
        }
        if (event.target === jobModal) {
            jobModal.style.display = 'none';
        }
    });
}

// Fonction pour initialiser les formulaires
function initForms() {
    // Formulaire des candidats
    const candidateForm = document.getElementById('candidate-form');
    
    candidateForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const candidateId = document.getElementById('candidate-id').value;
        const name = document.getElementById('candidate-name').value;
        const email = document.getElementById('candidate-email').value;
        const phone = document.getElementById('candidate-phone').value;
        const job = document.getElementById('candidate-job').value;
        const status = document.getElementById('candidate-status').value;
        const notes = document.getElementById('candidate-notes').value;
        
        if (candidateId) {
            // Modification d'un candidat existant
            const index = candidates.findIndex(c => c.id === parseInt(candidateId));
            
            if (index !== -1) {
                const oldStatus = candidates[index].status;
                
                candidates[index].name = name;
                candidates[index].email = email;
                candidates[index].phone = phone;
                candidates[index].job = job;
                candidates[index].status = status;
                candidates[index].notes = notes;
                
                saveData('candidates');
                
                // Ajouter une activité
                if (oldStatus !== status) {
                    addActivity('candidate', 'status', name, `Statut de ${name} changé à '${getStatusText(status)}'`);
                } else {
                    addActivity('candidate', 'update', name, `Candidat ${name} mis à jour`);
                }
            }
        } else {
            // Ajout d'un nouveau candidat
            const newCandidate = {
                id: candidates.length > 0 ? Math.max(...candidates.map(c => c.id)) + 1 : 1,
                name,
                email,
                phone,
                job,
                status,
                date: new Date().toISOString().split('T')[0],
                resume: '',
                notes
            };
            
            candidates.push(newCandidate);
            saveData('candidates');
            
            // Ajouter une activité
            addActivity('candidate', 'add', name, `Nouveau candidat ${name} ajouté pour le poste de ${job}`);
            
            // Mettre à jour le nombre de candidatures pour ce poste
            const jobIndex = jobs.findIndex(j => j.title === job);
            if (jobIndex !== -1) {
                jobs[jobIndex].applications++;
                saveData('jobs');
            }
        }
        
        // Fermer la modal
        document.getElementById('candidate-modal').style.display = 'none';
        
        // Mettre à jour l'interface
        renderCandidatesTable();
        updateDashboardStats();
        initCharts();
    });
    
    // Formulaire des offres d'emploi
    const jobForm = document.getElementById('job-form');
    
    jobForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const jobId = document.getElementById('job-id').value;
        const title = document.getElementById('job-title').value;
        const department = document.getElementById('job-department').value;
        const location = document.getElementById('job-location').value;
        const type = document.getElementById('job-type').value;
        const status = document.getElementById('job-status').value;
        const description = document.getElementById('job-description').value;
        const requirements = document.getElementById('job-requirements').value;
        const salary = document.getElementById('job-salary').value;
        
        if (jobId) {
            // Modification d'une offre existante
            const index = jobs.findIndex(j => j.id === parseInt(jobId));
            
            if (index !== -1) {
                jobs[index].title = title;
                jobs[index].department = department;
                jobs[index].location = location;
                jobs[index].type = type;
                jobs[index].status = status;
                jobs[index].description = description;
                jobs[index].requirements = requirements;
                jobs[index].salary = salary;
                
                saveData('jobs');
                
                // Ajouter une activité
                addActivity('job', 'update', title, `Offre d'emploi ${title} mise à jour`);
            }
        } else {
            // Ajout d'une nouvelle offre
            const newJob = {
                id: jobs.length > 0 ? Math.max(...jobs.map(j => j.id)) + 1 : 1,
                title,
                department,
                location,
                type,
                status,
                date: new Date().toISOString().split('T')[0],
                applications: 0,
                description,
                requirements,
                salary
            };
            
            jobs.push(newJob);
            saveData('jobs');
            
            // Ajouter une activité
            addActivity('job', 'add', title, `Nouvelle offre d'emploi ${title} ajoutée`);
        }
        
        // Fermer la modal
        document.getElementById('job-modal').style.display = 'none';
        
        // Mettre à jour l'interface
        renderJobsTable();
        updateDashboardStats();
        initCharts();
    });
    
    // Formulaire des paramètres généraux
    const generalSettingsForm = document.getElementById('general-settings-form');
    
    generalSettingsForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        settings.companyName = document.getElementById('company-name').value;
        settings.companyEmail = document.getElementById('company-email').value;
        
        saveData('settings');
        
        alert('Paramètres enregistrés avec succès !');
    });
    
    // Formulaire des notifications
    const notificationSettingsForm = document.getElementById('notification-settings-form');
    
    notificationSettingsForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        settings.notifications.newCandidate = document.getElementById('notify-new-candidate').checked;
        settings.notifications.interview = document.getElementById('notify-interview').checked;
        settings.notifications.jobExpiry = document.getElementById('notify-job-expiry').checked;
        
        saveData('settings');
        
        alert('Paramètres de notification enregistrés avec succès !');
    });
}

// Fonction pour initialiser la recherche et le filtrage
function initSearchAndFilter() {
    // Recherche de candidats
    const candidateSearch = document.getElementById('candidate-search');
    candidateSearch.addEventListener('input', function() {
        renderCandidatesTable();
    });
    
    // Filtre de candidats
    const candidateFilter = document.getElementById('candidate-filter');
    candidateFilter.addEventListener('change', function() {
        renderCandidatesTable();
    });
    
    // Recherche d'offres d'emploi
    const jobSearch = document.getElementById('job-search');
    jobSearch.addEventListener('input', function() {
        renderJobsTable();
    });
    
    // Filtre d'offres d'emploi
    const jobFilter = document.getElementById('job-filter');
    jobFilter.addEventListener('change', function() {
        renderJobsTable();
    });
}

// Fonction pour initialiser l'exportation
function initExport() {
    // Exportation des candidats
    const exportCandidatesBtn = document.getElementById('export-candidates');
    exportCandidatesBtn.addEventListener('click', function() {
        exportToCSV(candidates, 'candidats');
    });
    
    // Exportation des offres d'emploi
    const exportJobsBtn = document.getElementById('export-jobs');
    exportJobsBtn.addEventListener('click', function() {
        exportToCSV(jobs, 'offres_emploi');
    });
}

// Fonction pour exporter des données au format CSV
function exportToCSV(data, filename) {
    if (data.length === 0) {
        alert('Aucune donnée à exporter.');
        return;
    }
    
    // Obtenir les en-têtes à partir des clés du premier objet
    const headers = Object.keys(data[0]);
    
    // Créer les lignes de données
    const csvRows = [];
    
    // Ajouter les en-têtes
    csvRows.push(headers.join(','));
    
    // Ajouter les données
    for (const row of data) {
        const values = headers.map(header => {
            const value = row[header];
            // Échapper les virgules et les guillemets
            return `"${String(value).replace(/"/g, '""')}"`;
        });
        csvRows.push(values.join(','));
    }
    
    // Combiner en une seule chaîne CSV
    const csvString = csvRows.join('\n');
    
    // Créer un objet Blob
    const blob = new Blob([csvString], { type: 'text/csv;charset=utf-8;' });
    
    // Créer un lien de téléchargement
    const link = document.createElement('a');
    const url = URL.createObjectURL(blob);
    link.setAttribute('href', url);
    link.setAttribute('download', `${filename}_${new Date().toISOString().split('T')[0]}.csv`);
    link.style.visibility = 'hidden';
    
    // Ajouter le lien au document
    document.body.appendChild(link);
    
    // Cliquer sur le lien pour déclencher le téléchargement
    link.click();
    
    // Nettoyer
    document.body.removeChild(link);
}

// Fonction pour modifier un candidat
function editCandidate(candidateId) {
    const candidate = candidates.find(c => c.id === candidateId);
    
    if (candidate) {
        document.getElementById('candidate-modal-title').textContent = 'Modifier un candidat';
        document.getElementById('candidate-id').value = candidate.id;
        document.getElementById('candidate-name').value = candidate.name;
        document.getElementById('candidate-email').value = candidate.email;
        document.getElementById('candidate-phone').value = candidate.phone;
        document.getElementById('candidate-status').value = candidate.status;
        document.getElementById('candidate-notes').value = candidate.notes || '';
        
        // Remplir le select des postes
        const jobSelect = document.getElementById('candidate-job');
        jobSelect.innerHTML = '';
        jobs.forEach(job => {
            const option = document.createElement('option');
            option.value = job.title;
            option.textContent = job.title;
            if (job.title === candidate.job) {
                option.selected = true;
            }
            jobSelect.appendChild(option);
        });
        
        document.getElementById('candidate-modal').style.display = 'block';
    }
}

// Fonction pour supprimer un candidat
function deleteCandidate(candidateId) {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce candidat ?')) {
        const index = candidates.findIndex(c => c.id === candidateId);
        
        if (index !== -1) {
            const candidate = candidates[index];
            
            // Mettre à jour le nombre de candidatures pour ce poste
            const jobIndex = jobs.findIndex(j => j.title === candidate.job);
            if (jobIndex !== -1 && jobs[jobIndex].applications > 0) {
                jobs[jobIndex].applications--;
                saveData('jobs');
            }
            
            // Ajouter une activité
            addActivity('candidate', 'delete', candidate.name, `Candidat ${candidate.name} supprimé`);
            
            // Supprimer le candidat
            candidates.splice(index, 1);
            saveData('candidates');
            
            // Mettre à jour l'interface
            renderCandidatesTable();
            updateDashboardStats();
            initCharts();
        }
    }
}

// Fonction pour voir les détails d'un candidat
function viewCandidate(candidateId) {
    const candidate = candidates.find(c => c.id === candidateId);
    
    if (candidate) {
        alert(`Détails du candidat : ${candidate.name}\n\nEmail : ${candidate.email}\nTéléphone : ${candidate.phone}\nPoste : ${candidate.job}\nStatut : ${getStatusText(candidate.status)}\nDate de candidature : ${new Date(candidate.date).toLocaleDateString('fr-FR')}\n\nNotes : ${candidate.notes || 'Aucune note'}`);
    }
}

// Fonction pour modifier une offre d'emploi
function editJob(jobId) {
    const job = jobs.find(j => j.id === jobId);
    
    if (job) {
        document.getElementById('job-modal-title').textContent = 'Modifier une offre d\'emploi';
        document.getElementById('job-id').value = job.id;
        document.getElementById('job-title').value = job.title;
        document.getElementById('job-department').value = job.department;
        document.getElementById('job-location').value = job.location;
        document.getElementById('job-type').value = job.type;
        document.getElementById('job-status').value = job.status;
        document.getElementById('job-description').value = job.description;
        document.getElementById('job-requirements').value = job.requirements;
        document.getElementById('job-salary').value = job.salary || '';
        
        document.getElementById('job-modal').style.display = 'block';
    }
}

// Fonction pour supprimer une offre d'emploi
function deleteJob(jobId) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette offre d\'emploi ?')) {
        const index = jobs.findIndex(j => j.id === jobId);
        
        if (index !== -1) {
            const job = jobs[index];
            
            // Ajouter une activité
            addActivity('job', 'delete', job.title, `Offre d'emploi ${job.title} supprimée`);
            
            // Supprimer l'offre
            jobs.splice(index, 1);
            saveData('jobs');
            
            // Mettre à jour l'interface
            renderJobsTable();
            updateDashboardStats();
            initCharts();
        }
    }
}

// Fonction pour voir les détails d'une offre d'emploi
function viewJob(jobId) {
    const job = jobs.find(j => j.id === jobId);
    
    if (job) {
        alert(`Détails de l'offre : ${job.title}\n\nDépartement : ${job.department}\nLieu : ${job.location}\nType : ${getTypeText(job.type)}\nStatut : ${getStatusText(job.status)}\nDate de publication : ${new Date(job.date).toLocaleDateString('fr-FR')}\nCandidatures : ${job.applications}\n\nDescription : ${job.description}\n\nPrérequis : ${job.requirements}\n\nSalaire : ${job.salary || 'Non spécifié'}`);
    }
}

// Fonction pour obtenir le texte du statut
function getStatusText(status) {
    switch(status) {
        case 'new': return 'Nouveau';
        case 'reviewing': return 'En évaluation';
        case 'interview': return 'Entretien';
        case 'offered': return 'Offre envoyée';
        case 'hired': return 'Embauché';
        case 'rejected': return 'Rejeté';
        case 'active': return 'Active';
        case 'draft': return 'Brouillon';
        case 'closed': return 'Fermée';
        default: return status;
    }
}

// Fonction pour obtenir le texte du type de contrat
function getTypeText(type) {
    switch(type) {
        case 'full-time': return 'CDI';
        case 'part-time': return 'CDD';
        case 'contract': return 'Intérim';
        case 'internship': return 'Stage';
        case 'apprenticeship': return 'Alternance';
        default: return type;
    }
}
