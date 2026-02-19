<?php

session_start();

if (isset($_GET['role']) && $_GET['role'] === 'client') {
    $_SESSION['role'] = 'client';
}

require 'header.php';
require 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO requests (clientName, phone, address, problemText, status, createdAt, updatedAt) VALUES (?, ?, ?, ?, 'new', NOW(), NOW())");
    $stmt->execute([
        $_POST['clientName'],
        $_POST['phone'],
        $_POST['address'],
        $_POST['problemText']
    ]);
    echo "<p style='color:green;'>Заявка создана!</p>";
}
?>

<h1>Создать заявку</h1>
<form method="POST">
    <input name="clientName" placeholder="Имя клиента" required><br>
    <input name="phone" placeholder="Телефон" required><br>
    <input name="address" placeholder="Адрес" required><br>
    <textarea name="problemText" placeholder="Описание проблемы" required></textarea><br>
    <button type="submit">Создать</button>
</form>

<?php require 'footer.php'; ?>



