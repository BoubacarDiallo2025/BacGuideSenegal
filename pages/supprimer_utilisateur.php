<?php
include './config/database.php';

$id = $_GET['id'];

$sql = "DELETE FROM utilisateurs WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

header("Location: admin.php");
exit();
?>