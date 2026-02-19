<?php
session_start();
require 'config/db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'master') {
    header('Location: login.php');
    exit;
}

require 'header.php';

// Определяем мастера
$masterName = $_SESSION['master'];
$masterId = $masterName === 'sasha' ? 2 : 3;

// ==========================
// ДЕЙСТВИЯ МАСТЕРА
// ==========================
if (isset($_POST['action'], $_POST['id'])) {

    // Взять в работу (с защитой от гонки)
    if ($_POST['action'] === 'take') {

        $stmt = $pdo->prepare("
            UPDATE requests 
            SET status='in_progress',
                assignedTo=?,
                updatedAt=NOW()
            WHERE id=? AND status='assigned'
        ");

        $stmt->execute([$masterId, $_POST['id']]);

        if ($stmt->rowCount() === 0) {
            echo "<p style='color:red;'>Ошибка: заявку уже взял другой мастер!</p>";
        }
    }

    // Завершить
    elseif ($_POST['action'] === 'finish') {

        $stmt = $pdo->prepare("
            UPDATE requests 
            SET status='done',
                updatedAt=NOW()
            WHERE id=? AND status='in_progress' AND assignedTo=?
        ");

        $stmt->execute([$_POST['id'], $masterId]);
    }
}

// ==========================
// ПОЛУЧЕНИЕ ЗАЯВОК
// ==========================

// Показываем:
// 1) Все свободные assigned (чтобы можно было взять)
// 2) Все свои заявки (история)
$stmt = $pdo->prepare("
    SELECT * FROM requests
    WHERE status='assigned'
       OR assignedTo=?
    ORDER BY createdAt DESC
");

$stmt->execute([$masterId]);
$requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Панель мастера: <?= ucfirst($masterName) ?></h1>

<table border="1">
<tr>
    <th>Клиент</th>
    <th>Статус</th>
    <th>Действие</th>
</tr>

<?php foreach ($requests as $r): ?>
<tr>
    <td><?= htmlspecialchars($r['clientName']) ?></td>
    <td><?= $r['status'] ?></td>
    <td>

        <?php if ($r['status'] === 'assigned'): ?>
            <form method="POST" style="display:inline">
                <input type="hidden" name="id" value="<?= $r['id'] ?>">
                <button type="submit" name="action" value="take">Взять в работу</button>
            </form>

        <?php elseif ($r['status'] === 'in_progress' && $r['assignedTo'] == $masterId): ?>
            <form method="POST" style="display:inline">
                <input type="hidden" name="id" value="<?= $r['id'] ?>">
                <button type="submit" name="action" value="finish">Завершить</button>
            </form>

        <?php else: ?>
            -
        <?php endif; ?>

    </td>
</tr>
<?php endforeach; ?>
</table>

<?php require 'footer.php'; ?>




