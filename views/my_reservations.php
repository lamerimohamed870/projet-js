<?php require_once 'header.php'; ?>

<div class="container animate-fade-in">
    <h2>Mes Réservations</h2>
    
    <?php if(isset($_GET['success'])): ?>
        <div class="alert alert-dismissible" style="background: rgba(34, 197, 94, 0.1); border: 1px solid var(--success); color: var(--success); padding: 1rem; border-radius: 8px; margin-bottom: 2rem;">
            Votre réservation a été enregistrée avec succès et est en attente de validation.
        </div>
    <?php endif; ?>

    <?php if(empty($reservations)): ?>
        <div style="text-align: center; padding: 4rem; background: var(--card-bg); border-radius: 12px; border: 1px solid var(--border-color); margin-top: 2rem;">
            <p style="color: var(--text-muted); margin-bottom: 1rem;">Vous n'avez aucune réservation pour le moment.</p>
            <a href="index.php?action=terrains" class="btn btn-primary">Réserver un terrain</a>
        </div>
    <?php else: ?>
        <div class="table-responsive" style="margin-top: 2rem;">
            <table>
                <thead>
                    <tr>
                        <th>Terrain</th>
                        <th>Date</th>
                        <th>Horaires</th>
                        <th>Prix Total (est.)</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($reservations as $r): ?>
                        <tr>
                            <td>
                                <strong><?php echo htmlspecialchars($r['terrain_nom']); ?></strong><br>
                                <small style="color: var(--text-muted);"><?php echo htmlspecialchars($r['localisation']); ?></small>
                            </td>
                            <td><?php echo date('d/m/Y', strtotime($r['date_reservation'])); ?></td>
                            <td><?php echo date('H:i', strtotime($r['heure_debut'])) . ' - ' . date('H:i', strtotime($r['heure_fin'])); ?></td>
                            <td>
                                <?php 
                                    $duree = (strtotime($r['heure_fin']) - strtotime($r['heure_debut'])) / 3600;
                                    echo number_format($duree * $r['prix_heure'], 2) . ' TND';
                                ?>
                            </td>
                            <td>
                                <span class="badge badge-<?php echo $r['statut']; ?>">
                                    <?php echo ucfirst($r['statut']); ?>
                                </span>
                            </td>
                            <td>
                                <?php if($r['statut'] == 'en_attente'): ?>
                                    <a href="index.php?action=cancel_reservation&id=<?php echo $r['id']; ?>" class="btn btn-danger btn-delete" style="padding: 0.4rem 0.8rem; font-size: 0.8rem;">Annuler</a>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php require_once 'footer.php'; 
