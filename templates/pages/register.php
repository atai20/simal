<?php
require('another_page.php');
$username = filter_var(trim($_POST["username"]), FILTER_SANITIZE_STRING);
$password = filter_var(trim($_POST["password"]), FILTER_SANITIZE_STRING);
$password_confirm = filter_var(trim($_POST["password_confirm"]), FILTER_SANITIZE_STRING);
$email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_STRING);
if (isset($_POST["submit"])){
    $width = '100%';
    $padding = '12px';
if (mb_strlen($username) < 1 || mb_strlen($username) > 90){
    $error = 'invalid username length';
}
elseif (mb_strlen($password) < 10){
    $error = 'invalid password length: password must be bigger than 10 symbols';
}elseif (!preg_match('/[A-z]+/', $password)) {
    $error ="no letters on password";
}elseif (!preg_match('/[0-9]+/', $password))
{
    $error ="no figures on password";
}elseif (!preg_match('/[A-Z]+/', $password))
{
    $error ="no capital letters on password";
}elseif (!preg_match('/[a-z]+/', $password))
{
    $error ="no lowercase letters on password";
}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = 'invalid email';
}
elseif ($password!=$password_confirm) {
    $error = 'passwords do not match';
}elseif(R::find('users', '`login` = ? OR `email` = ?', array($username, $email))){
    $error = 'account with this email or password already exist';

}
else{
    $width = '0';
    $padding = '0';
$rand = bin2hex(random_bytes(4));
$to = "ataikyd2005@gmail.com";
$subject = "Email code";
$message = "Hello, that is your code: ".$rand;
$headers = "Content-type:text/html; charset = windows-1251 \r\n";
$headers .= "From: ataikyd2005@gmail.com";
$headers .= "Reply to ataikyd2005@gmail.com";
mail($to, $subject, $message, $headers);
$hash_pass = password_hash($password, PASSWORD_DEFAULT);
var_dump($hash_pass);
$_SESSION["login1"] = filter_var(trim($username), FILTER_SANITIZE_STRING);
$_SESSION["password"] = filter_var(trim($hash_pass), FILTER_SANITIZE_STRING);
$_SESSION["email"] = filter_var(trim($email), FILTER_SANITIZE_STRING);
$_SESSION["random"] = filter_var(trim(strval($rand)), FILTER_SANITIZE_STRING);
header('Location: ?page=register_email');
}
}
?>
<body>
<div id="login">
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" style='background:white; border:none;border-radius:4px;-webkit-box-shadow: 0px 3px 3px -1px rgba(135,135,135,1);
-moz-box-shadow: 0px 3px 3px -1px rgba(135,135,135,1);
box-shadow: 0px 3px 3px -1px rgba(135,135,135,1);'class="col-md-12">
                    <form id="login-form" class="form" action="" method="post">
                        <h3 class="text-center text-info">Sign up</h3>
                        <div class="form-group">
                            <input type="text" placeholder="username"name="username" id="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" name="email" placeholder="email"id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="password"name="password" id="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="password" placeholder="confirm password"name="password_confirm" id="password_confirm" class="form-control">
                        </div>
                        <div class="form-group"><label for="remember-me" class="text-info"></label><br><input type="submit" name="submit" class="btn btn-info btn-md" value="sign up">
                        </div><div id="register-link" style='margin-top:-75px;'class="text-right">
                            <a href="?page=login" class="text-info">Sign in here</a>
                            <br>
                            <a href="?page=forgot_pass" class="text-info">forgot the password</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div style = "max-width:510px;  width:<?=$width?>;padding:<?=$padding?>; margin:auto;margin-top:20px;margin-bottom:20px;"class="alert alert-danger" role="alert">
<?=$error?>
</div>
</body>
<style>
</style>

