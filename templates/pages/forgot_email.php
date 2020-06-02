<?php
require('another_page.php');
if(isset($_POST['code'])) {
    if ($_SESSION['email_code'] == $_POST['code']) {
        header('Location: ?page=new_pass');
    }else{
        echo'wrong code';
    }
}
?>
<form method="post">
    <h1>enter code</h1>
    <input type='code'name="code">
    <input type="submit"name="submit">
</form>
