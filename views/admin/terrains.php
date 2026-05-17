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
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h2>Gestion des Terrains</h2>
            <a href="index.php?action=admin_add_terrain" class="btn btn-primary">+ Ajouter un terrain</a>
        </div>
        
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Nom</th>
                        <th>Type</th>
                        <th>Prix</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($terrains as $t): ?>
                        <tr>
                            <td>
                                <img src="public/uploads/<?php echo htmlspecialchars($t['image']); ?>" alt="Terrain" style="width: 50px; height: 50px; border-radius: 8px; object-fit: cover;" onerror="this.src='https://images.unsplash.com/photo-1579952363873-27f3bade9f55?w=50&h=50&fit=crop'">
                            </td>
                            <td><?php echo htmlspecialchars($t['nom']); ?></td>
                            <td><?php echo ucfirst(htmlspecialchars($t['type'])); ?></td>
                            <td><?php echo $t['prix_heure']; ?> TND</td>
                            <td>
                                <span class="badge badge-<?php echo $t['statut']; ?>">
                                    <?php echo ucfirst($t['statut']); ?>
                                </span>
                            </td>
                            <td>
                                <a href="index.php?action=admin_edit_terrain&id=<?php echo $t['id']; ?>" class="btn btn-primary" style="padding: 0.4rem 0.8rem; font-size: 0.8rem; margin-right: 0.5rem;">Modifier</a>
                                <a href="index.php?action=admin_delete_terrain&id=<?php echo $t['id']; ?>" class="btn btn-danger btn-delete" style="padding: 0.4rem 0.8rem; font-size: 0.8rem;">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once 'views/footer.php'; 
