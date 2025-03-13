<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Démarrage de la session pour accéder aux variables de session
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guide Bacheliers</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<style>
    .nav-link-custom {
        background-color: rgba(255, 255, 255, 0.2); /* Fond blanc légèrement transparent */
        border-radius: 50px; /* Arrondi */
        padding: 10px 15px;
        transition: all 0.3s ease-in-out;
    }

    .nav-link-custom:hover {
        background-color: rgba(255, 255, 255, 0.4); /* Fond plus clair au survol */
        color: #fff !important;
        transform: scale(1.1); /* Agrandir légèrement */
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary bg-opacity-75">
    <div class="container">
        <a class="navbar-brand fw-bold" href="../index.php">Guide Bacheliers</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <?php 
                $page = basename($_SERVER['PHP_SELF']); // Récupère le nom de la page actuelle

                if ($page == 'index.php') { ?>
                    <li class="nav-item mx-2"><a class="nav-link nav-link-custom text-white" href="../pages/register.php">Inscription</a></li>
                    <li class="nav-item mx-2"><a class="nav-link nav-link-custom text-white" href="../pages/login.php">Connexion</a></li>
                <?php } else { ?>
                    <li class="nav-item mx-2"><a class="nav-link nav-link-custom text-white" href="../pages/accueil.php">Accueil</a></li>
                    <li class="nav-item mx-2"><a class="nav-link nav-link-custom text-white" href="../pages/orientation.php">Établissement</a></li>
                    <li class="nav-item mx-2"><a class="nav-link nav-link-custom text-white" href="../pages/conseils.php">Conseils</a></li>
                    <?php if ((isset($_SESSION['role']) && $_SESSION['role'] == 'conseiller') || (isset($_SESSION['role']) && $_SESSION['role'] == 'administrateur')) : ?>
                        <li class="nav-item mx-2"><a class="nav-link nav-link-custom text-white" href="../pages/conseiller.php">Conseiller</a></li>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'administrateur') : ?>
                        <li class="nav-item mx-2"><a class="nav-link nav-link-custom text-white" href="../pages/admin.php">Administrateur</a></li>
                    <?php endif; ?>
                    <li class="nav-item mx-2"><a class="nav-link nav-link-custom text-white" href="../pages/profil.php">Profil</a></li>
                    <li class="nav-item mx-2"><a class="nav-link nav-link-custom text-white" href="../pages/contact.php">Contacts</a></li>
                    <li class="nav-item mx-2"><a class="nav-link nav-link-custom text-white" href="../pages/logout.php">Déconnexion</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>


