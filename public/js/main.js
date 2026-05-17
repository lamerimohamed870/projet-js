document.addEventListener('DOMContentLoaded', () => {
    // Password visibility toggle
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    if (togglePassword && password) {
        togglePassword.addEventListener('click', function (e) {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.textContent = type === 'password' ? '👁️' : '🙈';
        });
    }

    // Terrain Filtering without reload
    const filterSelect = document.querySelector('#typeFilter');
    const terrainCards = document.querySelectorAll('.terrain-card');
    if (filterSelect) {
        filterSelect.addEventListener('change', (e) => {
            const filterValue = e.target.value.toLowerCase();
            terrainCards.forEach(card => {
                const dataType = card.getAttribute('data-type');
                const terrainType = dataType ? dataType.toLowerCase() : '';
                if (filterValue === 'all' || terrainType === filterValue) {
                    card.style.display = 'block';
                    card.style.animation = 'fadeIn 0.5s ease';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }

    // Confirm deletion
    const deleteBtns = document.querySelectorAll('.btn-delete');
    deleteBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            if (!confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')) {
                e.preventDefault();
            }
        });
    });

    // 1. Validation du formulaire d'inscription (Vérification des mots de passe)
    const btnRegister = document.querySelector('#btn-register');
    if (btnRegister) {
        btnRegister.addEventListener('click', function(e) {
            const password = document.querySelector('#password').value;
            const confirmPassword = document.querySelector('#confirm_password').value;
            
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Les mots de passe ne correspondent pas. Veuillez réessayer.');
            }
        });
    }

    // 2. Prévisualisation de l'image avant l'upload (Ajout de terrain/produit)
    const imageInput = document.querySelector('#image');
    const imagePreviewContainer = document.querySelector('#image-preview-container');
    const imagePreview = document.querySelector('#image-preview');
    
    if (imageInput && imagePreviewContainer && imagePreview) {
        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.addEventListener('load', function() {
                    imagePreview.setAttribute('src', this.result);
                    imagePreviewContainer.style.display = 'block';
                });
                reader.readAsDataURL(file);
            } else {
                imagePreviewContainer.style.display = 'none';
                imagePreview.setAttribute('src', '');
            }
        });
    }

    // 3. Calcul dynamique du prix de la réservation
    const formReservation = document.querySelector('#reservation-form');
    if (formReservation) {
        const heureDebut = document.querySelector('#heure_debut');
        const heureFin = document.querySelector('#heure_fin');
        const prixHeure = parseFloat(formReservation.getAttribute('data-prix'));
        const priceSummary = document.querySelector('#price-summary');
        const dureeCalc = document.querySelector('#duree-calc');
        const prixTotalCalc = document.querySelector('#prix-total-calc');

        function calculerPrix() {
            if (heureDebut.value && heureFin.value) {
                const startParts = heureDebut.value.split(':');
                const endParts = heureFin.value.split(':');
                
                const start = new Date();
                start.setHours(parseInt(startParts[0], 10), parseInt(startParts[1], 10), 0);
                
                const end = new Date();
                end.setHours(parseInt(endParts[0], 10), parseInt(endParts[1], 10), 0);

                let diffMs = end - start;
                
                if (diffMs > 0) {
                    let diffHours = diffMs / (1000 * 60 * 60);
                    let total = diffHours * prixHeure;
                    
                    dureeCalc.textContent = diffHours.toFixed(2).replace('.00', '') + ' h';
                    prixTotalCalc.textContent = total.toFixed(2) + ' TND';
                    priceSummary.style.display = 'block';
                } else {
                    priceSummary.style.display = 'none';
                }
            } else {
                priceSummary.style.display = 'none';
            }
        }

        heureDebut.addEventListener('change', calculerPrix);
        heureFin.addEventListener('change', calculerPrix);
        
        // Validation basique
        formReservation.addEventListener('submit', function(e) {
            if (heureDebut.value >= heureFin.value) {
                e.preventDefault();
                alert('L\\'heure de fin doit être strictement supérieure à l\\'heure de début.');
            }
        });
    }

    // 4. Auto-hide alert messages
    const alerts = document.querySelectorAll('.alert-dismissible');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.classList.add('fade-out');
            setTimeout(() => {
                alert.style.display = 'none';
            }, 500); // Wait for animation to finish
        }, 4000); // 4 seconds before fading out
    });

    // 5. Back to Top Button smooth scroll
    const backToTopBtn = document.querySelector('#backToTop');
    if (backToTopBtn) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                backToTopBtn.classList.add('show');
            } else {
                backToTopBtn.classList.remove('show');
            }
        });

        backToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
});
