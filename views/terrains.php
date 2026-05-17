<?php require_once 'header.php'; ?>

<div class="container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h2>Nos Terrains de Sport</h2>
        
        <select id="typeFilter" class="form-control" style="width: 200px;">
            <option value="all">Tous les sports</option>
            <?php foreach($categories as $cat): ?>
                <option value="<?php echo htmlspecialchars(strtolower($cat['nom'])); ?>"><?php echo htmlspecialchars($cat['nom']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="grid">
        <?php if(empty($terrains)): ?>
            <p style="color: var(--text-muted); grid-column: 1 / -1; text-align: center;">Aucun terrain disponible pour le moment.</p>
        <?php endif; ?>

        <?php foreach ($terrains as $t): ?>
            <div class="card terrain-card animate-fade-in" data-type="<?php echo htmlspecialchars($t['type']); ?>">
                <img src="public/uploads/<?php echo htmlspecialchars($t['image'] ?? 'default.jpg'); ?>" alt="<?php echo htmlspecialchars($t['nom']); ?>" class="card-img" onerror="this.src='https://images.unsplash.com/photo-1579952363873-27f3bade9f55?q=80&w=600&auto=format&fit=crop'">
                
                <div class="card-body">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                        <span class="badge badge-<?php echo $t['statut']; ?>">
                            <?php echo ucfirst($t['statut']); ?>
                        </span>
                        <span style="font-weight: 600; color: var(--primary);"><?php echo $t['prix_heure']; ?> TND / h</span>
                    </div>
                    
                    <h3 class="card-title"><?php echo htmlspecialchars($t['nom']); ?></h3>
                    <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1rem;">
                        📍 <?php echo htmlspecialchars($t['localisation']); ?><br>
                        ⚽ <?php echo ucfirst(htmlspecialchars($t['type'])); ?>
                    </p>
                    
                    <a href="index.php?action=terrain_detail&id=<?php echo $t['id']; ?>" class="btn btn-primary" style="width: 100%;">Voir les détails</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once 'footer.php'; 
