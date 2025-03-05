<?php
// Démarrage de la session pour accéder aux variables de session
session_start();

// Vérification si l'utilisateur est connecté, sinon redirection vers la page de connexion
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Inclusion du fichier d'en-tête
include './includes/header.php';
?>

<div class="container mt-5">
    <!-- Affichage d'un message de bienvenue avec le nom de l'utilisateur -->
    <h2>Bienvenue <?= htmlspecialchars($_SESSION['nom']) ?> !</h2>
    <!-- Affichage du rôle de l'utilisateur -->
    <p>Votre rôle : <?= $_SESSION['role'] ?></p>
    <!-- Lien pour se déconnecter -->
    <a href="logout.php" class="btn btn-danger">Déconnexion</a>
</div>

<?php
// Inclusion du fichier de pied de page
include './includes/footer.php';
?>
