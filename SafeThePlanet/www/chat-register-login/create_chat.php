<?php
//старт сессии
	session_start ();
	$_SESSION["chat"] = false;
	include "session.php";// удаление из базы данных чата пользователя
	if (empty($_SESSION["username"])) { //если пользователь не зарегестрировался
		header("Location:login.php"); // переход на страницу авторизации
	}
	//подключение базы данных
	$mysqli = new mysqli ("localhost","root","","chatbox");
	$mysqli->query ("SET NAMES'utf8'");
	//упрощение переменных
	$people = $_SESSION["username"];
	$name = $_POST["name"];
	$description = $_POST["description"];
	$theme = $_POST["tema"];
	$peoples_quantity = $_POST["quantity"];
	//проверка на нажатие кнопки
	if (isset($_POST["done"])) {
		//проверка на ошибки
			if (strlen($_POST["name"]) == 0) {
			$error_name = "введите название петиции";
			$error = true; // вспомогательная переменная
		}
		if (strlen($_POST["name"]) > 30) {
			$error_name = "слишком длинное название";
			$error = true;
		}
		if (strlen($_POST["description"]) == 0) {
			$error_k_description = "напишите краткое описание петиции";
			$error = true;
		}
		if (strlen($_POST["description"]) > 100) {
			$error_k_description = "слишком длинное описание";
			$error = true;
		}
		switch ($_POST["tema"]) {
			case "default":
				$error_tema = "выберите тему";
			break;
			$error = true;
		}
		if ($_POST["quantity"] == 0) {
			$error_quantity = "Введите число людей";
			$error = true;
		}
		if ($_POST["quantity"] >= 1000000000) {
			$error_quantity = "слишком большое число людей";
			$error = true;
		}
		//если ошибок нет
		if ($error == false) {
			$success = $mysqli->query ("INSERT INTO  `chatbox`.`chat` (`name`,`description`,`theme`,`user`,`quantity`) 
			VALUES ('$name','$description','$theme','$people','$peoples_quantity')"); //записываем в базу данных чат
			header("Location:find_chat.php"); //переводим пользователя на страницу поиска чата
		}
	}
?>


<!DOCKTYPE html>
<html>
<head>
<link href="https://fonts.googleapis.com/css?family=Alfa+Slab+One|Roboto|Russo+One" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Scada:700" rel="stylesheet">
<meta HTTP-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="description" content="Этот сайт нужен чтобы предлагать петиции против мировых проблем"/>
<meta name="keywords"  content="петиции, Safe the planet, планета, " />
<link  href= styles_for_create_chat.css  rel="stylesheet"  type="text/css" />
</head>
<body>
	<div style="min-width:1350px">
		<?php 
			include "header.php";
		?>
	<form action="" method="post">
		<div class="center">
			<div class="petition_maker">
				<p>Введите название чата</p>
				<small><p style="color:grey;">макс.длина - 30 символов</p></small>
				<small><p style="color:red"><?=$error_name?></p></small>
				<input type="text" style="top:30px" name="name" class="textarea">
			</div>
			<div class="petition_maker">
					<p>Напишите краткое описание чата</p>
					<small><p style="color:grey;">макс.длина - 100 символов</p></small>
					<textarea class="textarea"  name="description" cols="20" rows="2"></textarea>
					<small><span style="color:red"><?=$error_k_description?></span></small>
			</div>
			<div class="petition_maker" style="min-height:330px;">
				<p>Выберите тему чата</p>
				<small><p style="color:red"><?=$error_tema?></p></small>
				<select class="textarea" name="tema" style="margin-top:8px;">
					<option value="default">Тема</option>
					<option>мира и разоружения</option>
					<option>экологическая</option>
					<option>демографическая</option>
					<option>энергетическая</option>
					<option>сырьевая</option>
					<option>продовольственная</option>
					<option>использование ресурсов Мирового океана</option>
					<option>освоение космоса</option>
				</select>
			</div>
			<div class="petition_maker">
				<p>Напишите макс. кол-во пользователей в чате</p>
				<small><p style="color:grey;">макс.длина - 10 символов</p></small>
				<textarea class="textarea"  name="quantity" cols="20" rows="1"></textarea>
				<small><span style="color:red"><?=$error_quantity?></span></small>
			</div>
			<div id="done">
				<input type="submit" name="done" id="done_button">
			</div>
		</form>
	</div>
</body>
</html>
