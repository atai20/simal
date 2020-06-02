<?php
require('another_page.php');
$username = filter_var(trim($_GET['user']), FILTER_SANITIZE_STRING);
$file_id = filter_var(trim($_GET['id']), FILTER_SANITIZE_STRING);

if($username == ''){
    header('Location: ?page=error');
}
$sql = R::find('data_files', 'user=?', array($username)) or die("Error files_database");
$result = R::findOne('users', 'login=?', array($username)) or die("Error files_database");

if(!R::findOne('comp_views', 'user=? AND comp=?', array($_SESSION['login'], $username))){
    $comp_views = R::xdispense('comp_views');
    $comp_views ->user = $_SESSION['login'];
    $comp_views ->comp = $username;
    R::store($comp_views);
    R::exec("UPDATE `users` SET `views`=? WHERE `login`= ?", array($result['views']+1, $username));
}


if (isset($_POST['delete'])){
    $username_del = $_SESSION['login'];
    $sqla = R::find('data_files','`user`=? AND `id`=?', array($username_del, $_GET['id'])) or die('error database');
    foreach ($sqla as $result) {
        unlink('users/files/'.$result["files"].'');
        if(R::exec("DELETE FROM `data_files` WHERE `user` = ? AND `id`=?", array($username_del, $_GET['id']))){
            header('Location: ?page=company&user='.$username_del.'');
        }else{
            header('Location: ?page=error');

        }
    }

}
if ($result['company_img']=='' or $result['company_img']=='none'){
echo "
company has no photo
<br>";
if($_SESSION['login'] == $result['login']){
echo "
<a href='?page=create_company'>change account</a>";
}
}else{
    if($result['avatar']=='none'){
        $result['avatar'] = 'users/defaults/avatar.png';
    }
?>
<div style='max-width:1000px;margin:auto;background:white;'>
  <div style='width:100%;height:300px;background:url("users/files/<?=$result['company_img']?>");background-size:cover'>
  </div>
    <div style='width:150px;height:150px;background:url("users/files/<?=$result['avatar']?>");background-size:cover;border-radius:100%;border:3px solid white;margin-top:-60px;float:right;margin-right:70px;'></div>
    <div style="float:right;padding:10px;"><h3><?=$result['login']?></h3></div>
    <h2 style="text-transform:uppercase;padding:15px;font-weight:bold"><?=$result['company_name']?></h2>
    <h4><div style="padding:15px;margin-top:-35px;"><b><?=$result['problem']?></b></div></h4>

    <div style="padding:15px;margin-top:-35px;"><?=$result['company_desc']?></div>
    <h5 style="padding:15px;">need <?=$result['futur_money']?>$</h5>
    <h5 style="padding-left:15px;">have <?=$result['money']?>$</h5>
    <?php
    echo '<div style="padding:15px">';
    if ($result["futur_money"] != 0 and $result["money"] != 0) {
        $zagruzk = $result["futur_money"] / 100;
        $progress = round($result["money"] / $zagruzk);
        echo '
      <div class="progress">
 
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
    echo '</div>';
}

if (isset($_POST['delete_account'])){
  $username = $_SESSION['login'];
      foreach ($sql as $result_files) {
          if(!unlink('users/files/' . $result_files["files"] . '')){
              die('file error');
          }
      }
      foreach ($sql_users as $result) {
          if(!unlink('users/files/' . $result["company_img"] . '') and !unlink('users/files/' . $result["avatar"] . ''))
              die('file error');
      }

  $result_files = R::exec("DELETE FROM `data_files` WHERE `user` = ?", array($username)) or die("Error ");
  $result = R::exec("DELETE FROM `users` WHERE `login` = ?", array($username)) or die("Error ");
  session_destroy();
    header('Location: ?page=companies');
  exit;
}
if (isset($_POST['delete_all'])){
    foreach ($sql as $result) {
        unlink('users/files/'.$result["files"].'');
}
$result = R::exec("DELETE FROM `data_files` WHERE `user` = ?", array($_GET['user'])) or die("Error ");

}else{
    echo "<div style='width: 100%;
    height:120px;
    overflow: hidden;
    overflow-x: scroll;
    white-space:nowrap;'>";

    foreach ($sql as $result) {
    ?><div style='display: inline-block;
    vertical-align: top;
    padding:10px;
    height:100px;'><div class='img_sel'style='height:100%;background:url("users/files/<?=$result["files"]?>")100% 100% no-repeat;background-size:cover;'alt='".$result["files"]."'></div>

    <?php
    if($username == $_SESSION['login']){
        $_SESSION['id'] = $result["id"];
    echo"
<form style=''method='post'action='?page=company&user=".$result["user"]."&id=".$result["id"]."'>
<input type='submit'value='delete' name='delete'>
    </form>";
    }
    echo"</div>";
  }
  echo'</div>';
}

?>
<form method = "post"style="padding:20px;float:right">
<?php
if($username == $_SESSION['login']){
?>
	<input type='submit' name="delete_all" value='delete all files'>
  <input type='submit' name="delete_account" value='delete account'>
    <input type='submit' name="withdraw_money" value='withdraw money'>

    <?php
}else{
?>
  <input type="submit" name="donate" value="donate">
<?php
}
?>
</form>
</div>
<style>
    .img_sel{
        transition: 0.5s;
        background:rgb(0,0,0,0.5);
        opacity:0;
        cursor:pointer
    }
    .img_sel:hover{
        opacity: 100;
    }
</style>