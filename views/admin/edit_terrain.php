<?php require_once 'views/header.php'; ?>

<div class="admin-layout animate-fade-in">
    <div class="sidebar">
        <a href="index.php?action=admin_dashboard">📊 Dashboard</a>
        <a href="index.php?action=admin_terrains" class="active">⚽ Terrains</a>
        <a href="index.php?action=admin_categories">🏷️ Catégories</a>
        <a href="index.php?action=admin_reservations">📅 Réservations</a>
        <a href="index.php?action=admin_users">👥 Utilisateurs</a>
    </div>
    
    <div class="admin-content">
        <div style="max-width: 600px; background: var(--card-bg); padding: 2rem; border-radius: 12px; border: 1px solid var(--border-color);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                <h2>Modifier le terrain</h2>
                <a href="index.php?action=admin_terrains" class="btn btn-secondary">Retour</a>
            </div>
            
            <form action="index.php?action=admin_edit_terrain&id=<?php echo $terrain['id']; ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nom">Nom du terrain</label>
                    <input type="text" id="nom" name="nom" class="form-control" value="<?php echo htmlspecialchars($terrain['nom']); ?>" required>
                </div>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label for="categorie_id">Catégorie</label>
                        <select id="categorie_id" name="categorie_id" class="form-control" required>
                            <?php foreach($categories as $cat): ?>
                                <option value="<?php echo $cat['id']; ?>" <?php echo $terrain['categorie_id'] == $cat['id'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($cat['nom']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="prix_heure">Prix par heure (TND)</label>
                        <input type="number" id="prix_heure" name="prix_heure" class="form-control" step="0.01" value="<?php echo $terrain['prix_heure']; ?>" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="localisation">Localisation</label>
                    <input type="text" id="localisation" name="localisation" class="form-control" value="<?php echo htmlspecialchars($terrain['localisation']); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" class="form-control" rows="4"><?php echo htmlspecialchars($terrain['description']); ?></textarea>
                </div>
                
                <div class="form-group">
                    <label for="statut">Statut</label>
                    <select id="statut" name="statut" class="form-control">
                        <option value="disponible" <?php echo $terrain['statut'] == 'disponible' ? 'selected' : ''; ?>>Disponible</option>
                        <option value="indisponible" <?php echo $terrain['statut'] == 'indisponible' ? 'selected' : ''; ?>>Indisponible</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="image">Nouvelle Image du terrain (Optionnel)</label>
                    <input type="file" id="image" name="image" class="form-control" accept="image/*" style="padding: 0.5rem;">
                    <p style="font-size: 0.85rem; color: #666; margin-top: 0.5rem;">Laissez vide si vous ne souhaitez pas modifier l'image actuelle.</p>
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 1rem;">Mettre à jour le terrain</button>
            </form>
        </div>
    </div>
</div>

<?php require_once 'views/footer.php'; ?>
