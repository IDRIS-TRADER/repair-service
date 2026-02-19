<?php
session_start();

// Выход
if(isset($_GET['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit;
}

// Обработка выбора роли
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $role = $_POST['role'] ?? '';
    $master = $_POST['master'] ?? '';

    if ($role === 'dispatcher') {
        $_SESSION['role'] = 'dispatcher';
        header('Location: dispatcher.php');
        exit;
    } elseif ($role === 'master' && $master) {
        $_SESSION['role'] = 'master';
        $_SESSION['master'] = $master;
        header('Location: master.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход в систему</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            max-width: 400px;
            width: 100%;
            background: #ffffff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
            text-align: center;
        }

        h1 {
            margin-bottom: 30px;
            font-weight: 600;
        }

        button {
            width: 100%;
            padding: 12px 14px;
            margin-bottom: 12px;
            border-radius: 8px;
            border: none;
            background: #667eea;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s ease;
        }

        button:hover {
            background: #5a67d8;
            transform: translateY(-2px);
        }

        form {
            margin-bottom: 10px;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Войти в систему</h1>

    <a href="login.php">
        <button type="button">Как клиент</button>
    </a>

    <form method="POST">
        <button type="submit" name="role" value="dispatcher">
            Как диспетчер
        </button>
    </form>

    <form method="POST">
        <input type="hidden" name="role" value="master">
        <button type="submit" name="master" value="sasha">
            Как мастер Саша
        </button>
        <button type="submit" name="master" value="petya">
            Как мастер Петя
        </button>
    </form>
</div>

</body>
</html>





