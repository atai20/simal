<?php
require('another_page.php');
if (isset($_POST['submit'])){
    $email = $_POST['email'];
    if($sql = R::find('users', "`email` = ?", array($email))) {

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $rand = bin2hex(random_bytes(4));
            $to = $email;
            $subject = "code for changing password";
            $message = "Hello, that is your code: " . $rand;
            $headers = "Content-type:text/html; charset = windows-1251 \r\n";
            $headers .= "From: ataikyd2005@gmail.com";
            $headers .= "Reply to " . $email;
            mail($to, $subject, $message, $headers);
            $_SESSION['email_code'] = $rand;
            $_SESSION['email_f'] = $email;
            header('Location: ?page=forgot_email');
        } else {
            echo 'write real email<br>';
        }
    } else {
        echo 'this account doesn`t exist if you havent it<br>
<a href="?page=register">register</a><br>';
    }
}
?>
enter your email
<form method="post">
    <input name="email">
    <input type="submit"name="submit">
</form>
