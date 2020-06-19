<?php

session_start();

if(!isset($_SESSION['username'])) {
?>

<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Login</h2>
  </div>
	 
  <form method="post" action="login.php">

  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" name="submit" class="btn">Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="register.php">Sign up</a>
  	</p>
  </form>
</body>
</html>













<?php
exit;
}

?>
<style>
button{
  padding: 10px;
  font-size: 15px;
  color: white;
  background: #5F9EA0;
  border: none;
  border-radius: 5px;
  
  position: fixed; bottom: 20px;border-radius:5px;height:50px;margin-left:1100px;margin-bottom:11px
}
textarea{

position: fixed; bottom: 20px;border-radius:5px;width:500px;padding:4px; 
font-size:1.1em; 
height:60px;
margin-bottom:7px;
width:400px;

margin-left:3px;
outline:none; 
margin-top:20px; 
resize: none; 
border-radius:6px; 
	margin-left:33%;
	
}
#chatlogs{
	margin-left:40%;
	margin-bottom:200px;
	
}



</style>
<html>
<head>
<title>Chat Box</title>

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
<form name="form1"onsubmit="return false">
Your Chatname: <b><?php echo $_SESSION['username']; ?></b> <br />
<br />




<br />
<textarea name="msg"></textarea><br />

<button onclick="submitChat()">Send</button><br /><br />

<a href="logout.php">Logout</a><br /><br />

</form>
<div id="chatlogs">
LOADING CHATLOG...
</div>

</body>