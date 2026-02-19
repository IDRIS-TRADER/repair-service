<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['role'])) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Сервис заявок</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
            min-height: 100vh;
            padding: 40px 20px;
            color: #333;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            background: #ffffff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
            animation: fadeIn 0.4s ease-in-out;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .role-title {
            font-weight: 600;
            font-size: 18px;
        }

        .logout-btn {
            background: #e53e3e;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: 0.2s ease;
        }

        .logout-btn:hover {
            background: #c53030;
            transform: translateY(-2px);
        }

        h1 {
            margin-bottom: 25px;
            font-weight: 600;
            color: #222;
        }

        input, textarea, button {
            width: 100%;
            padding: 12px 14px;
            margin-bottom: 12px;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 14px;
        }

        button {
            background: #667eea;
            color: white;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s ease;
        }

        button:hover {
            background: #5a67d8;
            transform: translateY(-2px);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background: #f5f6fa;
            font-weight: 600;
        }

        tr:nth-child(even) {
            background: #fafafa;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<div class="container">

<div class="top-bar">
    <div class="role-title">
        <?php
        // Сначала проверяем, есть ли роль в сессии
        if (!isset($_SESSION['role'])) {
            header('Location: index.php');
            exit;
        }

        // Теперь безопасно выводим название роли
        if ($_SESSION['role'] === 'dispatcher') {
            echo "Панель диспетчера";
        } elseif ($_SESSION['role'] === 'master') {
            echo "Панель мастера: " . ucfirst($_SESSION['master']);
        } elseif ($_SESSION['role'] === 'client') {
            echo "Панель клиента";
        }
        ?>
    </div>

    <form method="GET" action="logout.php" style="width:auto;">
        <button type="submit" class="logout-btn">Выйти</button>
    </form>
</div>






