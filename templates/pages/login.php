<?php
require('another_page.php');
if (isset($_POST["submit"])) {

$username = filter_var(trim($_POST["username"]), FILTER_SANITIZE_STRING);
$password = $_POST["password"];
$result = R::findOne('users', "login=?", array($username));

$bool_ver = password_verify($password, $result['password']);
    if(!$result==True or !$bool_ver==True){
        $width = '100%';
        $padding = '12px';
        $error = 'this account doesn`t exist or invalid password';
}else{
        $_SESSION["login"] = $username;
        header('Location: ?page=companies');
}
}
echo "
    <div id=\"login\">
        <div class=\"container\">
            <div id=\"login-row\" class=\"row justify-content-center align-items-center\">
                <div id=\"login-column\" class=\"col-md-6\">
                    <div id=\"login-box\" style='background:white; border:none;border-radius:4px;-webkit-box-shadow: 0px 3px 3px -1px rgba(135,135,135,1);
-moz-box-shadow: 0px 3px 3px -1px rgba(135,135,135,1);
box-shadow: 0px 3px 3px -1px rgba(135,135,135,1);'class=\"col-md-12\">
                        <form id=\"login-form\" class=\"form\" action=\"\" method=\"post\">
                            <h3 class=\"text-center text-info\">Sign in</h3>
                            <div class=\"form-group\">
                                <input type=\"text\" placeholder=\"username\"name=\"username\" id=\"username\" class=\"form-control\">
                            </div>
                            <div class=\"form-group\">
                                <input type=\"password\" placeholder=\"password\"name=\"password\" id=\"password\" class=\"form-control\">
                            </div>
                            <div class=\"form-group\"><label for=\"remember-me\" class=\"text-info\"></label><br><input type=\"submit\" name=\"submit\" class=\"btn btn-info btn-md\" value=\"sign in\">
                            </div><div id=\"register-link\" style='margin-top:-75px;'class=\"text-right\">
                                <a href=\"?page=register\" class=\"text-info\">Sign up here</a>
                                <br>
                                <a href=\"?page=forgot_pass\" class=\"text-info\">forgot the password</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style = \"max-width:510px;  width:$width;padding:$padding; margin:auto;margin-top:20px;\"class=\"alert alert-danger\" role=\"alert\">
    $error
</div>
";
?>