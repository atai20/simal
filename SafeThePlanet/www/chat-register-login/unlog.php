<?php
//начало сессии
session_start();
include "session.php"; // удаление из базы данных чата пользователя
session_destroy(); // уничтожение сессии
header("Location:index.php"); // перебрасывание на главную страницу
?>