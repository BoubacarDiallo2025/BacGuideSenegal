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

<div class="container mt-5 d-flex justify-content-center">
    <div class="card shadow-lg p-4" style="max-width: 500px; width: 100%;">
        <div class="card-body text-center">
            <!-- Affichage du message de bienvenue avec le nom de l'utilisateur -->
            <h2 class="text-success">
                <i class="bi bi-person-circle"></i> Bienvenue, <?= htmlspecialchars($_SESSION['nom']) ?> !
            </h2>

            <!-- Affichage du rôle de l'utilisateur -->
            <p class="mt-3"><strong>Votre rôle :</strong> <span class="badge bg-primary"><?= $_SESSION['role'] ?></span></p>

            <!-- Bouton de déconnexion -->
            <a href="logout.php" class="btn btn-danger mt-3">
                <i class="bi bi-box-arrow-right"></i> Déconnexion
            </a>
        </div>
    </div>
</div>

<?php
// Inclusion du fichier de pied de page
include './includes/footer.php';
?>
