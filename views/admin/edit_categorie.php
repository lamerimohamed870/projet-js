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
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                <h2>Modifier la catégorie</h2>
                <a href="index.php?action=admin_categories" class="btn btn-secondary">Retour</a>
            </div>
            
            <form action="index.php?action=admin_edit_categorie&id=<?php echo $categorie['id']; ?>" method="POST">
                <div class="form-group">
                    <label for="nom">Nom de la catégorie</label>
                    <input type="text" id="nom" name="nom" class="form-control" value="<?php echo htmlspecialchars($categorie['nom']); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="description">Description (Optionnelle)</label>
                    <textarea id="description" name="description" class="form-control" rows="4"><?php echo htmlspecialchars($categorie['description']); ?></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 1rem;">Mettre à jour la catégorie</button>
            </form>
        </div>
    </div>
</div>

<?php require_once 'views/footer.php'; ?>
