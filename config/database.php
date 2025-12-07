<?php
// Charger les variables d'environnement
$host = getenv('DB_HOST') ?: 'mysql-abdoul-salam-diallo.alwaysdata.net';
$user = getenv('DB_USER') ?: '405601_guidebach';
$pass = getenv('DB_PASS') ?: 'Asd781209169#';
$dbname = getenv('DB_NAME') ?: 'abdoul-salam-diallo_guidebacheliers';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
