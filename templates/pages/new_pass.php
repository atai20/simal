<?php
require('another_page.php');
if(isset($_POST['submit'])) {
    $padding = '12px';
    $width = '100%';
    $password = $_POST['password'];
    $email = $_SESSION['email_f'];
    if (mb_strlen($password) < 10) {
        $error ='invalid password';
    } elseif ($password != $_POST['conf_password']) {
        $error ='passwords do not match';
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
} else {
        if($result = R::findOne('users', '`email` = ?', array($email))){
                if(!password_verify($password, $result['password'])){
                    $padding = '0';
                    $width = '0';
                    $username_1 = $result['login'];
                    $hash_pass = password_hash($password, PASSWORD_DEFAULT);
                    var_dump($hash_pass);
                    R::exec("UPDATE `users` SET `password`=? WHERE `login`= ?", array($hash_pass, $username_1));
                    header('Location: ?page=login');
                }else{
                    $error = 'you already used this password';
                }


        }else{
            $error = 'user with this email not found';
        }


    }
}
?>
<?php
echo"<div id=\"login\">
    <div class=\"container\">
        <div id=\"login-row\" class=\"row justify-content-center align-items-center\">
            <div id=\"login-column\" class=\"col-md-6\">
                <div id=\"login-box\" style='background:white; border:none;border-radius:4px;-webkit-box-shadow: 0px 3px 3px -1px rgba(135,135,135,1);
-moz-box-shadow: 0px 3px 3px -1px rgba(135,135,135,1);
box-shadow: 0px 3px 3px -1px rgba(135,135,135,1);padding-bottom:0;'class=\"col-md-12\">
                    <form id=\"login-form\" class=\"form\" action=\"\" method=\"post\">
                        <h3 class=\"text-center text-info\">Create new password</h3>
                        <div class=\"form-group\">
                            <input type=\"text\" placeholder=\"password\"name=\"password\" id=\"username\" class=\"form-control\">
                        </div>
                        <div class=\"form-group\">
                            <input type=\"text\" placeholder=\"confirm password\"name=\"conf_password\" id=\"username\" class=\"form-control\">
                        </div>
                        <input type=\"submit\" name=\"submit\" class=\"btn btn-info btn-md\">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div style = \"max-width:510px;  width:$width;padding:$padding; margin:auto;margin-top:20px;margin-bottom:20px;\"class=\"alert alert-danger\" role=\"alert\">
    $error
</div>"
?>
