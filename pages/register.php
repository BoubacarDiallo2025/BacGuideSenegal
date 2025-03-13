<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"></script>
    <style>
        body {
            background: linear-gradient(135deg, #e3f2fd, #90caf9);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .form-container {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
        }
        .form-container h2 {
            margin-bottom: 20px;
        }
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
        .btn-outline-primary {
            border-color: #007bff;
            color: #007bff;
        }
        .btn-outline-primary:hover {
            background-color: #007bff;
            color: #fff;
        }
    </style>
    <script>
        function validerFormulaire(event) {
            let nom = document.getElementById("nom").value.trim();
            let prenom = document.getElementById("prenom").value.trim();
            let email = document.getElementById("email").value.trim();
            let motDePasse = document.getElementById("mot_de_passe").value.trim();
            
            // Vérification des champs
            if (nom === "" || prenom === "" || email === "" || motDePasse === "") {
                alert("Tous les champs sont obligatoires !");
                event.preventDefault();
                return false;
            }

            // Vérification du format de l'email
            let emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!emailRegex.test(email)) {
                alert("Veuillez entrer un email valide !");
                event.preventDefault();
                return false;
            }

            // Vérification de la force du mot de passe (au moins 6 caractères)
            if (motDePasse.length < 6) {
                alert("Le mot de passe doit contenir au moins 6 caractères !");
                event.preventDefault();
                return false;
            }

            return true;
        }
    </script>
</head>

<div class="form-container">
    <h2 class="text-center text-success"><i class="bi bi-person-plus"></i> Inscription</h2>

    <form action="traitement_register.php" method="POST" onsubmit="return validerFormulaire(event)">

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
            <small class="text-muted">Au moins 6 caractères</small>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Rôle</label>
            <select id="role" name="role" class="form-select" required>
                <option value="bachelier">Bachelier</option>
                <option value="conseiller">Conseiller</option>
                <option value="parent">Parent</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success w-100"><i class="bi bi-check-circle"></i> S'inscrire</button>
    </form>

    <!-- Bouton pour rediriger vers la page de connexion -->
    <div class="text-center mt-3">
        <a href="login.php" class="btn btn-outline-primary"><i class="bi bi-box-arrow-in-right"></i> Se connecter</a>
    </div>
</div>