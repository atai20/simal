<?php
require('another_page.php');
$sql = R::findAll("users", 'ORDER BY `invested_money`') or die('database error1');
echo '<table class="table table-dark">
  <thead>
    <tr>
    <th scope="col">place</th>
      <th scope="col">login</th>
      <th scope="col">all invested money</th>
    </tr>
  </thead>';
$top_users[] = null;
$sql_best_comp =  R::findAll('tbl_product_detail', 'ORDER BY `donated_money`') or die('database error2');
foreach ($sql as $result) {
    $invested_money = 0;
    $top_user = $result["login"];
    $sql_best_comp = R::find('tbl_product_detail', '`investor_name` = ?', array($result["login"]));
    foreach  ($sql_best_comp as $result_comp) {
        $invested_money = $invested_money + $result_comp['donated_money'];
    }
    array_push($top_users, $invested_money);
}

sort($top_users);
$user_counter[] = null;
foreach ($top_users as &$value) {
    if($value == ''){
        $value = 0;
    }
    foreach ($sql_users as $result_2) {
        $invested_money_2 = 0;
        $top_user = $result_2["login"];
        $sql_best_user = R::find('tbl_product_detail',"`investor_name` = ?", array($top_user));
        foreach ($sql_best_user as $result_best_user) {
            $invested_money_2 = $invested_money_2 + $result_best_user['donated_money'];
        }
        if($invested_money_2 == $value){
            array_push($user_counter, $top_user);
        }
    }

}
$user_ravn = array_unique($user_counter);
$i = 0;
krsort($user_ravn);
$i_rev = count($user_ravn)-1;
foreach ($user_ravn as &$value) {
    if($value!="") {
        $sql_avatar = R::find('users', "`login`=?", array($value)) or die('database error5');
        foreach ($sql_avatar as $result_avatar) {
            if($result_avatar['avatar']=='none'){
                $avatar = 'users/defaults/avatar.png';
            }else{
                $avatar = $result_avatar['avatar'];
            }
        }
        $i2 = $i+1;
        echo"<tbody>
<thead>
    <tr>
    <td scope=\"row\">$i2</td>
      <td><a href=\"?page=account&user=$value\"><img style='width:30px'src='users/files/$avatar'>$value</img></td>
      <td>" . $top_users[$i_rev] . "</td>
    </tr>
    <thead>
  </tbody>";
    }
    $i_rev--;
    $i++;

}
echo '</table>';