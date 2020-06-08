<?php
require('another_page.php');
echo '
<div style="margin:auto; max-width:1000px">
<table class="table table-light table-bordered"style="margin-top:40px;">
  <thead style="background:#28B9C2;color:white;">
    <tr >
    <th scope="col"style="border-top:none;width:40px">place</th>
      <th scope="col"style="border-top:none;">login</th>
      <th scope="col"style="border-top:none;">all invested money</th>
    </tr>
  </thead>';
$user_ravn = array_unique($user_counter);
krsort($user_ravn);
$i_rev = count($user_ravn)-1;
$i = 0;
foreach ($user_ravn as &$value) {
    if($value!="") {
        $result_avatar = R::findOne('users', "`login`=?", array($value));
            if($result_avatar['avatar']=='none'){
                $avatar = 'users/defaults/avatar.png';
            }else{
                $avatar = $result_avatar['avatar'];
            }

        $i2 = $i+1;
        $task = "";
        $f_place = "";
        if($value == $username){
            $task = 'background:#e0e0e0;';
        }
        if($i2 == 1){
            $f_place = '<img style="width:30px;" src="assets/img/medal.svg">';
        }
        ?><tbody>
<thead style="<?=$task?>">
    <tr>
    <td scope="row"><?=$i2?><?=$f_place?></td>
      <td>
          <a href="?page=account&user=<?=$value?>">
          <div class="container">
              <div class="row">
                    <div class="col"><div style='width:30px;height:30px;border-radius:100%;background-image:url("users/files/<?=$avatar?>");background-size:cover;margin:auto'></div></div>
                    <div class="col-9"><?=$value?></div>
              </div>
          </div>
          </a>
      </td>
      <td><?=$top_users[$i_rev]?></td>
    </tr>
    <thead>
  </tbody>
        <?php
    }
    $i_rev--;
    $i++;
    if($i>=30){
        exit();
    }

}
echo '</table></div>';