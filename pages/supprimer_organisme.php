<?php
include './config/database.php';

$id = $_GET['id'];

$sql = "DELETE FROM organisme_gouvernemental WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

header("Location: admin.php");
exit();
?>