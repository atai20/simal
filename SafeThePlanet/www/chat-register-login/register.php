<?php
//старт сессии
session_start();
//подключение удаления пользователя из чата
include "session.php";
$_SESSION["chat"] = false;
//проверка на нажатие кнопки
if(isset($_POST['register'])) {
	//подключение базы данных
	$con = mysqli_connect('localhost', 'root', '', 'chatbox');
	mysqli_query($con, "SET NAMES 'utf8'");
	//упрощение переменных
	$uname = $_POST['username'];
	$pword = $_POST['password'];
	$pword2 = $_POST['password2'];
	//если пользователь не ввёл имя или пароль
	if ($uname == "" || $pword == "") {
		$error_username = "Введите имя и пароль";
		$error = true; //вспомогательная переменная
	}
	//если пароли не совпадают
	if($pword != $pword2) {
		$error_password = "Вы неправильно повторили пароль";
		$error = true;
	}
	else {
		//выбираем значения имени в таблице пользователей где имя равно тому что мы ввели
		$checkexist = mysqli_query($con, "SELECT username FROM users WHERE username = '$uname'");
		//если такое значение в базе данных есть
		if(mysqli_num_rows($checkexist)) {
			$error_username = "Это имя уже занято. Введите другое.";
			$error = true;
		}
		if ($error != true) {
			//записываем значение в базу данных
			mysqli_query($con,"INSERT INTO `users` (`username`,`password`,`petition_count`) VALUES ('$uname','$pword','$pet')" );
			$result = mysqli_query($con,"SELECT * FROM users WHERE username='$uname'");
			$myrow = mysqli_fetch_array($result);
			//добавляем значения для сессий
			$_SESSION['username']=$myrow['username'];
			$_SESSION['ide']=$myrow['id'];
			$_SESSION["petitions"] = $myrow["petition_count"];
			$pet = $_SESSION["petitions"];
			//переход на главную страницу
			header("Location:index.php");
		}		
	}

}

?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="styles_for_register.css">
<title>регистрация</title>
</head>
<body>
	<form name="form1" action="register.php" method="post">
		<div class="border">
			<img class="logo" src="logo-login.png"/>
			<div class="content">
				<span class="label" id='name'> Введите имя пользователя</span>
				<br><span style="color:red; font-size:1em" class="label"><?=$error_username?></span></small><br><br>
				<input type="text" class="textarea" name="username"/><br><br>
				<span class="label"> Введите пароль </span><br><br>
				<br><span style="color:red; font-size:1em" class="label"><?=$error_password?></span></small>
				<input type="password" class="textarea" name="password"/><br><br>
				<span class="label"> Повторите пароль </span><br><br><br>
				<input type="password" class="textarea" name="password2"><br><br>
				<input type="submit" name="register" class="submit" value="зарегестрироваться">
			</div>
		</div>
	</form>
</body>
</html>