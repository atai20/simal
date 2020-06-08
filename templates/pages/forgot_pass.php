<?php
require('another_page.php');
if (isset($_POST['submit'])){
    $email = $_POST['email'];
    if($sql = R::find('users', "`email` = ?", array($email))) {

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
        $padding = '12px';
        $width = '100%';
        $error = "this account doesn`t exist if you havent it<br>
<a href=\"?page=register\">register</a><br>";
    }
}
?>
<div id="login">
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" style='background:white; border:none;border-radius:4px;-webkit-box-shadow: 0px 3px 3px -1px rgba(135,135,135,1);
-moz-box-shadow: 0px 3px 3px -1px rgba(135,135,135,1);
box-shadow: 0px 3px 3px -1px rgba(135,135,135,1);padding-bottom:0;'class="col-md-12">
                    <form id="login-form" class="form" action="" method="post">
                        <h3 class="text-center text-info">Enter email</h3>
                        <div class="form-group">
                            <input type="text" placeholder="your account email"name="email" id="username" class="form-control">
                        </div>
                        <input type="submit" name="submit" class="btn btn-info btn-md">
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
