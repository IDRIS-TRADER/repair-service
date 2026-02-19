<?php
// Настройки подключения к базе данных
$host = 'MySQL-8.0'; // или 'localhost' в зависимости от OpenServer
$db   = 'test-site-bd';
$user = 'root';
$pass = '';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (\PDOException $e) {
    echo "Ошибка подключения к БД: " . $e->getMessage();
    exit;
}

