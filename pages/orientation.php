<?php
include './includes/header.php';
include './config/database.php';

// Récupérer les établissements
$sql = "SELECT * FROM etablissement";
$etablissement_stmt = $pdo->query($sql);
$etablissements = $etablissement_stmt->fetchAll(PDO::FETCH_ASSOC);
?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"></script>
    <style>
        .container {
            max-width: 900px;
        }
    </style>
    <script>
        function filtrerEtablissements() {
            let input = document.getElementById("searchInput").value.toLowerCase();
            let rows = document.querySelectorAll("#etablissementTable tbody tr");

            rows.forEach(row => {
                let nom = row.cells[0].innerText.toLowerCase();
                let type = row.cells[1].innerText.toLowerCase();
                row.style.display = (nom.includes(input) || type.includes(input)) ? "" : "none";
            });
        }
    </script>
</head>

<div class="container mt-5">
    <h2 class="text-primary text-center"><i class="bi bi-building"></i> Liste des établissements</h2>

    <!-- Barre de recherche -->
    <div class="input-group my-4">
        <input type="text" id="searchInput" class="form-control" placeholder="Rechercher un établissement..." onkeyup="filtrerEtablissements()">
        <span class="input-group-text"><i class="bi bi-search"></i></span>
    </div>

    <!-- Table des établissements -->
    <table id="etablissementTable" class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Nom</th>
                <th>Type</th>
                <th>Adresse</th>
                <th>Email</th>
                <th>Téléphone</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($etablissements as $etablissement) : ?>
                <tr>
                    <td><a href="etablissement.php?id=<?= $etablissement['id'] ?>" class="text-decoration-none"><?= htmlspecialchars($etablissement['nom']) ?></a></td>
                    <td><?= htmlspecialchars($etablissement['type']) ?></td>
                    <td><?= htmlspecialchars($etablissement['adresse']) ?></td>
                    <td><a href="mailto:<?= htmlspecialchars($etablissement['email']) ?>" class="text-decoration-none"><?= htmlspecialchars($etablissement['email']) ?></a></td>
                    <td><?= htmlspecialchars($etablissement['tel']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Bouton de retour -->
    <div class="text-center mt-4">
        <a href="accueil.php" class="btn btn-outline-primary"><i class="bi bi-arrow-left"></i> Retour à l'accueil</a>
    </div>
</div>
