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
            echo '<img class="account"src="users/files/' . $result['avatar'] . '">';
            if ($result['company_name'] != 'none') {
                echo '
    ' . $username_acc . ', company: <a href=' . $link . '>' . $result['company_name'] . '</a>';
            }

        }


    $sql_invest = R::findAll('tbl_product_detail') or die('database problem');
    if ($username == $user_acc) {
        echo '<br><a href="?page=create_avatar">create avatar</a>';
    }
    echo '
<h1>TRANSACTIONS</h1>
<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">company name</th>
      <th scope="col">investor</th>
      <th scope="col">donated money</th>
      <th scope="col">currency</th>
      <th scope="col">date</th>
    </tr>
  </thead>';
    foreach ($sql_invest as $result) {
        if ($username_account == $result["investor_name"]) {
            $investor_name = $result["investor_name"];
            echo '<thead>
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
    } else {
        echo "'account is'nt exist or deleted";
    }
}
