<?php
// Démarrage de la session pour pouvoir utiliser les variables de session
session_start();

// Inclusion du fichier de configuration de la base de données
include './config/database.php';

// Inclusion de l'en-tête de la page (contient les balises HTML de début)
include './includes/header.php';

// Vérifie si la requête est de type POST (lorsque le formulaire est soumis)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $contenu = $_POST['contenu'];
    $type_conseil = $_POST['type_conseil'];

    // Préparation de la requête SQL pour insérer un conseil dans la base de données
    $sql = "INSERT INTO conseils (contenu, conseiller_id, type_conseil) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    // Exécution de la requête en passant les valeurs (contenu du conseil, l'ID du conseiller et le type de conseil)
    $stmt->execute([$contenu, $_SESSION['user_id'], $type_conseil]);

    // Affichage d'un message de confirmation
    echo "<div class='alert alert-success text-center'>Conseil ajouté avec succès !</div>";
}
?>

<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="width: 40rem;">
        <h3 class="text-center mb-3">Publier un Conseil</h3>

        <!-- Formulaire permettant d'écrire un conseil -->
        <form method="POST">
            <!-- Zone de texte pour écrire le conseil -->
            <div class="form-group">
                <label for="contenu">Votre Conseil :</label>
                <textarea name="contenu" id="contenu" class="form-control" placeholder="Écrire un conseil" required></textarea>
            </div>
            
            <!-- Sélection du type de conseil -->
            <div class="form-group mt-3">
                <label for="type_conseil">Type de conseil :</label>
                <select name="type_conseil" id="type_conseil" class="form-control" required>
                    <option value="administratif">Administratif</option>
                    <option value="orientation">Orientation</option>
                </select>
            </div>
            
            <!-- Bouton pour soumettre le formulaire -->
            <div class="text-center">
                <button type="submit" class="btn btn-success mt-3">Publier</button>
            </div>
        </form>
    </div>
</div>

<?php include './includes/footer.php'; ?>
