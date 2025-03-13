<?php include 'includes/header.php'; ?>

<!-- Section Bannière -->
<section class="hero bg-primary text-white text-center py-5">
    <div class="container">
        <h1>Bienvenue sur le Guide en Ligne pour les Nouveaux Bacheliers !</h1>
        <p class="lead">Découvrez les établissements disponibles et obtenez des conseils pour votre orientation.</p>
        <a href="orientation.php" class="btn btn-light btn-lg mt-3">Explorer les établissements</a>
    </div>
</section>

<!-- Section Présentation -->
<section class="container my-5">
    <div class="row">
        <div class="col-md-6">
            <h2>À propos du guide</h2>
            <p>Ce guide est conçu pour aider les nouveaux bacheliers du Sénégal à s'orienter efficacement. 
                Il propose une base de données de formations, des conseils d'experts et un espace interactif 
                avec des conseillers universitaires.</p>
        </div>
        <div class="col-md-6">
            <img src="../assets/Images/etudiants.jpg" class="img-fluid rounded" alt="Étudiants en cours">
        </div>
    </div>
</section>

<!-- Section Services -->
<section class="bg-light py-5">
    <div class="container text-center">
        <h2>Nos Services</h2>
        <div class="row mt-4">
            <div class="col-md-4">
                <i class="fas fa-book-open fa-3x text-primary"></i>
                <h4 class="mt-3">Catalogue des établissements</h4>
                <p>Découvrez les différents établissements d'enseignement supérieur disponibles au Sénégal.</p>
            </div>
            <div class="col-md-4">
                <i class="fas fa-user-graduate fa-3x text-primary"></i>
                <h4 class="mt-3">Conseils en Orientation</h4>
                <p>Recevez des conseils d'experts pour bien choisir votre parcours universitaire.</p>
            </div>
            <div class="col-md-4">
                <i class="fas fa-chalkboard-teacher fa-3x text-primary"></i>
                <h4 class="mt-3">Espace Conseillers</h4>
                <p>Interagissez avec des professionnels de l'éducation pour poser vos questions.</p>
            </div>
        </div>
    </div>
</section>

<!-- Section Formations -->
<section class="container my-5">
    <h2 class="text-center">Etablissements Populaires</h2>
    <div class="row mt-4">
        <?php
        include 'config/database.php';
        $query = "SELECT * FROM etablissement ORDER BY id DESC LIMIT 3";
        $stmt = $pdo->query($query);
        while ($etablissement = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "
            <div class='col-md-4'>
                <div class='card mb-4'>
                    <div class='card-body'>
                        <h5 class='card-title'>{$etablissement['nom']}</h5>
                        <p class='card-text'>{$etablissement['type']}</p>
                         <p class='card-text'>{$etablissement['adresse']}</p>
                          <p class='card-text'>{$etablissement['email']}</p>
                           <p class='card-text'>{$etablissement['tel']}</p>
                        <a href='orientation.php' class='btn btn-primary'>Voir plus</a>
                    </div>
                </div>
            </div>";
        }
        ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
