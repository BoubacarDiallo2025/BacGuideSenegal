<?php
// Démarre la session pour pouvoir accéder aux variables de session
session_start();

// Vérifie si l'utilisateur est connecté et s'il a le rôle de "conseiller"
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'conseiller') {
    // Redirige vers la page de connexion s'il n'est pas un conseiller ou s'il n'est pas connecté
    header("Location: login.php");
    exit(); // Arrête l'exécution du script après la redirection
}

// Inclut l'en-tête de la page (contient généralement les balises HTML de début)
include '../includes/header.php';
?>

<!-- Contenu principal de la page -->
<div class="container mt-5">
    <h2>Espace Conseiller</h2>
    
    <!-- Affiche un message de bienvenue avec le nom du conseiller connecté -->
    <p>Bienvenue, <?= htmlspecialchars($_SESSION['nom']) ?> !</p>

    <!-- Bouton pour rediriger vers la page d'ajout d'un conseil -->
    <a href="ajouter_conseil.php" class="btn btn-primary">Ajouter un conseil</a>
</div>

<?php 
// Inclut le pied de page (fermeture des balises HTML, scripts JS, etc.)
include '../includes/footer.php'; 
?>
