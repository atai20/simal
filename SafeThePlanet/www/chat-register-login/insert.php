<?php
//старт сессии
session_start();
$uname = $_SESSION['username'];
$msg = $_REQUEST['msg']; //передача сообщения в переменную $msg
$chatid = $_SESSION['chat_id'];
//подключение базы данных
$con = mysql_connect('localhost','root','');
mysql_select_db('chatbox', $con);
mysql_query ("SET NAMES 'utf8'");

mysql_query("INSERT INTO `logs` (`username`,`chatid`, `msg`) VALUES ('$uname','$chatid', '$msg')"); //записывание сообщения в базу

$result1 = mysql_query("SELECT * FROM `logs` WHERE `chatid` = '$chatid'");
//вывод сообщений 
while($extract = mysql_fetch_array($result1)) {
	echo "
			<p style='margin:5px;'>" . $extract['username'] . "</p> 
			<div class='block_messages'> " . $extract['msg'] . " </div>
		";
}