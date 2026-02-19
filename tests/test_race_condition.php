<?php
require '../config/db.php';

$id = 1;

$stmt = $pdo->prepare("
    UPDATE requests 
    SET status = 'in_progress' 
    WHERE id = ? AND status = 'assigned'
");

$stmt->execute([$id]);

if ($stmt->rowCount() === 0) {
    echo "OK: защита работает\n";
} else {
    echo "UPDATED\n";
}