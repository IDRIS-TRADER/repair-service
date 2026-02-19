<?php
require 'config/db.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare("UPDATE requests SET status = 'in_progress' WHERE id = ? AND status = 'assigned'");
    $stmt->execute([$id]);

    if ($stmt->rowCount() === 0) {
        echo "Заявка уже взята!";
        exit;
    }
}

header("Location: master.php");
exit;
