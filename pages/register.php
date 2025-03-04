<?php include '../includes/header.php'; ?>
<div class="container mt-5">
    <h2>Inscription</h2>
    <form action="traitement_inscription.php" method="POST">
        <input type="text" name="nom" class="form-control" placeholder="Nom" required>
        <input type="email" name="email" class="form-control mt-2" placeholder="Email" required>
        <input type="password" name="mot_de_passe" class="form-control mt-2" placeholder="Mot de passe" required>
        <button type="submit" class="btn btn-success mt-3">S'inscrire</button>
    </form>
</div>
<?php include '../includes/footer.php'; ?>
