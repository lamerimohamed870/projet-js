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
            <h2 style="margin-bottom: 2rem;">Ajouter un nouveau terrain</h2>
            
            <form action="index.php?action=admin_add_terrain" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nom">Nom du terrain</label>
                    <input type="text" id="nom" name="nom" class="form-control" required>
                </div>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label for="categorie_id">Catégorie</label>
                        <select id="categorie_id" name="categorie_id" class="form-control" required>
                            <?php foreach($categories as $cat): ?>
                                <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['nom']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="prix_heure">Prix par heure (TND)</label>
                        <input type="number" id="prix_heure" name="prix_heure" class="form-control" step="0.01" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="localisation">Localisation</label>
                    <input type="text" id="localisation" name="localisation" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" class="form-control" rows="4"></textarea>
                </div>
                
                <div class="form-group">
                    <label for="statut">Statut</label>
                    <select id="statut" name="statut" class="form-control">
                        <option value="disponible">Disponible</option>
                        <option value="indisponible">Indisponible</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="image">Image du terrain</label>
                    <input type="file" id="image" name="image" class="form-control" accept="image/*" style="padding: 0.5rem;" required>
                    <div id="image-preview-container" style="margin-top: 1rem; display: none; text-align: center;">
                        <img id="image-preview" src="" alt="Aperçu" style="max-width: 100%; max-height: 200px; border-radius: 8px; border: 1px solid var(--border-color);">
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 1rem;">Enregistrer le terrain</button>
            </form>
        </div>
    </div>
</div>

<?php require_once 'views/footer.php'; 
