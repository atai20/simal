<style type="text/css">
  body {
    background: #f7f7f7;
  }
</style>
<?php
require('another_page.php');
$sql_famous = R::find('users', 'ORDER BY `views`DESC LIMIT 9') or die('database problem');
function foreach_comp($sql, $name){
echo '
<h2 align="center"style="margin-top:30px;color:grey">'.$name.'</h2>';
echo'
<div class="container">
  <div class="row justify-content-center">';
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
<div class="col-4" style="max-width: 500px; width: 500px;">
    <div class="card"style="width: 350px;">
        <div class="card-img-top"style="color:white;background:url('users/files/<?=$result["company_img"]?>');height:200px;background-size:cover;border-bottom:1px solid #D0D0D0;">

        </div>
        <div class="card-body">

            <div style='width:30px;height:30px;position:absolute;border-radius:100%;background:url("users/files/<?=$avatar?>");background-size:cover;'></div>
            <?php
            echo'
    <a href="?page=account&user='.$user_company.'"style="margin-left:40px;margin-top:5px;">' . $user_company . '</a>
    <div class="row center-block" style="padding-left: 1.25rem; margin-top: 8px;">
   <div class="col-7" style="padding: 0">
    <span style="font-size: 1.5em;">' . $result["company_name"] . '</span>
    </div>
    <div class="col-4 right-block" style="padding: 0; margin-top: 12px;">
    <div class="row justify-content-center" style="padding: 0;">
      <p class="card-text badge text-center bg-info" style="color: #fff; font-size: 0.9em; text-align: center; display: block;">' . $result["problem"] . '</p>
      </div>
  </div>
  </div>
    <p class="card-text text-muted font-weight-light" style="font-size: 1.2em; margin: 10px 10px 25px 0px; font-family: Segoe UI;">' . $result["little_desc"] . '</p>';
            $zagruzk = $result["futur_money"] / 100;
            $progress = round($result["money"] / $zagruzk);
            if ($progress >= 50) {
              $color = "#fff";
            } 
            else {
              $color = "#000";
            }
                echo '
      <div class="progress"style="margin-bottom:20px;">
 
   <div class="progress-bar"
      role="progressbar"
      aria-valuenow="' . $result["money"] . '"
      aria-valuemin="0" aria-valuemax="' . $result["futur_money"] . '"
      style="width:' . $progress . '%">
      <span style="color: '.$color.'; width: 308px;">' . $progress . '% </span>
   </div>
 
</div>';
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
$best_user_avatar = $sql_best_user['avatar'];
echo '<div align="center"style="font-size:20px;margin-top:40px;">';
if($sql_best_user['login'] != $username){
    echo '<div style=\'width:200px;height:200px;margin:auto;margin-top:20px;border-radius:100%;background:url("users/files/'.$best_user_avatar.'");background-size:cover;\'><img style="width:80px;float:right;margin-top:120px;"src="assets/img/medal.svg"></div>
<b style="font-size:30px;">'.$sql_best_user['login'].'</b>';
}else{
    echo 'you are the best investor! congratulations!';
}
echo '</div>';
foreach_comp($sql_famous, 'most famous');
?>