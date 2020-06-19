<?php
$_SESSION["chat"] = false;
include "session.php"; //поключение файла чтобы удалить пользователя из базы чата
//подключение базы данных
$mysqli = new mysqli ("localhost","root","","chatbox");
$mysqli->query ("SET NAMES'utf8'");
//подключение шапки сайта
include"header.php";
?>
<?php
//система поиска
$s = "Найти петицию";
$petitions = $mysqli -> query ("SELECT * FROM  `petitions`");//выбрать в базе данных petitions все значения
$_SESSION["search"] = $_POST["search"];//передаём в сессию значение поискогово запроса
$search = $_SESSION["search"];// упрощаем переменную
if (isset($_POST["done_search"])) {//проверка на нажатие кнопки
if (strlen($search) == 0) {//если длина поискового запроса = 0 то выводится все петиции
	$s = "Найти петицию";
	$petitions = $mysqli -> query ("SELECT * FROM  `petitions` ");
}
if (strlen($search) > 1) {//если длина поискового запроса > 0 то выводится те петиции у которых имя равно поискогому запросу
	$s = "Сбросить";
	$petitions = $mysqli -> query ("SELECT * FROM  `petitions` WHERE `name` = '$search' ");
}
}
?>
<!DOCKTYPE html>
<html lang="en">
<head>
<link href="https://fonts.googleapis.com/css?family=Alfa+Slab+One|Roboto|Russo+One" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Scada:700" rel="stylesheet">
<meta HTTP-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="description" content="Этот сайт нужен чтобы предлагать петиции против мировых проблем"/>
<meta name="keywords"  content="петиции, Safe the planet, планета, " />
<link href="styles_for_index.css" rel="stylesheet" type="text/css"/>
<title> Safe the planet | Общими силами мы сможем изменить мир! </title>
</head>
<body>

		<div id="zagalovok">
			<div id="lozyng">
				<h1>Общими силами мы сможем изменить мир!</h1>
			</div>
		<div style="height=10px">
			<div id="search">
				<form action="" method="post">
					<input id="poisk" type="search" name="search" placeholder="Найдите петиции...">
					<input id="done" type="submit" name="done_search" value="<?=$s?>">
				</form>
			</div>
		</div>
		</div>
		<div class="center">
		<?php
		//вывод чатов
		$a = 0;
		while (($row = $petitions->fetch_assoc()) == true) {//пока присваивание массивов с информацией петиции элементу происходит успешно то выводятся петиции с этой информацией 
		$id = $row["id"];
		$name_people = $row["people"];
		$name = $row["name"];
		$u = $row ["description"];
		$theme = $row ["theme"];
		echo "<a href='petition.php?id=$id'><div class='body'>
			<div style='max-width:30%'>
				<span>Название петиции: </span>
				<span>$name</span>
			</div>
			<div style='max-width:30%'>
				<span>имя пользователя: </span>
				<span>$name_people</span>
			</div>
			<div>
				<span>тема: </span>
				<span>$theme</span>
			</div>
			<div style=' width:auto; border:none'>
				
				
				<span> описание: </span>
				<span>$u</span>
			</div>
			</div></a>";
			$a++;
	 }
	 if ($a == 0 && isset($_POST["done_search"]) == true && strlen($_POST["search"]) > 0) {
		 echo "<span style='color:#333; font-size:1.2em; margin:2px;'>По результатом поиска ничего не найдено.</span>";
	 }
		?>
		</div>
</body>
</html>