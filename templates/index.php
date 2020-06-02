<?php
require('config\config.php');
if (isset($_GET['page'])) {
    $no_error = True;
    switch ($_GET['page']) {
        case "companies":
            require_once('pages\companies.php');
            break;
        case "register":
            require_once('pages\register.php');
            break;
        case "login":
            require_once('pages\login.php');
            break;
        case "account":
            require_once('pages\account.php');
            break;
        case "company":
            require_once('pages\company.php');
            break;
        case "forgot_email":
            require_once('pages\forgot_email.php');
            break;
        case "forgot_pass":
            require_once('pages\forgot_pass.php');
            break;
        case "new_pass":
            require_once('pages\new_pass.php');
            break;
        case "register_email":
            require_once('pages\register_email.php');
            break;
        case "search":
            require_once('pages\search.php');
            break;
        case "top":
            require_once('pages\top.php');
            break;
        case "successed":
            require_once('pages\successed.php');
            break;
        case "notifications":
            require_once('pages\notifications.php');
            break;
        case "create_company":
            require_once('pages\create_company.php');
            break;
        case "create_avatar":
            require_once('pages\create_avatar.php');
            break;
        case "error":
            require_once('errors\error.html');
            break;
        default:
            require_once('pages\companies.php');
    }
}else{
    require_once('pages\companies.php');
}
echo '
<style>
body{
  font-family: \'Josefin Sans\', sans-serif;
  backgroun:white;
}
</style>';