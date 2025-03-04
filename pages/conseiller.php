<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'conseiller') {
    header("Location: login.php");
    exit();
}
include '../includes/header.php';
?>
<div class="container mt-5">
    <h2>Espace Conseiller</h2>
    <p>Bienvenue, <?= htmlspecialchars($_SESSION['nom']) ?> !</p>
    <a href="ajouter_conseil.php" class="btn btn-primary">Ajouter un conseil</a>
</div>
<?php include '../includes/footer.php'; ?>
