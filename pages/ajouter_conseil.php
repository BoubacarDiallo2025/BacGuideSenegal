<?php
// Démarrage de la session pour pouvoir utiliser les variables de session
session_start();

// Inclusion du fichier de configuration de la base de données
include '../config/database.php';

// Vérifie si la requête est de type POST (lorsque le formulaire est soumis)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération du contenu du conseil soumis par l'utilisateur
    $contenu = $_POST['contenu'];

    // Préparation de la requête SQL pour insérer un conseil dans la base de données
    $sql = "INSERT INTO conseils (contenu, conseiller_id) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);

    // Exécution de la requête en passant les valeurs (contenu du conseil et l'ID du conseiller)
    $stmt->execute([$contenu, $_SESSION['user_id']]);

    // Affichage d'un message de confirmation
    echo "Conseil ajouté !";
}
?>

<!-- Formulaire permettant d'écrire un conseil -->
<form method="POST">
    <!-- Zone de texte pour écrire le conseil -->
    <textarea name="contenu" class="form-control mt-2" placeholder="Écrire un conseil" required></textarea>
    
    <!-- Bouton pour soumettre le formulaire -->
    <button type="submit" class="btn btn-success mt-3">Publier</button>
</form>
