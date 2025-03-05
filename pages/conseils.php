<?php
include 'includes/header.php';
include 'config/database.php'; // Connexion à la base de données

// Récupérer la liste des conseils depuis la base de données
$sql = "SELECT contenu, date_publication FROM conseils ORDER BY date_publication DESC";
$stmt = $pdo->query($sql);
$conseils = $stmt->fetchAll();
?>

<!-- Inclure le CSS de DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<div class="container mt-5">
    <h2>Conseils pour réussir sa première année</h2>
    
    <table id="conseilsTable" class="display table table-striped">
        <thead>
            <tr>
                <th>Contenu du conseil</th>
                <th>Date de publication</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($conseils as $conseil) : ?>
                <tr>
                    <td><?= htmlspecialchars($conseil['contenu']) ?></td>
                    <td><?= date("d/m/Y H:i", strtotime($conseil['date_publication'])) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Inclure jQuery et DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- Initialisation de DataTables -->
<script>
$(document).ready(function() {
    $('#conseilsTable').DataTable({
        "paging": true,       // Pagination
        "searching": true,    // Barre de recherche
        "ordering": true,     // Tri des colonnes
        "info": true,         // Infos sur la table (ex: "Affichage de 1 à 10 sur 50 entrées")
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.13.6/i18n/French.json"
        }
    });
});
</script>

<?php include 'includes/footer.php'; ?>