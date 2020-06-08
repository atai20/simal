<?php
require('another_page.php');
if(isset($_POST['code'])) {
    if ($_SESSION['email_code'] == $_POST['code']) {
        header('Location: ?page=new_pass');
    }else{
        $width = "100%";
        $padding = "12px";
        $error = 'wrong code';
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
                        <h3 class="text-center text-info">Enter code</h3>
                        <div class="form-group">
                            <input type='code'name="code"placeholder="code that was sent to your mail" class="form-control">
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
