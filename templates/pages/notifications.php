<?php
require('another_page.php');
if($username ==""){
    header('Location: ?page=login');

}else {
    echo '<div style="margin:auto; max-width:1000px">';
    if ($user_comp = R::find('tbl_product_detail', '`comp_name_user`= ? ORDER BY `id` DESC', array($username))) {
        echo '
<table class="table table-light table-bordered"style="margin-top:40px;">
  <thead style="background:#28B9C2;color:white;">
    <tr>
      <th scope="col">investor</th>
      <th scope="col">donated money</th>
      <th scope="col">currency</th>
      <th scope="col">date</th>
    </tr>
  </thead>';
        foreach ($user_comp as $result) {
            $investor_name = $result["investor_name"];
            R::exec("UPDATE `tbl_product_detail` SET `status`=? WHERE `comp_name_user`= ?", array(1, $username));
            echo '
<thead>
<tbody>
    <tr>
      <td><a href="?page=account&user=' . $investor_name . '">' . $investor_name . '</a></td>
      <td>' . $result["donated_money"] . '</td>
      <td>' . $result["currency"] . '</td>
      <td>' . $result["date"] . '</td>
    </tr>
  </tbody>
  </thead>
';
            $total_money = $total_money + $result["donated_money"];

        }
        $target = $sql_user['futur_money'];
        $have_to = $sql_user['futur_money'] - $total_money;
        echo "
</table><table class='table table-light table-bordered'style='width:0%'>
<thead><tr><th scope='col'>total</th><th scope='col'>target</th><th scope='col'>have to dial</th>
</tr>
</thead>
<tbody>
<tr>
      <td>$total_money </td><td>$target </td><td>$have_to</td>
    </tr>
  </tbody>
</table>";

    } else {
        echo '<div style=\'margin:30px\'>you have no notifications</div>';
    }
    echo '</div>';
}
?>