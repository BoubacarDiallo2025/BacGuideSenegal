<?php 
session_start(); // Démarrer la session pour stocker les messages d'erreur
include "./config/database.php";

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération et validation des données
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $email = trim($_POST['email']);
    $mot_de_passe = $_POST['mot_de_passe'];
    $role = $_POST['role']; // "bachelier" ou "conseiller"

    // Vérification de l'email déjà existant
    $checkEmail = $pdo->prepare("SELECT id FROM utilisateurs WHERE email = ?");
    $checkEmail->execute([$email]);

    if ($checkEmail->rowCount() > 0) {
        $errors['email'] = "Cet email est déjà utilisé.";
    }

    // Vérifications supplémentaires
    if (empty($nom)) {
        $errors['nom'] = "Le champ nom est obligatoire.";
    }
    if (empty($prenom)) {
        $errors['prenom'] = "Le champ prénom est obligatoire.";
    }
    if (empty($email)) {
        $errors['email'] = "Le champ email est obligatoire.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "L'adresse email n'est pas valide.";
    }
    if (empty($mot_de_passe)) {
        $errors['mot_de_passe'] = "Le champ mot de passe est obligatoire.";
    } elseif (strlen($mot_de_passe) < 6) {
        $errors['mot_de_passe'] = "Le mot de passe doit contenir au moins 6 caractères.";
    }

    // Si pas d'erreurs, on insère dans la base de données
    if (empty($errors)) {
        $mot_de_passe_hache = password_hash($mot_de_passe, PASSWORD_DEFAULT); // Hash du mot de passe

        $sql = "INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe, role) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        
        if ($stmt->execute([$nom, $prenom, $email, $mot_de_passe_hache, $role])) {
            $_SESSION['success'] = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
            header("Location: login.php");
            exit();
        } else {
            $_SESSION['error'] = "Une erreur s'est produite lors de l'inscription. Veuillez réessayer.";
        }
    } else {
        $_SESSION['errors'] = $errors;
    }
    
    // Rediriger vers la page d'inscription en cas d'erreur
    header("Location: register.php");
    exit();
}
?>
