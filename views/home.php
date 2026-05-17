<?php require_once 'header.php'; ?>

<div class="container">
    <section class="hero">
        <h1>Le sport, quand vous voulez, où vous voulez.</h1>
        <p>Réservez les meilleurs terrains de sport près de chez vous en quelques clics. Football, Tennis, Padel, Basketball... votre prochain match commence ici.</p>
        <a href="index.php?action=terrains" class="btn btn-primary" style="font-size: 1.2rem; padding: 1rem 2.5rem;">Découvrir les terrains</a>
    </section>

    <section style="margin-top: 4rem; text-align: center;">
        <h2 style="font-size: 2rem; margin-bottom: 2rem;">Comment ça marche ?</h2>
        <div class="grid" style="grid-template-columns: repeat(3, 1fr);">
            <div class="card animate-fade-in" style="animation-delay: 0.1s; padding: 2rem;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">🔍</div>
                <h3>1. Cherchez</h3>
                <p style="color: var(--text-muted); margin-top: 1rem;">Trouvez le terrain idéal selon votre sport et votre localisation.</p>
            </div>
            <div class="card animate-fade-in" style="animation-delay: 0.2s; padding: 2rem;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">📅</div>
                <h3>2. Réservez</h3>
                <p style="color: var(--text-muted); margin-top: 1rem;">Choisissez votre créneau horaire et confirmez votre réservation.</p>
            </div>
            <div class="card animate-fade-in" style="animation-delay: 0.3s; padding: 2rem;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">⚽</div>
                <h3>3. Jouez</h3>
                <p style="color: var(--text-muted); margin-top: 1rem;">Rendez-vous sur le terrain et profitez de votre match entre amis.</p>
            </div>
        </div>
    </section>
</div>

<?php require_once 'footer.php'; 
