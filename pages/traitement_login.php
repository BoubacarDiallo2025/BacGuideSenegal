<?php
// Démarrage de la session pour stocker les informations de l'utilisateur connecté
session_start();

// Inclusion du fichier de connexion à la base de données
include './config/database.php';

// Vérification si le formulaire a été soumis via la méthode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire et validation de base
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $mot_de_passe = $_POST['mot_de_passe'];

    if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($mot_de_passe)) {
        // Préparation de la requête SQL pour récupérer l'utilisateur correspondant à l'email fourni
        $sql = "SELECT * FROM utilisateurs WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);

        // Récupération des résultats sous forme de tableau associatif
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérification si l'utilisateur existe et si le mot de passe est correct
        if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
            // Stockage des informations de l'utilisateur dans la session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nom'] = $user['nom'];
            $_SESSION['role'] = $user['role'];

            // Redirection vers la page de profil après connexion réussie
            header("Location: accueil.php");
            exit();
        } else {
            // Message d'erreur en cas d'identifiants incorrects
            echo "Identifiants incorrects.";
        }
    } else {
        // Message d'erreur en cas de données invalides
        echo "Veuillez entrer une adresse email valide et un mot de passe.";
    }
}
?>
