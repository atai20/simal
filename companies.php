<?php
require('another_page.php');
$sql = mysqli_query($db, 'SELECT * FROM `users`') or die('database problem');
echo '<div class="container">
  <div class="row">';
while ($result = mysqli_fetch_array($sql)) {
    if ($result['company_name']!='none') {
        if ($result["company_img"] != "none") {
            true;
        } else {
            $result["company_img"] = "defaults/image.jpg";
        }
        if ($result["avatar"] == "none") {
            $result["avatar"] = "defaults/avatar.png";
        }
        $avatar = $result["avatar"];
        $user_company =  $result["login"];
        ?>
<div class="col-sm">
<div class="card"style="max-width:27rem">
  <div class="card-img-top"style="color:white;background:url('files/<?=$result["company_img"]?>');height:200px;background-size:cover">

  </div>
  <div class="card-body">

    <div style='width:30px;height:30px;position:absolute;border-radius:100%;background:url("files/<?=$avatar?>");background-size:cover;'></div>
        <?php
        echo'
    	<a href="?page=account&user='.$user_company.'"style="margin-left:40px;margin-top:5px;">' . $user_company . '</a>
    <div style="margin-top: 10px;">
    <div class="col-9 d-inline-block" style="padding: 0">
    <span style="font-size: 1.5em;">' . $result["company_name"] . '</span>
    </div>
    <div class="col-1 d-inline-block" style="padding: 0">
	    <span class="card-text badge bg-info" style="color: #fff; font-size: 0.9em;">' . $result["problem"] . '</span>
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
      style="width:' . $progress . '%;">
      <span style="color: '.$color.'; width: 288px;">' . $progress . '% </span>
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
?>