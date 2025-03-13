<?php
include './includes/header.php';
include './config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contenu = $_POST['contenu'];
    $type_conseil = $_POST['type_conseil'];

    $sql = "INSERT INTO conseils (contenu, type_conseil, date_publication) VALUES (?, ?, NOW())";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$contenu, $type_conseil]);

    echo "Conseil ajouté avec succès !";
}
?>

<div class="container mt-5">
    <h2>Ajouter un conseil</h2>
    <form method="POST">
        <textarea name="contenu" class="form-control mt-2" placeholder="Contenu" required></textarea>
        <select name="type_conseil" class="form-control mt-2" required>
            <option value="administratif">Administratif</option>
            <option value="orientation">Orientation</option>
        </select>
        <button type="submit" class="btn btn-primary mt-3">Ajouter</button>
    </form>
</div>

<?php include './includes/footer.php'; ?>