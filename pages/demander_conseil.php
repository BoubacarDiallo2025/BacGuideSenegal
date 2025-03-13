<?php
// Démarrage de la session pour pouvoir utiliser les variables de session
session_start();

// Vérifie si l'utilisateur est connecté et s'il a le rôle de "conseiller"
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'bachelier') {
    // Redirige vers la page de connexion s'il n'est pas un conseiller ou s'il n'est pas connecté
    header("Location: login.php");
    exit(); // Arrête l'exécution du script après la redirection
}

// Inclusion du fichier de configuration de la base de données
include './config/database.php';

// Inclusion de l'en-tête de la page (contient les balises HTML de début)
include './includes/header.php';


// Vérifie si la requête est de type POST (lorsque le formulaire est soumis)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $contenu = $_POST['contenu'];
    $type_conseil = $_POST['type_conseil'];

    // Préparation de la requête SQL pour insérer une demande de conseil dans la base de données
    $sql = "INSERT INTO demandes_conseils (contenu, demandeur_id, type_conseil) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    // Exécution de la requête en passant les valeurs (contenu de la demande, l'ID du demandeur et le type de conseil)
    $stmt->execute([$contenu, $_SESSION['user_id'], $type_conseil]);

    // Affichage d'un message de confirmation
    echo "Demande de conseil envoyée !";
}
?>

<!-- Formulaire permettant de demander un conseil -->
<form method="POST">
    <!-- Zone de texte pour écrire la demande de conseil -->
    <textarea name="contenu" class="form-control mt-2" placeholder="Écrire votre demande de conseil" required></textarea>
    
    <!-- Sélection du type de conseil -->
    <div class="form-group mt-2">
        <label for="type_conseil">Type de conseil :</label>
        <select name="type_conseil" id="type_conseil" class="form-control" required>
            <option value="administratif">Administratif</option>
            <option value="orientation">Orientation</option>
        </select>
    </div>
    
    <!-- Bouton pour soumettre le formulaire -->
    <button type="submit" class="btn btn-success mt-3">Envoyer</button>
</form>


<?php include './includes/footer.php'; ?>
