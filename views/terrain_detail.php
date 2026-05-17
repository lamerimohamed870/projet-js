<?php require_once 'header.php'; ?>

<div class="container animate-fade-in">
    <a href="index.php?action=terrains" style="color: var(--text-muted); display: inline-block; margin-bottom: 1rem;">← Retour aux terrains</a>
    
    <div class="detail-layout">
        <div>
            <img src="public/uploads/<?php echo htmlspecialchars($terrain['image'] ?? 'default.jpg'); ?>" alt="<?php echo htmlspecialchars($terrain['nom']); ?>" class="detail-img" onerror="this.src='https://images.unsplash.com/photo-1579952363873-27f3bade9f55?q=80&w=600&auto=format&fit=crop'">
            
            <h1 style="margin-top: 1.5rem;"><?php echo htmlspecialchars($terrain['nom']); ?></h1>
            <p style="color: var(--primary); font-size: 1.5rem; font-weight: 600; margin: 1rem 0;">
                <?php echo $terrain['prix_heure']; ?> TND / h
            </p>
            
            <div style="background: rgba(15, 23, 42, 0.5); padding: 1.5rem; border-radius: 12px; margin-top: 1.5rem;">
                <h3 style="margin-bottom: 1rem;">Informations</h3>
                <p><strong>Sport :</strong> <?php echo ucfirst(htmlspecialchars($terrain['type'])); ?></p>
                <p><strong>Localisation :</strong> <?php echo htmlspecialchars($terrain['localisation']); ?></p>
                <p><strong>Statut :</strong> <span class="badge badge-<?php echo $terrain['statut']; ?>"><?php echo ucfirst($terrain['statut']); ?></span></p>
                
                <h3 style="margin-top: 1.5rem; margin-bottom: 0.5rem;">Description</h3>
                <p style="color: var(--text-muted);"><?php echo nl2br(htmlspecialchars($terrain['description'])); ?></p>
            </div>
        </div>
        
        <div>
            <div class="auth-container" style="margin: 0; width: 100%; max-width: none;">
                <h2>Réserver ce terrain</h2>
                
                <?php if($terrain['statut'] == 'indisponible'): ?>
                    <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid var(--danger); padding: 1rem; border-radius: 8px; color: var(--danger); text-align: center; margin-top: 1rem;">
                        Ce terrain est actuellement indisponible pour la réservation.
                    </div>
                <?php elseif(!isset($_SESSION['user_id'])): ?>
                    <div style="text-align: center; margin-top: 2rem;">
                        <p style="color: var(--text-muted); margin-bottom: 1rem;">Vous devez être connecté pour réserver.</p>
                        <a href="index.php?action=login" class="btn btn-primary">Se connecter</a>
                    </div>
                <?php else: ?>
                    <form id="reservation-form" action="index.php?action=reserve" method="POST" style="margin-top: 1.5rem;" data-prix="<?php echo $terrain['prix_heure']; ?>">
                        <input type="hidden" name="terrain_id" value="<?php echo $terrain['id']; ?>">
                        
                        <div class="form-group">
                            <label for="date_reservation">Date</label>
                            <input type="date" id="date_reservation" name="date_reservation" class="form-control" required min="<?php echo date('Y-m-d'); ?>">
                        </div>
                        
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                            <div class="form-group">
                                <label for="heure_debut">Heure de début</label>
                                <input type="time" id="heure_debut" name="heure_debut" class="form-control" required min="08:00" max="22:00">
                            </div>
                            
                            <div class="form-group">
                                <label for="heure_fin">Heure de fin</label>
                                <input type="time" id="heure_fin" name="heure_fin" class="form-control" required min="09:00" max="23:00">
                            </div>
                        </div>

                        <div id="price-summary" style="margin-top: 1rem; padding: 1rem; background: rgba(59, 130, 246, 0.1); border-radius: 8px; border: 1px solid var(--primary); display: none;">
                            <p style="margin: 0; display: flex; justify-content: space-between; align-items: center;">
                                <span>Durée: <strong id="duree-calc">0 h</strong></span>
                                <span style="font-size: 1.2rem;">Total: <strong id="prix-total-calc" style="color: var(--primary);">0.00 TND</strong></span>
                            </p>
                        </div>
                        
                        <button type="submit" id="btn-reserver" class="btn btn-primary" style="width: 100%; margin-top: 1rem; padding: 1rem; font-size: 1.1rem;">
                            Confirmer la réservation
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require_once 'footer.php'; 
