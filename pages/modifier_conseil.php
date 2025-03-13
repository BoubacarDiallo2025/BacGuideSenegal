<?php
include './config/database.php';

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contenu = $_POST['contenu'];
    $type_conseil = $_POST['type_conseil'];

    $sql = "UPDATE conseils SET contenu = ?, type_conseil = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$contenu, $type_conseil, $id]);

    // Redirection vers la page admin après modification
    header("Location: admin.php");
    exit();
} else {
    $sql = "SELECT * FROM conseils WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $conseil = $stmt->fetch(PDO::FETCH_ASSOC);
}

include './includes/header.php';
?>

<div class="container mt-5">
    <h2>Modifier un conseil</h2>
    <form method="POST">
        <textarea name="contenu" class="form-control mt-2" placeholder="Contenu" required><?= htmlspecialchars($conseil['contenu']) ?></textarea>
        <select name="type_conseil" class="form-control mt-2" required>
            <option value="administratif" <?= $conseil['type_conseil'] == 'administratif' ? 'selected' : '' ?>>Administratif</option>
            <option value="orientation" <?= $conseil['type_conseil'] == 'orientation' ? 'selected' : '' ?>>Orientation</option>
        </select>
        <button type="submit" class="btn btn-primary mt-3">Modifier</button>
    </form>
</div>

<?php include './includes/footer.php'; ?>