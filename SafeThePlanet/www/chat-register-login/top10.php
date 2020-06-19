<?php
//подключение шапки
include "header.php";
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="styles_for_top10.css">
	<title>top 10 | Safe the Planet</title>
</head>
<body>

	<div class="content_top">
		<div class="top">
			<div style="width:4%">
				<span>№</span>
			</div>
			<div <div style="width:75%">
				<span>имя пользователя</span>
			</div>
			<div style="float:right; width:20%; border:none">
				<span>колличество петиций</span>
			</div>
		</div>
		<?php
		//подключение таблицы
			include "tabl.php";
		?>
	</div>	
</body>
</html>
