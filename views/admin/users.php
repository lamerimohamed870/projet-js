<?php require_once 'views/header.php'; ?>

<div class="admin-layout animate-fade-in">
    <div class="sidebar">
        <a href="index.php?action=admin_dashboard">📊 Dashboard</a>
        <a href="index.php?action=admin_terrains">⚽ Terrains</a>
        <a href="index.php?action=admin_categories">🏷️ Catégories</a>
        <a href="index.php?action=admin_reservations">📅 Réservations</a>
        <a href="index.php?action=admin_users" class="active">👥 Utilisateurs</a>
    </div>
    
    <div class="admin-content">
        <h2 style="margin-bottom: 2rem;">Gestion des Clients</h2>
        
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom Complet</th>
                        <th>Email</th>
                        <th>Date d'inscription</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($users as $u): ?>
                        <tr>
                            <td>#<?php echo $u['id']; ?></td>
                            <td><?php echo htmlspecialchars($u['nom'] . ' ' . $u['prenom']); ?></td>
                            <td><?php echo htmlspecialchars($u['email']); ?></td>
                            <td><?php echo date('d/m/Y H:i', strtotime($u['created_at'])); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once 'views/footer.php'; 
