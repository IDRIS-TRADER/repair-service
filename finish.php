<?php
require 'config/db.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare("UPDATE requests SET status = 'done' WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: master.php");
exit;
