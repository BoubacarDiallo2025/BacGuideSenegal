<?php
include 'includes/header.php';
include 'config/database.php'; // Connexion à la base de données

// Récupérer la liste des conseillers depuis la base de données
$sql = "SELECT nom, prenom, email FROM utilisateurs WHERE role = 'conseiller'";
$stmt = $pdo->query($sql);
$conseillers = $stmt->fetchAll();
?>

<style>
    .titre-contact {
        text-align: center;
        font-size: 2rem;
        font-weight: bold;
        color: #007bff;
        margin-bottom: 30px;
        text-transform: uppercase;
    }

    .table-container {
        max-width: 800px;
        margin: auto;
    }

    .table {
        background-color: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .table th {
        background-color: #007bff;
        color: white;
        text-align: center;
    }

    .table td {
        text-align: center;
    }

    .email-link {
        color: #007bff;
        font-weight: bold;
        text-decoration: none;
    }

    .email-link:hover {
        text-decoration: underline;
    }
</style>

<div class="container mt-5">
    <h2 class="titre-contact">Contact des Conseillers</h2>

    <div class="table-container">
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
                        <td><?= htmlspecialchars($conseiller['prenom'] . ' ' . $conseiller['nom']) ?></td>
                        <td>
                            <a href="mailto:<?= htmlspecialchars($conseiller['email']) ?>" class="email-link">
                                📧 <?= htmlspecialchars($conseiller['email']) ?>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
