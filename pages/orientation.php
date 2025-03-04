<?php
include '../includes/header.php';
include '../config/database.php';

$sql = "SELECT DISTINCT domaine FROM formations";
$domaine_stmt = $pdo->query($sql);
?>
<div class="container mt-5">
    <h2>Liste des formations</h2>
    <form method="GET">
        <select name="domaine" class="form-select" onchange="this.form.submit()">
            <option value="">-- Choisir un domaine --</option>
            <?php while ($row = $domaine_stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                <option value="<?= $row['domaine'] ?>"><?= $row['domaine'] ?></option>
            <?php } ?>
        </select>
    </form>

    <h3 class="mt-3">Résultats :</h3>
    <ul>
        <?php
        $query = "SELECT * FROM formations";
        if (isset($_GET['domaine']) && !empty($_GET['domaine'])) {
            $query .= " WHERE domaine = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$_GET['domaine']]);
        } else {
            $stmt = $pdo->query($query);
        }

        while ($formation = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<li>{$formation['nom']} - {$formation['universite']}</li>";
        }
        ?>
    </ul>
</div>
<?php include '../includes/footer.php'; ?>
