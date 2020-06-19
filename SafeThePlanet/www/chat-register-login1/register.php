<?php

if(isset($_POST['submit'])) {

	$con = mysql_connect('localhost', 'root', '');
	mysql_select_db('chatbox', $con);
	
	$uname = $_POST['username'];
	$pword = $_POST['password'];
	$pword2 = $_POST['password2'];
	
	if($pword != $pword2) {
		echo "Passwords do not match. <br>";
	}
	else {
		$checkexist = mysql_query("SELECT username FROM users WHERE username = '$uname'");
		if(mysql_num_rows($checkexist)){
			echo "Username already exists, Please select other username.<br>";
		}
		else {
			mysql_query("INSERT INTO users (`username`,`password`) VALUES('$uname','$pword')" );
			
			echo "You are now registered. Click <a href='index.php'>here</a> to start chatting";
		}
		
	}

}

?>

<html>













<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form method="post" action="register.php">
  
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username">
  	</div>

  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password2">
  	</div>
  	<div class="input-group">
  	  <button input type="submit" name="submit" class="btn" >Register</button>
  	</div>
  	<p>
  		Already a member? <a href="index.php">Sign in</a>
  	</p>
  </form>
</body>
</html>








<head>

<title></title>

</head>

<body>


<body>
</html>