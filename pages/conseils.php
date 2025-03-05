<?php
include 'includes/header.php';
include 'config/database.php'; // Connexion à la base de données

// Récupérer la liste des conseils depuis la base de données
$sql = "SELECT contenu, date_publication FROM conseils ORDER BY date_publication DESC";
$stmt = $pdo->query($sql);
$conseils = $stmt->fetchAll();
?>

<div class="container mt-5">
    <h2>Conseils pour réussir sa première année</h2>
    <ul>
        <?php foreach ($conseils as $conseil) : ?>
            <li>
                <?= htmlspecialchars($conseil['contenu']) ?> 
                <br><small>Publié le : <?= date("d/m/Y H:i", strtotime($conseil['date_publication'])) ?></small>
            </li>
        <?php endforeach; ?>
    </ul>                                  
</div>

<?php include 'includes/footer.php'; ?>
