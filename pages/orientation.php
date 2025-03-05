<?php
include './includes/header.php';
include './config/database.php';

// Récupérer les établissements (sans filtrage par domaine)
$sql = "SELECT * FROM etablissement";
$etablissement_stmt = $pdo->query($sql);
?>
<div class="container mt-5">
    <h2>Liste des établissements</h2>
    <h3 class="mt-3">Résultats :</h3>
    <ul>
        <?php
        // Afficher les établissements
        while ($etablissement = $etablissement_stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<li>{$etablissement['nom']} - {$etablissement['adresse']}</li>";
        }
        ?>
    </ul>
</div>
<?php include 'includes/footer.php'; ?>
