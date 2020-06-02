<?php
require('another_page.php');
if(isset($_POST["submit"])){
$find_word = $_POST['find_word'];
    $query=R::find('users',' company_name LIKE :name ', array(':name' => '%' . $find_word . '%' ));
if($find_word==''){
	echo "Write company name!";
}else {
    $num = R::count('users',' company_name LIKE :name ', array(':name' => '%' . $find_word . '%' ));
    if ($num == 0) {
        echo "no results";
    }
    else {
    foreach ($query as $row) {
        echo '<div class="card" style="width: 18rem;">
  <img class="card-img-top" src="files/' . $row["company_img"] . '" alt="Card image cap">
  <div class="card-body">
    <img style="width:50px" src="files/' . $row["avatar"] . '" alt="avatar">
    <h5 >' . $row["login"] . '</h5>
    <h5 class="card-title">' . $row["company_name"] . '</h5>
    <p class="card-text">' . $row["company_desc"] . '</p>';
        if ($row["futur_money"] != 0 and $row["money"] != 0) {
            $zagruzk = $row["futur_money"] / 100;
            $progress = round($row["money"] / $zagruzk);
            echo '
    <progress value="' . $progress . '" max="100"></progress>' . $progress . '%
    <p class="card-text">to realize the company`s ideas you need <b>' . $row["futur_money"] . '$</b></p>';
        }
        echo '
    <a href="?page=company&user=' . $row["login"] . '" class="btn btn-primary">See more</a>
  </div>
</div>
';

    }
}
}
}
?>