<?php
// Démarre la session pour pouvoir accéder aux variables de session
session_start();

// Vérifie si l'utilisateur est connecté et s'il a le rôle d'administrateur
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'administrateur') {
    // Redirige vers la page de connexion s'il n'est pas un administrateur ou s'il n'est pas connecté
    header("Location: login.php");
    exit(); // Arrête l'exécution du script après la redirection
}

// Inclut l'en-tête de la page (contient généralement les balises HTML de début)
include './includes/header.php';
include './config/database.php'; // Connexion à la base de données

// Exemple de fonctionnalité : Afficher tous les utilisateurs sauf les administrateurs
$sql = "SELECT * FROM utilisateurs WHERE role != 'administrateur'";
$stmt = $pdo->query($sql);
$utilisateurs = $stmt->fetchAll();

// Afficher tous les établissements
$sql_etablissements = "SELECT * FROM etablissement";
$stmt_etablissements = $pdo->query($sql_etablissements);
$etablissements = $stmt_etablissements->fetchAll();

// Afficher tous les organismes gouvernementaux
$sql_organismes = "SELECT * FROM organisme_gouvernemental";
$stmt_organismes = $pdo->query($sql_organismes);
$organismes = $stmt_organismes->fetchAll();

// Afficher tous les conseils
$sql_conseils = "SELECT * FROM conseils";
$stmt_conseils = $pdo->query($sql_conseils);
$conseils = $stmt_conseils->fetchAll();

// Afficher toutes les demandes de conseils
$sql_demandes = "SELECT dc.id, dc.contenu, dc.type_conseil, dc.date_demande, u.nom, u.prenom FROM demandes_conseils dc JOIN utilisateurs u ON dc.demandeur_id = u.id";
$stmt_demandes = $pdo->query($sql_demandes);
$demandes = $stmt_demandes->fetchAll();
?>

<div class="container mt-5">
    <h2>Page d'administration</h2>
    <p>Bienvenue, <?= htmlspecialchars($_SESSION['nom']) ?> !</p>

    <style>
    .btn-custom {
        background-color: #007bff; /* Bleu primaire */
        color: white;
        border-radius: 50px; /* Arrondi */
        padding: 10px 20px;
        transition: all 0.3s ease-in-out;
    }

    .btn-custom:hover {
        background-color: #0056b3; /* Bleu foncé au survol */
        transform: scale(1.05); /* Légère agrandissement */
    }
</style>

<!-- Section de navigation pour choisir la gestion -->
<div class="d-flex justify-content-center gap-3 mb-4">
    <a href="#utilisateurs" class="btn btn-custom">Gestion des utilisateurs</a>
    <a href="#etablissements" class="btn btn-custom">Gestion des établissements</a>
    <a href="#organismes" class="btn btn-custom">Gestion des organismes gouvernementaux</a>
    <a href="#conseils" class="btn btn-custom">Gestion des conseils</a>
    <a href="#demandes" class="btn btn-custom">Gestion des demandes de conseils</a>
</div>


