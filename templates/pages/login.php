<?php
require('another_page.php');
if (isset($_POST["submit"])) {

$username = filter_var(trim($_POST["username"]), FILTER_SANITIZE_STRING);
$password = $_POST["password"];
$result = R::findOne('users', "login=?", array($username)) or die("database error");

$bool_ver = password_verify($password, $result['password']);

if($result==True and $bool_ver==True){
	$_SESSION["login"] = $username;
    header('Location: ?page=companies');
}else{
	die('<div style = "max-width:510px; width:100%; margin:auto;margin-top:20px;"class="alert alert-danger" role="alert">
    error'.$bool_ver.'
</div>');
}
}
echo "<body>
    <div id=\"login\">
        <div class=\"container\">
            <div id=\"login-row\" class=\"row justify-content-center align-items-center\">
                <div id=\"login-column\" class=\"col-md-6\">
                    <div id=\"login-box\" class=\"col-md-12\">
                        <form id=\"login-form\" class=\"form\" action=\"\" method=\"post\">
                            <h3 class=\"text-center text-info\">Login</h3>
                            <div class=\"form-group\">
                                <label for=\"username\" class=\"text-info\">Username:</label><br>
                                <input type=\"text\" name=\"username\" id=\"username\" class=\"form-control\">
                            </div>
                            <div class=\"form-group\">
                                <label for=\"password\" class=\"text-info\">Password:</label><br>
                                <input type=\"password\" name=\"password\" id=\"password\" class=\"form-control\">
                            </div>
                            <div class=\"form-group\"><label for=\"remember-me\" class=\"text-info\"></label><br><input type=\"submit\" name=\"submit\" class=\"btn btn-info btn-md\" value=\"log in\">
                            </div><div id=\"register-link\" class=\"text-right\">
                                <a href=\"?page=register\" class=\"text-info\">Register here</a>
                                <br>
                                <a href=\"?page=forgot_pass\" class=\"text-info\">forgot the password</a>
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
</style>";
?>