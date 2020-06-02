<?php
require('another_page.php');
if($username ==""){
    header('Location: ?page=login');

}else {

    if($user_comp = R::find('tbl_product_detail', '`comp_name_user`= ?', array($username))){
        $sql = R::findAll('tbl_product_detail');
        echo '<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">company name</th>
      <th scope="col">investor</th>
      <th scope="col">donated money</th>
      <th scope="col">currency</th>
      <th scope="col">date</th>
    </tr>
  </thead>';
        foreach ($sql as $result) {
            if ($username == $result["comp_name_user"]) {
                $investor_name = $result["investor_name"];
                R::exec("UPDATE `tbl_product_detail` SET `status`=? WHERE `comp_name_user`= ?", array(1, $username));
                echo '
<thead>
<tbody>
    <tr>
      <td>' . $result["comp_name"] . '</td>
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
        }
        echo "<thead><tr><th scope='col'>total</th>
</tr>
</thead>
<tbody>
<tr>
      <td>$total_money </td>
    </tr>
  </tbody>
</table>";

    }
    else{
        echo 'you have no notifications';
    }
}
?>