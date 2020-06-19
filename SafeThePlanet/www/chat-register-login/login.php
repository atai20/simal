<?php
//начало сессии
session_start();
//подключение файла удаления пользователя из аккаунта
include "session.php";
$_SESSION["chat"] = false;
//подключение базы данных
$con = mysqli_connect('localhost', 'root', '', 'chatbox');
mysqli_query($con,"SET NAMES'utf8'");
//проверка на нажатие кнопки
if(isset($_POST['submit'])) {
	$uname = $_POST['username'];
			$result = mysqli_query($con,"SELECT * FROM users WHERE username='$uname'");
				$myrow = mysqli_fetch_array($result);
			//проверка на наличие такого логина
			if (empty($myrow['username'])) {
				$error_user = "неправильно введён логин";
			}
			//иначе
			else {
				//проверка на правильность введённого пароля
			if ($myrow["password"] == $_POST["password"]) {
				//присваивание значений сессии и перевод на главную страницу
				$_SESSION['username']=$myrow['username'];
				$_SESSION['ide']=$myrow['id'];
				$_SESSION["petitions"] = $myrow["petition_count"];
				header("Location:index.php");
			}
			else {
				$error_pass = "неправильно введён пароль";
			}
		}
}			
?>
<html>
	<head>
		<link rel="stylesheet" href="styles_for_login.css" type="text/css">
	</head>
	<body>
		<form name="form2" action="login.php" method="post">
		<div>
			<img src="logo-login.png"/>
			
			<div id='login'>
				<span class="label" >Введите имя пользователя</span><br>
				<small><span class="label" style="font-size:1.2em; color:red;"><?=$error_user?></span></small><br><br>
				<input type="text"  class="textarea" name="username"/><br>
				<span class="label" >Введите пароль</span><br><br>
				<small><span><?=$error_pass?></span></small>
				<input type="password" class="textarea" name="password"/><br><br><br>
				<input type="submit" name="submit" id="submit" value="Войти">
				<span class="registr"><a href="register.php" class="registr">Если вы ещё не зарегестрировались</a></span> 
				</div>
			</div>
		</form>
	</body>
</html>