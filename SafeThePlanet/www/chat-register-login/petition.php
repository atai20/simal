<?php
session_start();
		//если человек ввёл пустой id ссылки
		if (empty($_GET["id"])) {
			header ("Location:index.php");  //перенаправление на главную страницу
		}
		//если человек не зарегестрировался
		if ($_SESSION["ide"] == "") {
	header ("Location:login.php"); //перенаправление на страницу регистрации
}
//подключение шапки
include "header.php";
//удаление пользователя из чата
include "session.php";
$_SESSION["chat"] = false;
//подключение базы данных
		$con = mysqli_connect('localhost', 'root', '', 'chatbox');
		mysqli_query($con,"SET NAMES 'utf8'");
		//упрощение переменных
		$userid = $_SESSION["ide"];
		$postid = $_GET["id"];

		$result = mysqli_query($con, "SELECT * FROM `petitions` WHERE `id`='$postid'");
		$row = mysqli_fetch_array($result);
		$theme = $row["theme"];
		$name1 = $row["name"];
		//подставление картинки под тему
		if ($theme == "сырьевая") {
			$img = "oil.jpg";
			$text = "<h2>СЫРЬЕВАЯ ПРОБЛЕМА<br /><br/>одна из серьезных глобальных проблем, связанная с быстрым истощением различных сырьевых запасов (энергетического, минерального сырья, истощением почв, загрязнением атмосферы и водоемов, осушением Земли, исчезновением лесов и растительности).</h2>";
		}
		if ($theme == "освоение космоса") {
			$img = "spac.jpg";
			$text = "<h2>ПРОБЛЕМА ОСВОЕНИЯ КОСМОСА<br /><br/>Глобальной проблемой освоения космоса является наличие в околоземном космическом мусоре и ракетоносителей, угрожающих не только космическим полетам, но и, если они упадут на землю, его обитателям.</h2>";
		}
		if ($theme == "демографическая") {
			$img = "peren.jpg";
			$text = "<h2>ДЕМОГРАФИЧЕСКАЯ ПРОБЛЕМА<br /><br/>проблема роста мирового народонаселения, обострившаяся в середине XX в., одна из важнейших глобальных проблем современности. Мировая демографическая ситуация характеризуется крайней неоднородностью.</h2>";
		}
		if ($theme == "экологическая") {
			$img = "zavod1.jpg";
			$text = "<h2>ЭКОЛОГИЧЕСКАЯ ПРОБЛЕМА<br /><br/>изменение природной среды, ведущее к нарушению структуры<br/>и функционирования природы.</h2>";
		}
		if ($theme == "использование ресурсов Мирового океана") {
			$img = "ktam.jpg";
			$text = "<h2>ИСПОЛЬЗОВАНИЕ РЕСУРСОВ МИРОВОГО ОКЕАНА<br /><br/>В ХХ в. влияние человеческой деятельности на Мировой океан приняло катастрофические масштабы: происходит загрязнение океана нефтью и нефтепродуктами, обыкновенным мусором.</h2>";
		}
		if ($theme == "мира и разоружения") {
			$img = "voin.jpg";
			$text = "<h2>ПРОБЛЕМА МИРА И РАЗОРУЖЕНИЕ<br /><br/>Одной из важнейших проблем за всю историю существования человечества является проблема предотвращения военных катастроф и конфликтов.</h2>";
		}
		if ($theme == "энергетическая") {
			$img = "batar.jpg";
			$text = "<h2>ЭНЕРГЕТИЧЕСКАЯ ПРОБЛЕМА<br /><br/>проблема обеспечения человечества топливом и энергией в настоящее время и в обозримом будущем.</h2>";
		}
		if ($theme == "продовольственная") {
			$img = "ruk1.jpg";
			$text = "<h2>ПРОДОВОЛЬСТВЕННАЯ ПРОБЛЕМА<br /><br/>нарастающая проблема, вызванная различными причинами и постепенно недостатка продуктов питания, которая приводит к недоеданию и голоду среди наименее обеспеченных групп населения планеты.</h2>";
		}
		$description = $row["description"];
		//выбор в таблице подписки пользователя
		$resul = mysqli_query($con, "SELECT * FROM `likes` WHERE `userid`='$userid' AND `postid`= '$postid'");
		$ro = mysqli_fetch_array($resul);
		//если человек не подписывал петицию
	if (isset($_POST['like']) && $ro == "") {
		$n = $row['pet_pos'];
		mysqli_query($con, "INSERT INTO `likes` (`userid`, `postid`) VALUES ('$userid', '$postid')"); //записывание в базы данных значение его нажатия
		$n++;
		mysqli_query($con, "UPDATE `petitions` SET `pet_pos`='$n' WHERE `id`='$postid'"); //увеличение колличества пользователей подписавших петицию на один и записывание это в базу данных
	
	}
