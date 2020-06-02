<?php
require('another_page.php');
if(isset($_POST['submit'])) {
    $password = $_POST['password'];
    $email = $_SESSION['email_f'];
    if (mb_strlen($password) < 5 || mb_strlen($password) > 30) {
        echo 'invalid password';
    } elseif ($password != $_POST['conf_password']) {
        echo 'passwords do not match';
    } else {
        if($result = R::findOne('users', '`email` = ?', array($email))){
                if(!password_verify($password, $result['password'])){
                    $username_1 = $result['login'];
                    $hash_pass = password_hash($password, PASSWORD_DEFAULT);
                    var_dump($hash_pass);
                    R::exec("UPDATE `users` SET `password`=? WHERE `login`= ?", array($hash_pass, $username_1));
                    header('Location: ?page=login');
                }else{
                    echo 'you already used this password';
                }


        }else{
            echo 'database error';
        }


    }
}
?>
<form method="post">
    <input type="password" name="password">
    <input type="password" name="conf_password">
    <input type="submit" name="submit">

</form>
