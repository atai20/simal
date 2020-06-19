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
$s = "Найти чат";
$petitions = $mysqli -> query ("SELECT * FROM  `chat`");//выбрать в базе данных chat все значения
$_SESSION["search"] = $_POST["search"]; //передаём в сессию значение поискогово запроса
$search = $_SESSION["search"]; // упрощаем переменную
if (isset($_POST["done_search"])) { //проверка на нажатие кнопки
if (strlen($search) == 0) { //если длина поискового запроса = 0 то выводится все чаты
	$s = "Найти чат";
	$petitions = $mysqli -> query ("SELECT * FROM  `chat`"); 
}
if (strlen($search) > 1) { //если длина поискового запроса > 0 то выводится те чаты у которых имя равно поискогому запросу
	$s = "Сбросить";
	$petitions = $mysqli -> query ("SELECT * FROM  `chat` WHERE `name` = '$search' ");
}
}
?>
<html>
<head>
<link href="styles_for_find_chat.css" rel="stylesheet" type="text/css"/>
</head>
<body>
		<div id="zagalovok">
			<div id="lozyng">
			</div>
		<div style="height=10px">
			<div id="search">
				<form action="" method="post">
					<input id="poisk" type="search" name="search" placeholder="Найдите чат...">
					<input id="done" type="submit" name="done_search" value="<?=$s?>">
					<div>
						<img src="plus.png">
						<span>
						<a href="create_chat.php">
						Добавить чат
						</a>
						</span>
					</div>
				</form>
			</div>
		</div>
		</div>
		<div class="center">
		<?php
		//вывод чатов
		while (($row = $petitions->fetch_assoc()) == true) { //пока присваивание массивов с информацией чата элементу происходит успешно то выводятся чаты с этой информацией 
		$id = $row["id"];
		$name_people = $row["user"];
		$name = $row["name"];
		$u = $row ["description"];
		$theme = $row ["theme"];
		echo "<a href='chat.php?id=$id'><div class='body'>
			<div style='max-width:30%'>
				<span>Название чата: </span>
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
			<div style='width:auto; border:none'>
				
				
				<span>описание: </span>
				<span>$u</span>
			</div>
			</div></a>";
	 }
		?>
		</div>
</body>
</html>