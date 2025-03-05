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
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Type</th>
                <th>Adresse</th>
                <th>Email</th>
                <th>Téléphone</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Afficher les établissements
            while ($etablissement = $etablissement_stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td><a href='etablissement.php?id={$etablissement['id']}'>{$etablissement['nom']}</a></td>";
                echo "<td>{$etablissement['type']}</td>";
                echo "<td>{$etablissement['adresse']}</td>";
                echo "<td><a href='mailto:{$etablissement['email']}'>{$etablissement['email']}</a></td>";
                echo "<td>{$etablissement['tel']}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<?php include 'includes/footer.php'; ?>
