<?php
session_start();    // запускаем сессию
session_unset();    // удаляем все переменные сессии
session_destroy();  // уничтожаем саму сессию

// Перенаправляем пользователя на страницу логина
header("Location: login.php");
exit();
?>
