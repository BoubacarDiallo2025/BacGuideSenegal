<?php
$host = "mysql-abdoul-salam-diallo.alwaysdata.net";
$user = "405601_guidebach";
$pass = "Asd781209169#";
$dbname = "abdoul-salam-diallo_guidebacheliers";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
