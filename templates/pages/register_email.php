<?php
require('another_page.php');
if(isset($_POST["submit"])){
if($_SESSION["random"]==$_POST["code"]){
	$none = 'none';
	$username = $_SESSION["login1"];
	$password = $_SESSION["password"];
	$email = $_SESSION["email"];

	$users=R::dispense('users');
    $users ->login = $username;
    $users ->password = $password;
    $users ->email = $email;
    $users ->company_name = $none;
    $users ->little_desc = $none;
    $users ->company_desc = $none;
    $users ->avatar = $none;
    $users ->company_img = $none;
    $users ->money = 0;
    $users ->futur_money = 0;
    $users ->invested_money = 0;
    $users ->problem = $none;
    $users ->views = 0;
    $users ->date = 0;
    R::store($users);
    $_SESSION['login'] = $username;
	header('Location: ?page=create_avatar');

}else{
	echo "this is the wrong code";
}
}
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="../assets/css/index_styles.css" rel="stylesheet">
<!------ Include the above in your HEAD tag ---------->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<h3>
    ENTER CODE
</h3>
we sent code to your email
<form method="post">
    <input name="code">
    <input type="submit" name='submit'value="submit">
</form>
