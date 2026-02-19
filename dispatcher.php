<?php
session_start();
require 'config/db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'dispatcher') {
    header('Location: login.php');
    exit;
}

require 'header.php';

$masters = [
    2 => 'Саша',
    3 => 'Петя'
];

// Диспетчер назначает статус assigned (без выбора конкретного мастера)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['action'] === 'assign') {
        $stmt = $pdo->prepare("UPDATE requests SET status='assigned', updatedAt=NOW() WHERE id=? AND status='new'");
        $stmt->execute([$_POST['id']]);
    } elseif ($_POST['action'] === 'cancel') {
        $stmt = $pdo->prepare("UPDATE requests SET status='canceled', updatedAt=NOW() WHERE id=?");
        $stmt->execute([$_POST['id']]);
    }
}

// Все заявки
$requests = $pdo->query("SELECT * FROM requests ORDER BY createdAt DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Панель диспетчера</h1>
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
        <?php if ($r['status'] === 'new'): ?>
            <form method="POST" style="display:inline">
                <input type="hidden" name="id" value="<?= $r['id'] ?>">
                <button type="submit" name="action" value="assign">Назначить мастера</button>
            </form>
        <?php endif; ?>
        <?php if ($r['status'] !== 'done' && $r['status'] !== 'canceled'): ?>
            <form method="POST" style="display:inline">
                <input type="hidden" name="id" value="<?= $r['id'] ?>">
                <button type="submit" name="action" value="cancel">Отменить</button>
            </form>
        <?php endif; ?>
    </td>
</tr>
<?php endforeach; ?>
</table>

<?php require 'footer.php'; ?>




