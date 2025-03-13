<?php
include './config/database.php';

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $sql = "UPDATE utilisateurs SET nom = ?, prenom = ?, email = ?, role = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom, $prenom, $email, $role, $id]);

    // Redirection vers la page admin après modification
    header("Location: admin.php");
    exit();
} else {
    $sql = "SELECT * FROM utilisateurs WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
}

include './includes/header.php';
?>

<div class="container mt-5">
    <h2>Modifier un utilisateur</h2>
    <form method="POST">
        <input type="text" name="nom" class="form-control mt-2" placeholder="Nom" value="<?= htmlspecialchars($utilisateur['nom']) ?>" required>
        <input type="text" name="prenom" class="form-control mt-2" placeholder="Prénom" value="<?= htmlspecialchars($utilisateur['prenom']) ?>" required>
        <input type="email" name="email" class="form-control mt-2" placeholder="Email" value="<?= htmlspecialchars($utilisateur['email']) ?>" required>
        <select name="role" class="form-control mt-2" required>
            <option value="bachelier" <?= $utilisateur['role'] == 'bachelier' ? 'selected' : '' ?>>Bachelier</option>
            <option value="conseiller" <?= $utilisateur['role'] == 'conseiller' ? 'selected' : '' ?>>Conseiller</option>
        </select>
        <button type="submit" class="btn btn-primary mt-3">Modifier</button>
    </form>
</div>

<?php include './includes/footer.php'; ?>