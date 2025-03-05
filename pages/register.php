<?php include '../includes/header.php'; ?>
<div class="container mt-5">
    <h2>Inscription</h2>
    <form action="traitement_register.php" method="POST">
        <input type="text" name="nom" class="form-control" placeholder="Nom" required>
        <input type="text" name="prenom" class="form-control mt-2" placeholder="Prénom" required>
        <input type="email" name="email" class="form-control mt-2" placeholder="Email" required>
        <input type="text" name="telephone" class="form-control mt-2" placeholder="Téléphone" required>
        <input type="password" name="mot_de_passe" class="form-control mt-2" placeholder="Mot de passe" required>
        
        <select name="role" class="form-control mt-2" required>
            <option value="bachelier">Bachelier</option>
            <option value="conseiller">Conseiller</option>
        </select>

        <button type="submit" class="btn btn-success mt-3">S'inscrire</button>
    </form>
</div>
<?php include '../includes/footer.php'; ?>
