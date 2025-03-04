<?php
session_start();
include '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contenu = $_POST['contenu'];
    $sql = "INSERT INTO conseils (contenu, conseiller_id) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$contenu, $_SESSION['user_id']]);
    echo "Conseil ajouté !";
}
?>
<form method="POST">
    <textarea name="contenu" class="form-control mt-2" placeholder="Écrire un conseil" required></textarea>
    <button type="submit" class="btn btn-success mt-3">Publier</button>
</form>
