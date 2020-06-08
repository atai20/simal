<?php
require('another_page.php');
echo'
<div class="container">
  <div class="row justify-content-start">';
if(isset($_POST["submit"])){
$find_word = $_POST['find_word'];
    $query=R::find('users',' company_name LIKE :name ', array(':name' => '%' . $find_word . '%' ));
if($find_word==''){
	echo "Write company name!";
}else {
    $num = R::count('users',' company_name LIKE :name ', array(':name' => '%' . $find_word . '%' ));
    if ($num == 0) {
        echo "<div style='margin:30px'>no results</div>";
    }
    else {

    foreach ($query as $result) {
        $user_company =  $result["login"];
        ?>


        <div class="col-4"style="width:20rem">
        <div class="card"style="max-width:27rem">
        <div class="card-img-top"style="color:white;background:url('users/files/<?=$result["company_img"]?>');height:200px;background-size:cover;border-bottom:1px solid #D0D0D0;">

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
}
}
echo '</div></div>';
?>