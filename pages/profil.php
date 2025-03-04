<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include '../includes/header.php';
?>
<div class="container mt-5">
    <h2>Bienvenue, <?= htmlspecialchars($_SESSION['nom']) ?> !</h2>
    <p>Votre rôle : <?= $_SESSION['role'] ?></p>
    <a href="logout.php" class="btn btn-danger">Déconnexion</a>
</div>
<?php include '../includes/footer.php'; ?>
