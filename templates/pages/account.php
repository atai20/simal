<div class="container" style="min-width: 1100px;">
	<div class="row">
<div class="col-3">
<div style="margin: 10px; background: #ffffff; padding: 10px; border-radius: 5px; width: 250px; height: 325px;">
<?php
require('another_page.php');
if($_GET['user']==''){
    header('Location: ?page=error');
}else{
    $username_account = $_GET['user'];
}


if($username == ''){
    header('Location: ?page=login');
}else {
    if ($sql = R::find('users', "`login` = ?", array($username_account))) {
        foreach ($sql as $result) {
            $user_acc = $result['login'];
            if ($result['avatar'] == 'none') {
                $result['avatar'] = 'users/defaults/avatar.png';
            }
            $username_acc = $result['login'];
            $link = "?page=company&user=" . $username_acc;
            echo '<div style="background: url(users/files/' . $result['avatar'] . ') 50% 50%; height: 230px; background-size: cover;"> </div>';
            if ($result['company_name'] != 'none') {
                echo '
    ' . $username_acc . ', company: <a href=' . $link . '>' . $result['company_name'] . '</a>';
            }
            	echo "<p class='text-center' style='font-size: 1.1em;margin: 5px;'>".$user_acc."</p>";

        }


    $sql_invest = R::findAll('tbl_product_detail') or die('database problem');
    if ($username == $user_acc) {
        echo '<button class="btn btn-primary btn-block"><a href="?page=create_avatar" style="color: #fff; text-decoration: none;">Change avatar</a></button>';
        echo "</div>";
        echo "</div>";
    }
    echo '<div class="col-8" style="margin: 10px; background: #ffffff; padding: 10px; border-radius: 5px; width: 250px; height: 100%;">
    <p style="margin-left: 15px; margin-top: 5px; font-size: 1.1em;">My help</p>
				<hr>';
	$i = 0;
    foreach ($sql_invest as $result) {
        if ($username_account == $result["investor_name"]) {
            $investor_name = $result["investor_name"];
            echo '<div class="jumbotron" style="padding: 2rem 1rem;">
            <h3>You sent the company "'. $result["comp_name"] .'"' . $result["donated_money"] .'.</h3>
            <hr>
            <button class="btn btn-dark"><a href="?page=company&user='.$result['corp_name_user'].'">go to page</a></button>
      <p class="text-right text-muted">' . $result["date"] . '</p>
  </div>';
 	$i++;		
        }
    }
    if ($i == 0) {
    	echo "<h3 class='text-center text-muted'>No donations.</h3>";
    }
    echo "</div>";
    echo "</div>";
    echo "</div>";
    } else {
        echo "'account is'nt exist or deleted";
    }
}
