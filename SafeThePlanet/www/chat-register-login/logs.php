<?php
//старт сессии
session_start();
//подключение базы данных
$con = mysql_connect('localhost','root','');
mysql_select_db('chatbox', $con);
$chatid = $_SESSION['chat_id'];
$result1 = mysql_query("SELECT * FROM `logs` WHERE `chatid` = '$chatid'");
//отправление сообщение
while($extract = mysql_fetch_array($result1)) {
	echo "
			<p style='margin:0px 5px 2px 5px;'>" . $extract['username'] . "</p>
			<img src='default_user.png' style='margin:10px 10px 0px 5px; width:30px; border-radius:20px;'><div class='block_messages'> " . $extract['msg'] . " </div>
		";
}
