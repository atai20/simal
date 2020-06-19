<?php
		//удаление пользователя из чата
		include "session.php";
		//подключение базы данных
	$mysqli = new mysqli ("localhost", "root", "", "chatbox");
	$mysqli->query ("SET NAMES 'utf8'");
	//сортировка пользователей по колличеству сделанных петиций
	$petitions = $mysqli -> query ("SELECT * FROM  `users` ORDER BY `users`.`petition_count` DESC");
	$a = 1;
	//пока есть пользователи и $a = 100 то выводятся пользователи 
	 while (($row = $petitions->fetch_assoc()) == true && $a <= 100) {
		$p = $row["petition_count"];
		$u = $row ["username"];
		echo "<div class='top'>
			<div style='width:4%'>
				<span>$a</span>
			</div>
			<div <div style='width:75%'>
				<span>$u</span>
			</div>
			<div style='float:right; width:20%; border:none'>
				<span>$p</span>
			</div>
		</div>";
		$a++;
	 }
	 if ($a == 1) {
		 echo "пользователей нет";
	 }
?>