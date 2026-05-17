<?php require_once 'views/header.php'; ?>

<div class="admin-layout animate-fade-in">
    <div class="sidebar">
        <a href="index.php?action=admin_dashboard">📊 Dashboard</a>
        <a href="index.php?action=admin_terrains">⚽ Terrains</a>
        <a href="index.php?action=admin_categories">🏷️ Catégories</a>
        <a href="index.php?action=admin_reservations" class="active">📅 Réservations</a>
        <a href="index.php?action=admin_users">👥 Utilisateurs</a>
    </div>
    
    <div class="admin-content">
        <h2 style="margin-bottom: 2rem;">Gestion des Réservations</h2>
        
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Client</th>
                        <th>Terrain</th>
                        <th>Date & Heure</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($reservations as $r): ?>
                        <tr>
                            <td>#<?php echo $r['id']; ?></td>
                            <td>
                                <?php echo htmlspecialchars($r['user_nom'] . ' ' . $r['user_prenom']); ?>
                            </td>
                            <td><?php echo htmlspecialchars($r['terrain_nom']); ?></td>
                            <td>
                                <?php echo date('d/m/Y', strtotime($r['date_reservation'])); ?><br>
                                <small style="color: var(--text-muted);"><?php echo date('H:i', strtotime($r['heure_debut'])) . ' - ' . date('H:i', strtotime($r['heure_fin'])); ?></small>
                            </td>
                            <td>
                                <span class="badge badge-<?php echo $r['statut']; ?>">
                                    <?php echo ucfirst($r['statut']); ?>
                                </span>
                            </td>
                            <td>
                                <form action="index.php?action=admin_update_reservation&id=<?php echo $r['id']; ?>" method="POST" style="display: flex; gap: 0.5rem; align-items: center;">
                                    <select name="statut" class="form-control" style="padding: 0.3rem; font-size: 0.9rem; width: auto;" onchange="this.form.submit()">
                                        <option value="en_attente" <?php if($r['statut'] == 'en_attente') echo 'selected'; ?>>En attente</option>
                                        <option value="validee" <?php if($r['statut'] == 'validee') echo 'selected'; ?>>Valider</option>
                                        <option value="refusee" <?php if($r['statut'] == 'refusee') echo 'selected'; ?>>Refuser</option>
                                        <option value="annulee" <?php if($r['statut'] == 'annulee') echo 'selected'; ?>>Annulée</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once 'views/footer.php'; 
