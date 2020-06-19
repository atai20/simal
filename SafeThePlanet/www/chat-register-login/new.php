<?php
//старт сессии
session_start();
//ссылки когда ты не вошел в аккаунт
$href_log = "<a class='akkaynt' href='login.php'>";
$href_reg = "<a class='akkaynt' href='register.php'>";
//упрощение переменных
$user = $_SESSION["username"];
$petition_count = $_SESSION["petitions"];
//текст когда ты не вошёл в аккаунт
$log = "Войти";
$reg = "Зарегестрироваться";
//если сессия имени пуста 
if (!(empty($_SESSION["username"]))) {
//то переменная равна быстрому меню и значку пользователя
$log = "<div class='content'>
<img class='default_user' src='default_user.png'/>
<div class='menu_user'>
<div class='ui'>
<span>имя: $user 
</span>
</div>
<div class='ui'>
<span>кол-во петиций: $petition_count
</span>
</div>
<div class='ui'>
<a href='unlog.php'>
<span>выйти из аккаунта</span>
</a>
</div>
</div>
</div>";
//остальные ссылки и текст пустые
$reg = "";
$href_reg = "";
$href_log = "";
}
?>