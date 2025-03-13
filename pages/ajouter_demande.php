<?php
include './includes/header.php';
include './config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contenu = $_POST['contenu'];
    $type_conseil = $_POST['type_conseil'];
    $demandeur_id = $_POST['demandeur_id'];

    $sql = "INSERT INTO demandes_conseils (contenu, type_conseil, demandeur_id, date_demande) VALUES (?, ?, ?, NOW())";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$contenu, $type_conseil, $demandeur_id]);

    echo "<div class='alert alert-success text-center'>Demande de conseil ajoutée avec succès !</div>";
}
?>

<!-- Conteneur principal centré -->
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4" style="width: 40rem;">
        <h3 class="text-center mb-4">Ajouter une Demande de Conseil</h3>

        <!-- Formulaire -->
        <form method="POST">
            <!-- Zone de texte pour le contenu -->
            <div class="form-group">
                <label for="contenu">Contenu du Conseil :</label>
                <textarea name="contenu" id="contenu" class="form-control" placeholder="Rédigez votre demande..." required></textarea>
            </div>

            <!-- Sélection du type de conseil -->
            <div class="form-group mt-3">
                <label for="type_conseil">Type de conseil :</label>
                <select name="type_conseil" id="type_conseil" class="form-control" required>
                    <option value="administratif">Administratif</option>
                    <option value="orientation">Orientation</option>
                </select>
            </div>

            <!-- Sélection du demandeur -->
            <div class="form-group mt-3">
                <label for="demandeur_id">Demandeur :</label>
                <select name="demandeur_id" id="demandeur_id" class="form-control" required>
                    <?php
                    $sql = "SELECT id, nom, prenom FROM utilisateurs WHERE role = 'bachelier'";
                    $stmt = $pdo->query($sql);
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='{$row['id']}'>{$row['nom']} {$row['prenom']}</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Bouton d'envoi -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary mt-4 w-100">Ajouter</button>
            </div>
        </form>
    </div>
</div>

<?php include './includes/footer.php'; ?>
