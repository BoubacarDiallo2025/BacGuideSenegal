<?php
include 'includes/header.php';
include 'config/database.php'; // Connexion à la base de données

// Récupérer la liste des conseillers depuis la base de données
$sql = "SELECT nom, prenom, email FROM utilisateurs WHERE role = 'conseiller'";
$stmt = $pdo->query($sql);
$conseillers = $stmt->fetchAll();
?>

<div class="container mt-5">
    <h2>Contact des Conseillers</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Prénom et Nom</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($conseillers as $conseiller) : ?>
                <tr>
                    <td><?= htmlspecialchars($conseiller['nom'] . ' ' . $conseiller['prenom']) ?></td>
                    <td><a href="mailto:<?= htmlspecialchars($conseiller['email']) ?>"><?= htmlspecialchars($conseiller['email']) ?></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>