<style>
    .table-container {
        background: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .table th {
        background-color: #007bff;
        color: white;
        text-align: center;
    }

    .table-striped tbody tr:hover {
        background-color: #f1f1f1;
        transition: 0.3s ease-in-out;
    }

    .btn-action {
        border-radius: 20px;
        padding: 5px 12px;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        transition: 0.3s ease-in-out;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>

<div class="table-container">
    <!-- Gestion des utilisateurs -->
    <h3 id="utilisateurs" class="text-center mb-3">📋 Liste des utilisateurs</h3>

    <table class="table table-striped text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($utilisateurs as $utilisateur) : ?>
                <tr>
                    <td><?= htmlspecialchars($utilisateur['id']) ?></td>
                    <td><?= htmlspecialchars($utilisateur['nom']) ?></td>
                    <td><?= htmlspecialchars($utilisateur['prenom']) ?></td>
                    <td><?= htmlspecialchars($utilisateur['email']) ?></td>
                    <td><?= htmlspecialchars($utilisateur['role']) ?></td>
                    <td>
                        <a href="modifier_utilisateur.php?id=<?= $utilisateur['id'] ?>" class="btn btn-warning btn-sm btn-action">
                            ✏️ Modifier
                        </a>
                        <a href="supprimer_utilisateur.php?id=<?= $utilisateur['id'] ?>" class="btn btn-danger btn-sm btn-action" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                            🗑️ Supprimer
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="text-center mt-3">
        <a href="ajouter_utilisateur.php" class="btn btn-primary btn-lg">
            ➕ Ajouter un utilisateur
        </a>
    </div>
</div>


<style>
    .table-container {
        background: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .table th {
        background-color: #007bff;
        color: white;
        text-align: center;
    }

    .table-striped tbody tr:hover {
        background-color: #f1f1f1;
        transition: 0.3s ease-in-out;
    }

    .btn-action {
        border-radius: 20px;
        padding: 5px 12px;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        transition: 0.3s ease-in-out;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>

<div class="table-container">
    <!-- Gestion des établissements -->
    <h3 id="etablissements" class="text-center mt-5">🏫 Liste des établissements</h3>

    <table class="table table-striped text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Type</th>
                <th>Adresse</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($etablissements as $etablissement) : ?>
                <tr>
                    <td><?= htmlspecialchars($etablissement['id']) ?></td>
                    <td><?= htmlspecialchars($etablissement['nom']) ?></td>
                    <td><?= htmlspecialchars($etablissement['type']) ?></td>
                    <td><?= htmlspecialchars($etablissement['adresse']) ?></td>
                    <td><?= htmlspecialchars($etablissement['email']) ?></td>
                    <td><?= htmlspecialchars($etablissement['tel']) ?></td>
                    <td>
                        <a href="modifier_etablissement.php?id=<?= $etablissement['id'] ?>" class="btn btn-warning btn-sm btn-action">
                            ✏️ Modifier
                        </a>
                        <a href="supprimer_etablissement.php?id=<?= $etablissement['id'] ?>" class="btn btn-danger btn-sm btn-action" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet établissement ?');">
                            🗑️ Supprimer
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="text-center mt-3">
        <a href="ajouter_etablissement.php" class="btn btn-primary btn-lg">
            ➕ Ajouter un établissement
        </a>
    </div>
</div>


<style>
    .table-container {
        background: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .table th {
        background-color: #28a745;
        color: white;
        text-align: center;
    }

    .table-striped tbody tr:hover {
        background-color: #f1f1f1;
        transition: 0.3s ease-in-out;
    }

    .btn-action {
        border-radius: 20px;
        padding: 5px 12px;
    }

    .btn-primary {
        background-color: #28a745;
        border: none;
        transition: 0.3s ease-in-out;
    }

    .btn-primary:hover {
        background-color: #1e7e34;
    }
</style>

<div class="table-container">
    <!-- Gestion des organismes gouvernementaux -->
    <h3 id="organismes" class="text-center mt-5">🏛️ Liste des organismes gouvernementaux</h3>

    <table class="table table-striped text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Type</th>
                <th>Adresse</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($organismes as $organisme) : ?>
                <tr>
                    <td><?= htmlspecialchars($organisme['id']) ?></td>
                    <td><?= htmlspecialchars($organisme['nom']) ?></td>
                    <td><?= htmlspecialchars($organisme['type']) ?></td>
                    <td><?= htmlspecialchars($organisme['adresse']) ?></td>
                    <td><?= htmlspecialchars($organisme['email']) ?></td>
                    <td><?= htmlspecialchars($organisme['tel']) ?></td>
                    <td>
                        <a href="modifier_organisme.php?id=<?= $organisme['id'] ?>" class="btn btn-warning btn-sm btn-action">
                            ✏️ Modifier
                        </a>
                        <a href="supprimer_organisme.php?id=<?= $organisme['id'] ?>" class="btn btn-danger btn-sm btn-action" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet organisme ?');">
                            🗑️ Supprimer
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="text-center mt-3">
        <a href="ajouter_organisme.php" class="btn btn-primary btn-lg">
            ➕ Ajouter un organisme gouvernemental
        </a>
    </div>
</div>


<style>
    .table-container {
        background: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .table th {
        background-color: #007bff;
        color: white;
        text-align: center;
    }

    .table-striped tbody tr:hover {
        background-color: #f8f9fa;
        transition: 0.3s ease-in-out;
    }

    .btn-action {
        border-radius: 20px;
        padding: 5px 12px;
    }

    .contenu-aperçu {
        max-width: 250px;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        transition: 0.3s ease-in-out;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>

<div class="table-container">
    <!-- Gestion des conseils -->
    <h3 id="conseils" class="text-center mt-5">📜 Liste des conseils</h3>

    <table class="table table-striped text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Contenu</th>
                <th>Type</th>
                <th>Date de publication</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($conseils as $conseil) : ?>
                <tr>
                    <td><?= htmlspecialchars($conseil['id']) ?></td>
                    <td class="contenu-aperçu" title="<?= htmlspecialchars($conseil['contenu']) ?>">
                        <?= htmlspecialchars(mb_strimwidth($conseil['contenu'], 0, 50, "...")) ?>
                    </td>
                    <td><?= htmlspecialchars($conseil['type_conseil']) ?></td>
                    <td><?= htmlspecialchars($conseil['date_publication']) ?></td>
                    <td>
                        <a href="modifier_conseil.php?id=<?= $conseil['id'] ?>" class="btn btn-warning btn-sm btn-action">
                            ✏️ Modifier
                        </a>
                        <a href="supprimer_conseil.php?id=<?= $conseil['id'] ?>" class="btn btn-danger btn-sm btn-action" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce conseil ?');">
                            🗑️ Supprimer
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="text-center mt-3">
        <a href="ajouter_conseil.php" class="btn btn-primary btn-lg">
            ➕ Ajouter un conseil
        </a>
    </div>
</div>


<style>
    .table-container {
        background: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .table th {
        background-color: #007bff;
        color: white;
        text-align: center;
    }

    .table-striped tbody tr:hover {
        background-color: #f8f9fa;
        transition: 0.3s ease-in-out;
    }

    .btn-action {
        border-radius: 20px;
        padding: 5px 12px;
    }

    .contenu-aperçu {
        max-width: 250px;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        transition: 0.3s ease-in-out;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>

<div class="table-container">
    <!-- Gestion des demandes de conseils -->
    <h3 id="demandes" class="text-center mt-5">📩 Liste des demandes de conseils</h3>

    <table class="table table-striped text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Contenu</th>
                <th>Type</th>
                <th>Date de demande</th>
                <th>Demandeur</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($demandes as $demande) : ?>
                <tr>
                    <td><?= htmlspecialchars($demande['id']) ?></td>
                    <td class="contenu-aperçu" title="<?= htmlspecialchars($demande['contenu']) ?>">
                        <?= htmlspecialchars(mb_strimwidth($demande['contenu'], 0, 50, "...")) ?>
                    </td>
                    <td><?= htmlspecialchars($demande['type_conseil']) ?></td>
                    <td><?= htmlspecialchars($demande['date_demande']) ?></td>
                    <td><strong><?= htmlspecialchars($demande['prenom']) ?> <?= htmlspecialchars($demande['nom']) ?></strong></td>
                    <td>
                        <a href="modifier_demande.php?id=<?= $demande['id'] ?>" class="btn btn-warning btn-sm btn-action">
                            ✏️ Modifier
                        </a>
                        <a href="supprimer_demande.php?id=<?= $demande['id'] ?>" class="btn btn-danger btn-sm btn-action" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette demande ?');">
                            🗑️ Supprimer
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="text-center mt-3">
        <a href="ajouter_demande.php" class="btn btn-primary btn-lg">
            ➕ Ajouter une demande de conseil
        </a>
    </div>
</div>


<?php 
// Inclut le pied de page (fermeture des balises HTML, scripts JS, etc.)
include './includes/footer.php'; 
?>