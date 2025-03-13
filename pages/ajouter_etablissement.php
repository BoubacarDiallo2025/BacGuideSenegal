<?php
include './includes/header.php';
include './config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $type = $_POST['type'];
    $adresse = $_POST['adresse'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];

    $sql = "INSERT INTO etablissement (nom, type, adresse, email, tel) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom, $type, $adresse, $email, $tel]);

    echo "Établissement ajouté avec succès !";
}
?>

<div class="container mt-5">
    <h2>Ajouter un établissement</h2>
    <form method="POST">
        <input type="text" name="nom" class="form-control mt-2" placeholder="Nom" required>
        <input type="text" name="type" class="form-control mt-2" placeholder="Type" required>
        <input type="text" name="adresse" class="form-control mt-2" placeholder="Adresse" required>
        <input type="email" name="email" class="form-control mt-2" placeholder="Email" required>
        <input type="text" name="tel" class="form-control mt-2" placeholder="Téléphone" required>
        <button type="submit" class="btn btn-primary mt-3">Ajouter</button>
    </form>
</div>

<?php include './includes/footer.php'; ?>