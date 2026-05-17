<?php require_once 'views/header.php'; ?>

<div class="admin-layout animate-fade-in">
    <div class="sidebar">
        <a href="index.php?action=admin_dashboard">📊 Dashboard</a>
        <a href="index.php?action=admin_terrains">⚽ Terrains</a>
        <a href="index.php?action=admin_categories" class="active">🏷️ Catégories</a>
        <a href="index.php?action=admin_reservations">📅 Réservations</a>
        <a href="index.php?action=admin_users">👥 Utilisateurs</a>
    </div>
    
    <div class="admin-content">
        <div style="max-width: 600px; background: var(--card-bg); padding: 2rem; border-radius: 12px; border: 1px solid var(--border-color);">
            <h2 style="margin-bottom: 2rem;">Ajouter une nouvelle catégorie</h2>
            
            <form action="index.php?action=admin_add_categorie" method="POST">
                <div class="form-group">
                    <label for="nom">Nom de la catégorie</label>
                    <input type="text" id="nom" name="nom" class="form-control" required placeholder="Ex: Football, Tennis, Padel...">
                </div>
                
                <div class="form-group">
                    <label for="description">Description (Optionnelle)</label>
                    <textarea id="description" name="description" class="form-control" rows="4" placeholder="Brève description de la catégorie..."></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 1rem;">Enregistrer la catégorie</button>
            </form>
        </div>
    </div>
</div>

<?php require_once 'views/footer.php'; ?>
