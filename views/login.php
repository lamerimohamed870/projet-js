<?php require_once 'header.php'; ?>

<div class="container">
    <div class="auth-container animate-fade-in">
        <h2>Connexion</h2>
        
        <?php if (isset($error) && $error): ?>
            <div style="background-color: var(--danger); color: white; padding: 1rem; border-radius: 8px; margin-bottom: 1rem; text-align: center;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        
        <form action="index.php?action=login" method="POST">
            <div class="form-group">
                <label for="email">Adresse Email</label>
                <input type="email" id="email" name="email" class="form-control" required placeholder="votre@email.com">
            </div>
            
            <div class="form-group" style="position: relative;">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" class="form-control" required placeholder="••••••••">
                <span id="togglePassword" style="position: absolute; right: 10px; top: 38px; cursor: pointer; color: var(--text-muted);">👁️</span>
            </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 1rem;">Se connecter</button>
        </form>
        
        <p style="text-align: center; margin-top: 1.5rem; color: var(--text-muted);">
            Pas encore de compte ? <a href="index.php?action=register">Inscrivez-vous</a>
        </p>
    </div>
</div>

<?php require_once 'footer.php'; 
