<?php
require('another_page.php');
$username = filter_var(trim($_POST["username"]), FILTER_SANITIZE_STRING);
$password = filter_var(trim($_POST["password"]), FILTER_SANITIZE_STRING);
$password_confirm = filter_var(trim($_POST["password_confirm"]), FILTER_SANITIZE_STRING);
$email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_STRING);
if (isset($_POST["submit"])){
if (mb_strlen($username) < 1 || mb_strlen($username) > 90){
    echo '<div style = "max-width:510px; width:100%; margin:auto;margin-top:20px;"class="alert alert-danger" role="alert">
    invalid username length
</div>';
    exit();
}
elseif (mb_strlen($password) < 5 || mb_strlen($password) > 30){
    echo '<div style = "max-width:510px; width:100%; margin:auto;margin-top:20px;"class="alert alert-danger" role="alert">
    invalid password length
</div>';
    exit();
}
elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo '<div style = "max-width:510px; width:100%; margin:auto;margin-top:20px;"class="alert alert-danger" role="alert">
    invalid email
</div>';
    exit();
}
elseif ($password!=$password_confirm) {
    echo '<div style = "max-width:510px; width:100%; margin:auto;margin-top:20px;"class="alert alert-danger" role="alert">
    passwords do not match
</div>';
    exit();
}elseif(R::find('users', '`login` = ? OR `email` = ?', array($username, $email))){
    echo '<div style = "max-width:510px; width:100%; margin:auto;margin-top:20px;"class="alert alert-danger" role="alert">
    this account already exist
</div>';
}
else{
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
                <div id="login-box" class="col-md-12">
                    <form id="login-form" class="form" action="" method="post">
                        <h3 class="text-center text-info">Register</h3>
                        <div class="form-group">
                            <label for="username" class="text-info">Username:</label><br>
                            <input type="text" name="username" id="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email" class="text-info">Email:</label><br>
                            <input type="text" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-info">Password:</label><br>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-info">Confirm password:</label><br>
                            <input type="password" name="password_confirm" id="password_confirm" class="form-control">
                        </div>
                        <div class="form-group"><label for="remember-me" class="text-info"></label><br><input type="submit" name="submit" class="btn btn-info btn-md" value="register">
                        </div><div id="register-link" class="text-right">
                            <a href="?page=login" class="text-info">Login here</a>
                            <br>
                            <a href="?page=forgot_pass" class="text-info">forgot the password</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<style>
    body {
        margin: 0;
        padding: 0;
        background-color: #17a2b8;
        height: 100vh;
    }
</style>

