<?php require_once 'header.php'; ?>

<div class="container">
    <div class="auth-container animate-fade-in">
        <h2>Créer un compte</h2>
        
        <form action="index.php?action=register" method="POST">
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" id="prenom" name="prenom" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">Adresse Email</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirmer le mot de passe</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
            </div>
            
            <button type="submit" id="btn-register" class="btn btn-primary" style="width: 100%; margin-top: 1rem;">S'inscrire</button>
        </form>
        
        <p style="text-align: center; margin-top: 1.5rem; color: var(--text-muted);">
            Déjà un compte ? <a href="index.php?action=login">Connectez-vous</a>
        </p>
    </div>
</div>

<?php require_once 'footer.php'; 
