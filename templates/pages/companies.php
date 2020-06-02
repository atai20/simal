<?php
require('another_page.php');
$sql_famous = R::findAll('users', 'ORDER BY `views` DESC LIMIT 6') or die('database problem');
$sql_date = R::findAll('users', 'ORDER BY `date` LIMIT 6') or die('database problem');

function foreach_comp($sql, $name){
echo '
<h2 style="margin:auto;width:300px;margin-top:30px">'.$name.'</h2>';
echo'
<div class="container">
  <div class="row">';
foreach ($sql as $result) {
if ($result['company_name']!='none') {
if ($result["company_img"] != "none") {
    true;
} else {
    $result["company_img"] = "users/defaults/image.jpg";
}
if ($result["avatar"] == "none") {
    $result["avatar"] = "users/defaults/avatar.png";
}
$avatar = $result["avatar"];
$user_company =  $result["login"];
?>
<div class="col-sm">
    <div class="card"style="max-width:27rem">
        <div class="card-img-top"style="color:white;background:url('users/files/<?=$result["company_img"]?>');height:200px;background-size:cover">

        </div>
        <div class="card-body">

            <div style='width:30px;height:30px;position:absolute;border-radius:100%;background:url("users/files/<?=$avatar?>");background-size:cover;'></div>
            <?php
            echo'
    <a href="?page=account&user='.$user_company.'"style="margin-left:40px;margin-top:5px;">' . $user_company . '</a>
    <h3 class="card-title"style="margin-top:10px">' . $result["company_name"] . '</h3>
    <p class="card-text"><b>'.$result["problem"].'</b></p>
    <p class="card-text">' . $result["little_desc"] . '</p>';
            if ($result["futur_money"] != 0 and $result["money"] != 0) {
                $zagruzk = $result["futur_money"] / 100;
                $progress = round($result["money"] / $zagruzk);
                echo '
      <div class="progress"style="margin-bottom:20px;">
 
   <div class="progress-bar"
      role="progressbar"
      aria-valuenow="' . $result["money"] . '"
      aria-valuemin="0" aria-valuemax="' . $result["futur_money"] . '"
      style="width:' . $progress . '%">
      ' . $progress . '%
   </div>
 
</div>';
            } else {
                echo 'no progress<br>';
            }
            echo '
      <a style="float:right;"href="?page=company&user=' . $result["login"] . '" class="btn btn-success">Read more</a>
    </div>
</div>
</div>
';
            }
            }
            echo '
</div>
</div>';
}
foreach_comp($sql_date, 'NEWEST');
foreach_comp($sql_users, 'MOST FAMOUS');


?>

