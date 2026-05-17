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
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h2>Gestion des Catégories</h2>
            <a href="index.php?action=admin_add_categorie" class="btn btn-primary">➕ Nouvelle Catégorie</a>
        </div>
        
        <div style="background: var(--card-bg); border-radius: 12px; border: 1px solid var(--border-color); overflow: hidden;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($categories)): ?>
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 2rem; color: #666;">
                                Aucune catégorie n'est encore enregistrée.<br>
                                <a href="index.php?action=admin_add_categorie" style="color: var(--primary); text-decoration: none; font-weight: bold; margin-top: 10px; display: inline-block;">Ajouter la première catégorie</a>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($categories as $cat): ?>
                        <tr>
                            <td>#<?php echo $cat['id']; ?></td>
                            <td><strong><?php echo htmlspecialchars($cat['nom']); ?></strong></td>
                            <td><?php echo htmlspecialchars($cat['description']); ?></td>
                            <td>
                                <a href="index.php?action=admin_edit_categorie&id=<?php echo $cat['id']; ?>" class="btn btn-sm btn-primary" style="margin-right: 0.5rem;">✏️</a>
                                <a href="index.php?action=admin_delete_categorie&id=<?php echo $cat['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?');">🗑️</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once 'views/footer.php'; ?>
