<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }

        .login-container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .form-control {
            padding: 10px;
        }

        .form-group {
            position: relative;
        }

        .form-group i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: gray;
        }

        .form-control {
            padding-left: 35px;
        }
    </style>

<div class="login-container">
    <h2 class="mb-4 text-primary">Connexion</h2>

    <form action="traitement_login.php" method="POST">
        <div class="form-group mb-3">
            <i class="bi bi-envelope-fill"></i>
            <input type="email" name="email" class="form-control" placeholder="Email" required>
        </div>
        
        <div class="form-group mb-3">
            <i class="bi bi-lock-fill"></i>
            <input type="password" name="mot_de_passe" class="form-control" placeholder="Mot de passe" required>
        </div>
        
        <button type="submit" class="btn btn-primary w-100">Se connecter</button>
    </form>

    <hr>

    <p class="mt-2">Pas encore de compte ?</p>
    <a href="register.php" class="btn btn-outline-primary w-100">S'inscrire</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>