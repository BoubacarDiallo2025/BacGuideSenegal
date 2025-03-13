<?php
// Démarre la session
session_start();

// Vérifie si l'utilisateur est connecté et a le rôle "conseiller"
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'conseiller') {
    header("Location: login.php");
    exit();
}

// Inclusion des fichiers nécessaires
include './includes/header.php';
include './config/database.php';

// Récupérer le type de conseil sélectionné
$type_conseil = isset($_GET['type_conseil']) ? $_GET['type_conseil'] : '';

// Préparer la requête SQL
$sql = "SELECT dc.contenu, dc.date_demande, u.nom, u.prenom 
        FROM demandes_conseils dc 
        JOIN utilisateurs u ON dc.demandeur_id = u.id";

if ($type_conseil) {
    $sql .= " WHERE dc.type_conseil = :type_conseil";
}
$sql .= " ORDER BY dc.date_demande DESC";

$stmt = $pdo->prepare($sql);
if ($type_conseil) {
    $stmt->execute(['type_conseil' => $type_conseil]);
} else {
    $stmt->execute();
}
$demandes_conseils = $stmt->fetchAll();
?>

<!-- Contenu principal -->
<div class="container mt-5">
    <div class="card shadow-lg p-4 mx-auto" style="max-width: 800px;">
        <h2 class="text-center">Espace Conseiller</h2>
        <p class="text-center">Bienvenue, <strong><?= htmlspecialchars($_SESSION['nom']) ?></strong> !</p>

        <!-- Bouton pour ajouter un conseil -->
        <div class="text-center mb-4">
            <a href="ajouter_conseil.php" class="btn btn-success">+ Ajouter un conseil</a>
        </div>

        <!-- Formulaire de filtre -->
        <form method="GET" action="conseiller.php" class="mb-4">
            <div class="form-group">
                <label for="type_conseil">Filtrer par type de conseil :</label>
                <select name="type_conseil" id="type_conseil" class="form-control">
                    <option value="">Tous</option>
                    <option value="administratif" <?= $type_conseil == 'administratif' ? 'selected' : '' ?>>Administratif</option>
                    <option value="orientation" <?= $type_conseil == 'orientation' ? 'selected' : '' ?>>Orientation</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Filtrer</button>
        </form>

        <!-- Tableau des demandes de conseils -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark text-center">
                    <tr>
                        <th>Contenu</th>
                        <th>Date</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($demandes_conseils) > 0) : ?>
                        <?php foreach ($demandes_conseils as $demande) : ?>
                            <tr>
                                <td><?= nl2br(htmlspecialchars($demande['contenu'])) ?></td>
                                <td><?= date("d/m/Y H:i", strtotime($demande['date_demande'])) ?></td>
                                <td><?= htmlspecialchars($demande['nom']) ?></td>
                                <td><?= htmlspecialchars($demande['prenom']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted">Aucune demande de conseil trouvée.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include './includes/footer.php'; ?>
