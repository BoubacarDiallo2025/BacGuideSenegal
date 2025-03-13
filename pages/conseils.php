<?php
include 'includes/header.php';
include 'config/database.php'; // Connexion à la base de données

// Vérifier la connexion à la base de données
if (!isset($pdo)) {
    die("Erreur de connexion à la base de données.");
}

// Récupérer le type de conseil sélectionné
$type_conseil = !empty($_GET['type_conseil']) ? $_GET['type_conseil'] : '';

// Requête SQL avec filtre
$sql = "SELECT id, contenu, date_publication FROM conseils";
if (!empty($type_conseil)) {
    $sql .= " WHERE type_conseil = :type_conseil";
}
$sql .= " ORDER BY date_publication DESC";

$stmt = $pdo->prepare($sql);
$params = !empty($type_conseil) ? ['type_conseil' => $type_conseil] : [];
$stmt->execute($params);
$conseils = $stmt->fetchAll();
?>

<!-- Inclure le CSS de DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<div class="container mt-5">
    <style>
    .titre-conseils {
        text-align: center;
        font-size: 2rem;
        font-weight: bold;
        color: #007bff;
        margin-bottom: 20px;
        text-transform: uppercase;
    }
</style>

<h2 class="titre-conseils">Conseils pour réussir sa première année</h2>


    <!-- Bouton pour demander un conseil -->
    <a href="demander_conseil.php" class="btn btn-primary mb-4">Demander un conseil</a>

    <!-- Formulaire de sélection du type de conseil -->
    <form method="GET" action="conseils.php" class="mb-4">
        <div class="form-group">
            <label for="type_conseil">Choisissez le type de conseil :</label>
            <select name="type_conseil" id="type_conseil" class="form-control">
                <option value="">Tous</option>
                <option value="administratif" <?= $type_conseil == 'administratif' ? 'selected' : '' ?>>Administratif</option>
                <option value="orientation" <?= $type_conseil == 'orientation' ? 'selected' : '' ?>>Orientation</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Filtrer</button>
    </form>

    <table id="conseilsTable" class="display table table-striped">
        <thead>
            <tr>
                <th>Contenu du conseil</th>
                <th>Date de publication</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($conseils as $conseil) : ?>
                <tr>
                    <td><?= htmlspecialchars(substr($conseil['contenu'], 0, 100)) ?>...</td>
                    <td><?= date("d/m/Y H:i", strtotime($conseil['date_publication'])) ?></td>
                    <td>
                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal<?= $conseil['id'] ?>">Voir plus</button>
                    </td>
                </tr>

                <!-- Modal pour afficher le conseil complet -->
                <div class="modal fade" id="modal<?= $conseil['id'] ?>" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Détail du conseil</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <p><?= nl2br(htmlspecialchars($conseil['contenu'])) ?></p>
                                <p><strong>Date :</strong> <?= date("d/m/Y H:i", strtotime($conseil['date_publication'])) ?></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Inclure jQuery et DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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
