<?php
require '../config/db.php';

$stmt = $pdo->query("SELECT status FROM requests WHERE id = 1");
$status = $stmt->fetchColumn();

if ($status !== 'new') {
    exit("FAIL: статус не new\n");
}

echo "OK\n";
