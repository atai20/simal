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
	$error = 'this is the wrong code';
	$padding = '12px';
	$width = '100%';
}
}
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="../assets/css/index_styles.css" rel="stylesheet">
<!------ Include the above in your HEAD tag ---------->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<?php
echo"<div id=\"login\">
    <div class=\"container\">
        <div id=\"login-row\" class=\"row justify-content-center align-items-center\">
            <div id=\"login-column\" class=\"col-md-6\">
                <div id=\"login-box\" style='background:white; border:none;border-radius:4px;-webkit-box-shadow: 0px 3px 3px -1px rgba(135,135,135,1);
-moz-box-shadow: 0px 3px 3px -1px rgba(135,135,135,1);
box-shadow: 0px 3px 3px -1px rgba(135,135,135,1);padding-bottom:0;'class=\"col-md-12\">
                    <form id=\"login-form\" class=\"form\" action=\"\" method=\"post\">
                        <h3 class=\"text-center text-info\">Enter code</h3>
                        <div class=\"form-group\">
                            <input type=\"text\" placeholder=\"code\"name=\"code\" id=\"username\" class=\"form-control\">
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