?>
<!DOCKTYPE html>

<html>
<style>
body {
	color:#333;
	font-family:"Segoe UI", sans-serif;
}
.pod_pet {
	margin:10px;
	border-radius:3px;
	font-size:1.3em;
	padding:10px;
	text-align:center;
	background:#f1f1f1;
	width:92%;

}
#name {
	border-radius:3px;
	height:100px;
	background:#d7d7d7;
	position:relative;
	top:10px;
	margin:10px;
	color:#333;
	font-size:500%;
	text-align:center;
	font-family:"Segoe UI", sans-serif;
}
#name>span {
	position:relative;
	bottom:15px;
}
#image {
	min-width:1350px;
	width:100%; 
	margin-top:-6px; 
}
.image {
	position:relative;
	width:100%;
}

h2 {
	font-size:1.3em;
	padding:2.6%;
	color:white;
	min-width:300px;
	margin-left:60%;
	height:82.8%;
	background:url(dog.png); 
	position:absolute;
	top:0px;
	left:0;
	width:30%;
}
#description {
	margin:13px;
	color:#333;
	font-size:30px;
}
#like {
	background:#00a2e7;
	color:white;
	border-radius:3px;
	outline:none; 
	border:none;
	margin:10px;
	font-size:1.3em;
	padding:10px;
	text-align:center;
	width:96%;
}
.border {
	min-width: 1350px;
	border-radius:3px;
	margin:10px;
	background:#e7e7e7;
}
.border_button {
	float:right;
	width:500px;
	border-radius:3px;
	margin:10px;
	background:#e7e7e7;
}
.peoples {
	font-size:1.2em;
	text-align:center;
}
</style>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<title><?="петиция: ".$name?></title>
</head>
	<body>
		<div class="image">
			<img id="image" src=<?=$img?> alt="Girl in a jacket">
			<?=$text?>
		</div>
		<div class="border">
			<div id="name"><span><?=$row["name"]?></span></div>
			<div id="description"><span>Описание петиции:</span> <?=$description?></div>
		</div>
		<div class="border_button">
<form action="" method="post">
<?php $userid = $_SESSION["ide"];
		$postid = $_GET["id"];
$results = mysqli_query($con, "SELECT * FROM `likes` WHERE `userid`='$userid' AND `postid`= '$postid'");
$resultat = mysqli_query($con, "SELECT * FROM `petitions` WHERE `id`='$postid'");
$rawe = mysqli_fetch_array($resultat);
 $ros = mysqli_fetch_array($results);
 //вывод колличества подписей
 echo "<div class='peoples'>петицию подписали ".$rawe["pet_pos"]." человек из ".$rawe["peoples_ quantity"]."</div>";
if ($ros == "") { //если ты не подписал петицию
//клопка подписи
	$echo = "<button id='like' name='like'>подписать петицию</button>";
}
else { //если ты подписал петицию
//блок с текстом (будет только у пользователя)
	$echo = "<div class='pod_pet'>петиция подписана</div>";
}
if ($rawe["pet_pos"] >= $rawe["peoples_ quantity"]) { //если петиция достигла числа максимальных подписок
	mysqli_query($con, "UPDATE `petitions` SET `bool`='1' WHERE `id`='$postid'");
	//блок с текстом (будет у всех)
	$echo = "<div class='pod_pet'>петиция подписана</div>";
}
//вывод конопки или блока
echo $echo;
?>
</div>

</form>
</body>
</html>