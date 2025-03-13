<?php
include './config/database.php';

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $type = $_POST['type'];
    $adresse = $_POST['adresse'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];

    $sql = "UPDATE etablissement SET nom = ?, type = ?, adresse = ?, email = ?, tel = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom, $type, $adresse, $email, $tel, $id]);

    // Redirection vers la page admin après modification
    header("Location: admin.php");
    exit();
} else {
    $sql = "SELECT * FROM etablissement WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $etablissement = $stmt->fetch(PDO::FETCH_ASSOC);
}

include './includes/header.php';
?>

<div class="container mt-5">
    <h2>Modifier un établissement</h2>
    <form method="POST">
        <input type="text" name="nom" class="form-control mt-2" placeholder="Nom" value="<?= htmlspecialchars($etablissement['nom']) ?>" required>
        <input type="text" name="type" class="form-control mt-2" placeholder="Type" value="<?= htmlspecialchars($etablissement['type']) ?>" required>
        <input type="text" name="adresse" class="form-control mt-2" placeholder="Adresse" value="<?= htmlspecialchars($etablissement['adresse']) ?>" required>
        <input type="email" name="email" class="form-control mt-2" placeholder="Email" value="<?= htmlspecialchars($etablissement['email']) ?>" required>
        <input type="text" name="tel" class="form-control mt-2" placeholder="Téléphone" value="<?= htmlspecialchars($etablissement['tel']) ?>" required>
        <button type="submit" class="btn btn-primary mt-3">Modifier</button>
    </form>
</div>

<?php include './includes/footer.php'; ?>