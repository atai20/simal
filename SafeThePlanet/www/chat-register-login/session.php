<?php
//начало сессии
session_start();
//подключение базы данных 
$con = mysqli_connect('localhost', 'root', '', 'chatbox');
		mysqli_query($con,"SET NAMES 'utf8'");
		//сокращение сессии
		$user_id = $_SESSION["ide"];
		$_SESSION["chat"] = false;
		//если пользователя нет в чате то его удаляют из базы данных
		if ($_SESSION["chat"] == false) {
			mysqli_query($con,"DELETE  FROM `user_chat` WHERE `userid` = '$user_id'");
		}
?>