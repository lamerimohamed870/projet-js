<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SportReserve - Réservez votre terrain</title>
    <meta name="description" content="Plateforme de réservation de terrains de sport. Football, Tennis, Padel et plus.">
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <nav class="navbar">
        <a href="index.php" class="nav-brand">⚽ <span>SportReserve</span></a>
        <div class="nav-links">
            <a href="index.php">Accueil</a>
            <a href="index.php?action=terrains">Terrains</a>
            <?php if(isset($_SESSION['user_id'])): ?>
                <?php if($_SESSION['user_role'] == 'admin'): ?>
                    <a href="index.php?action=admin_dashboard">Dashboard Admin</a>
                <?php else: ?>
                    <a href="index.php?action=my_reservations">Mes Réservations</a>
                <?php endif; ?>
                <a href="index.php?action=logout" class="btn btn-danger" style="padding: 0.5rem 1rem;">Déconnexion</a>
            <?php else: ?>
                <a href="index.php?action=login">Connexion</a>
                <a href="index.php?action=register" class="btn btn-primary" style="padding: 0.5rem 1rem;">Inscription</a>
            <?php endif; ?>
        </div>
    </nav>
    <main>
