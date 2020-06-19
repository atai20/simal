<?php
//старт сессии
	session_start ();
	$_SESSION["chat"] = false;
	include "session.php";// удаление из базы данных чата пользователя
	if (empty($_SESSION)) {//если пользователь не зарегестрировался
		header("Location:login.php");// переход на страницу авторизации
	}
	//подключение базы данных
	$mysqli = new mysqli ("localhost","root","","chatbox");
	$mysqli->query ("SET NAMES'utf8'");
	//упрощение переменных
	$people = $_SESSION["username"];
	$name = $_POST["name"];
	$description = $_POST["description"];
	$k_description = $_POST["k_description"];
	$theme = $_POST["tema"];
	$name_people = $_POST["name_people"];
	$surname_people = $_POST["surname"];
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
			$error_description = "напишите описание петиции";
			$error = true;
		}
		if (strlen($_POST["description"]) > 1000) {
			$error_description = "слишком длинное описание";
			$error = true;
		}
		if (strlen($_POST["k_description"]) == 0) {
			$error_k_description = "напишите краткое описание петиции";
			$error = true;
		}
		if (strlen($_POST["k_description"]) > 100) {
			$error_k_description = "слишком длинное описание";
			$error = true;
		}
		switch ($_POST["tema"]) {
			case "default":
				$error_tema = "выберите тему";
			break;
			$error = true;
		}
		if (strlen($_POST["name_people"]) == 0 || strlen($_POST["surname"]) == 0 ) {
			$error_people = "введите имя и фамилию";
			$error = true;
		}
		if (strlen($_POST["name_people"]) > 30)  {
			$error_people = "слишком длинное имя";
			$error = true;
		}
		if (strlen($_POST["surname"]) > 30 ) {
			$error_people = "слишком длинная фамилия";
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
		if ($error==false) {
			$user = $_SESSION['username'];
			$_SESSION["petitions"]++; //прибавление к колличеству петиций один
			$pet = $_SESSION["petitions"];
			$success = $mysqli->query ("INSERT INTO  `chatbox`.`petitions` (`name` ,`description` ,`theme` ,`name_people` ,`surname_people` ,`peoples_ quantity` ,`date`,`k_description`,`people`) 
			VALUES ('$name',  '$description',  '$theme',  '$name_people',  '$surname_people',  '$peoples_quantity',  '$date', '$k_description','$people')");//записываем в базу данных петицию
			$mysqli -> query ("UPDATE `chatbox`.`users` SET `petition_count`='$pet' WHERE `users`.`username`='$user'"); //изменение числа созданных петиций пользователем
			header("Location:index.php");//перенаправление на главную страницу
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
<link  href= styles_for_create_petitions.css  rel="stylesheet"  type="text/css" />
</head>
<body>
	<div style="min-width:1350px">
		<?php 
			include "header.php";
		?>
	<form action="" method="post">
		<div class="center">
			<div class="petition_maker">
				<p>Введите название</p>
				<small><p style="color:grey;">макс.длина - 30 символов</p></small>
				<small><p style="color:red"><?=$error_name?></p></small>
				<input type="text" style="top:30px" name="name" class="textarea">
			</div>
			<div class="petition_maker">
					<p>Напишите краткое описание петиции</p>
					<small><p style="color:grey;">макс.длина - 100 символов</p></small>
					<textarea class="textarea"  name="k_description" cols="20" rows="2"></textarea>
					<small><span style="color:red"><?=$error_k_description?></span></small>
			</div>
			<div class="petition_maker" style="height:180px;">
					<p>Напишите полное описание петиции</p>
					<small><p style="color:grey;">макс.длина - 1000 символов</p></small>
					<textarea class="textarea"  name="description" cols="20" rows="4"></textarea>
					<small><span style="color:red"><?=$error_description?></span></small>
			</div>
			<div class="petition_maker" style="min-height:330px;">
				<p>Выберите тему петиции</p>
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
				<p>Кому посвещяется петиция</p>
				<small><p style="color:grey;">это поле заполнять необязательно</p></small>
				<small><p style="color:red"><?=$error_people?></p></small>
				<input style="width:300px; right:10px;" type="text" class="textarea" name="name_people" placeholder="Введите имя человека">
				<input style="width:300px;" type="text" class="textarea" name="surname" placeholder="Введите фамилию человека">
			</div>
			<div class="petition_maker">
				<p>Сколько людей должны её подписать</p>
				<small><p style="color:red"><?=$error_quantity?></p></small>
				<input type="text" name="quantity" class="textarea">
			</div>
			<div id="done">
				<input type="submit" name="done" id="done_button">
			</div>
		</form>
	</div>
</body>
</html>
