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
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">Guide Bacheliers</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php 
                $page = basename($_SERVER['PHP_SELF']); // Récupère le nom de la page actuelle

                if ($page == 'index.php') { ?>
                    <li class="nav-item"><a class="nav-link" href="../pages/register.php">Inscription</a></li>
                    <li class="nav-item"><a class="nav-link" href="../pages/login.php">Connexion</a></li>
                <?php } else { ?>
                    <li class="nav-item"><a class="nav-link" href="../pages/accueil.php">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="../pages/orientation.php">Orientation</a></li>
                    <li class="nav-item"><a class="nav-link" href="../pages/conseils.php">Conseils</a></li>
                    <li class="nav-item"><a class="nav-link" href="../pages/contact.php">Contacts</a></li>
                    <li class="nav-item"><a class="nav-link" href="../pages/profil.php">Profil</a></li>
                    <li class="nav-item"><a class="nav-link" href="../pages/logout.php">Déconnexion</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
