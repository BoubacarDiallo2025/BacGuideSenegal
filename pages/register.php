<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<div class="container mt-5">
    <h2>Inscription</h2>
    <form action="traitement_register.php" method="POST">
        
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" id="nom" name="nom" class="form-control" placeholder="Entrez votre nom" required>
        </div>

        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" id="prenom" name="prenom" class="form-control" placeholder="Entrez votre prénom" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Entrez votre email" required>
        </div>

        <div class="mb-3">
            <label for="mot_de_passe" class="form-label">Mot de passe</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" class="form-control" placeholder="Créez un mot de passe" required>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Rôle</label>
            <select id="role" name="role" class="form-select" required>
                <option value="bachelier">Bachelier</option>
                <option value="conseiller">Conseiller</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">S'inscrire</button>
    </form>
</div>
