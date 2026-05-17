<?php require_once 'views/header.php'; ?>

<div class="admin-layout animate-fade-in">
    <div class="sidebar">
        <a href="index.php?action=admin_dashboard" class="active">📊 Dashboard</a>
        <a href="index.php?action=admin_terrains">⚽ Terrains</a>
        <a href="index.php?action=admin_categories">🏷️ Catégories</a>
        <a href="index.php?action=admin_reservations">📅 Réservations</a>
        <a href="index.php?action=admin_users">👥 Utilisateurs</a>
    </div>
    
    <div class="admin-content">
        <h2 style="margin-bottom: 2rem;">Dashboard Administrateur</h2>
        
        <div class="grid">
            <div class="card" style="padding: 2rem; border-left: 4px solid var(--primary);">
                <h3 style="color: var(--text-muted); font-size: 1rem; margin-bottom: 0.5rem;">Total Clients</h3>
                <p style="font-size: 2.5rem; font-weight: 700; color: var(--text-main);"><?php echo $stats['total_users']; ?></p>
            </div>
            
            <div class="card" style="padding: 2rem; border-left: 4px solid var(--secondary);">
                <h3 style="color: var(--text-muted); font-size: 1rem; margin-bottom: 0.5rem;">Réservations</h3>
                <p style="font-size: 2.5rem; font-weight: 700; color: var(--text-main);"><?php echo $stats['total_reservations']; ?></p>
            </div>
            
            <div class="card" style="padding: 2rem; border-left: 4px solid var(--warning);">
                <h3 style="color: var(--text-muted); font-size: 1rem; margin-bottom: 0.5rem;">Terrains Actifs</h3>
                <p style="font-size: 2.5rem; font-weight: 700; color: var(--text-main);"><?php echo $stats['total_terrains']; ?></p>
            </div>
            
            <div class="card" style="padding: 2rem; border-left: 4px solid var(--success);">
                <h3 style="color: var(--text-muted); font-size: 1rem; margin-bottom: 0.5rem;">Revenus Estimés</h3>
                <p style="font-size: 2.5rem; font-weight: 700; color: var(--text-main);"><?php echo $stats['revenue']; ?> TND</p>
            </div>
        </div>

        <div class="card" style="margin-top: 2rem; padding: 2rem;">
            <h3 style="margin-bottom: 1rem;">Terrain le plus populaire</h3>
            <p style="font-size: 1.5rem; color: var(--primary);">🏆 <?php echo htmlspecialchars($stats['most_reserved']); ?></p>
        </div>
    </div>
</div>

<?php require_once 'views/footer.php'; 
