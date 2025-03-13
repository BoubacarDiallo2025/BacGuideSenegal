<?php
include './includes/header.php';
include './config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];
    $role = $_POST['role'];

    // Hacher le mot de passe
    $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

    $sql = "INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe, role) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom, $prenom, $email, $mot_de_passe_hash, $role]);

    echo "Utilisateur ajouté avec succès !";
}
?>

<div class="container mt-5">
    <h2>Ajouter un utilisateur</h2>
    <form method="POST">
        <input type="text" name="nom" class="form-control mt-2" placeholder="Nom" required>
        <input type="text" name="prenom" class="form-control mt-2" placeholder="Prénom" required>
        <input type="email" name="email" class="form-control mt-2" placeholder="Email" required>
        <input type="password" name="mot_de_passe" class="form-control mt-2" placeholder="Mot de passe" required>
        <select name="role" class="form-control mt-2" required>
            <option value="bachelier">Bachelier</option>
            <option value="conseiller">Conseiller</option>
        </select>
        <button type="submit" class="btn btn-primary mt-3">Ajouter</button>
    </form>
</div>

<?php include './includes/footer.php'; ?>