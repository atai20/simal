<?php
//подключение кода шапки
include "new.php";

?>
<head>
	<link href="styles_for_header.css" rel="stylesheet" type="text/css"/>
</head>
<header>
			<a href="index.php" title="на главную">
				<img id="logo_picture" src="logotip.png"/>
			</a>
	<div id="center_header">
		<a href="create_chat.php"><span class="menu"> создать чат </span></a>
		<a href="create_petition.php"><span class="menu"> предложить петицию </span></a>
		<a href="find_chat.php"><span class="menu"> найти чат </span></a>
		<a href="top10.php"><span class="menu"> таблица рейтинга </span></a>
	</div>
	
	<div class="right_header" id="log_in">
		<?=$href_log?>
			<span><?=$log?></span>
		</a>
	</div>
	
	
	<div class="right_header">
		<?=$href_reg?>
			<span><?=$reg?></span>
		</a>
	</div>
	
</header>