<?php
//старт сессии
session_start();
//если ты не зарегестрировался
		if ($_SESSION["username"] == "") {
			//перенаправление на страницу входа
			header("Location:login.php");
		}
//подключение шапки
		include "header.php";
//подключение базы данных
		$con = mysqli_connect('localhost', 'root', '', 'chatbox');
		mysqli_query($con,"SET NAMES 'utf8'");
		$user_id = $_SESSION["ide"]; // user_id = id пользователя
		$chat_id = $_GET["id"]; // cnat_id = id чата
		$chat = mysqli_query($con,"SELECT * FROM `chat` WHERE `id` = '$chat_id'"); //выбираем всё  в таблице chat где id чата равно $chat_id
		$name_chat = mysqli_fetch_array($chat); //записываем в переменную $name_chat массив переменной $chat
		$_SESSION["chat"] = true; 
		$_SESSION["chat_id"] = $_GET["id"]; //добавляем значение сессии
		$ch = mysqli_query($con, "SELECT * FROM `user_chat` WHERE `userid` = '$user_id'  AND `chatid` = '$chat_id'");//выбираем всё  в таблице user_chat где id чата равно $chat_id и где id пользователя равно $user_id
		$count = mysqli_fetch_array($ch); //записываем в переменную $count массив переменной $ch
		if ($_SESSION["chat"] == true && $count["userid"] == "") { //если человек находится в чате и если он не записан в базу данных
			mysqli_query($con,"INSERT INTO `user_chat` (`userid`,`chatid`) VALUES ('$user_id','$chat_id')"); // его записывают в базу данных
		}
		$co = mysqli_query($con, "SELECT * FROM `user_chat` WHERE `chatid` = '$chat_id'"); // выбираем всё в user_chat где id чата равно $chat_id
		while ($unt = mysqli_fetch_array($co)) { //пока к переменной unt присваиваится переменная $co  
			$a++; //колличество пользователей увеличивается на один
		}
?>
<html>
<head>
<title>Чатик</title> <!-- название страницы -->
<link rel="stylesheet" href="styles_for_chat.css" type="text/css">
<script
  src="http://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>

<script>

function submitChat() {
	if(form1.msg.value == '') {
		alert("Enter your message!!!");
		return;
	}
	var msg = form1.msg.value;
	var xmlhttp = new XMLHttpRequest();
	var message = document.createElement('div');
	xmlhttp.onreadystatechange = function() {
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById('chatlogs').innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.open('GET','insert.php?msg='+msg,true);
	xmlhttp.send();
	//выводит текст сообщения на экран
	
	form1.msg.value = '';
}

$(document).ready(function(e){
	$.ajaxSetup({
		cache: false
	});
	setInterval( function(){ $('#chatlogs').load('logs.php'); }, 2000 );
});

</script>

</head>
<body>

	<div class="center">
		<div class="border">
			<div class="menu_chat">
				<span class="text"><?=$name_chat["name"] //имя чата?></span>
				<p style="font-size:1em; top:0;" class="text">колличество пользователей - <?=$a?></p>
			</div>
			<form name="form1"onsubmit="return false">
				<div id="chatlogs">
				</div>
				<div class="send">
					<textarea name="msg"></textarea>
					<button onclick="submitChat()">отправить</button>
					<div class="fix" style="">
					</div>
				</div>
			</form>
		</div>
	</div>
</body>