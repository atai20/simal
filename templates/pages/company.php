<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
  function img (id) {
    $("html").append("<div class='temno i' style='width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); position: fixed; top: 1px;'>");
    var back = $("#" + id).css("background-image");
    var path = back.slice(4, -1);
    $(".temno").append("<div class='i ne_temno container-fluid col-6' style='opacity: 1; max-width: 700px; margin-top: 5%;'>");
    $(".ne_temno").append("<img class='i' src="+path+" style='width: 100%; margin-top: 25%;'>");
    $("html").append("<div style='position: fixed; top: 20px;' class='i text-right container-fluid'><button onclick='sd()' style='background: none; border: none; color: white; cursor: pointer; text-decoration: underline;'>Закрыть</button></div>");
  }
</script>
<?php
require('another_page.php');
$username = filter_var(trim($_GET['user']), FILTER_SANITIZE_STRING);
$file_id = filter_var(trim($_GET['id']), FILTER_SANITIZE_STRING);
if (!($_SESSION['login']==$_GET['user'] and $sql_user['company_name']=='none')) {
    
    if($username == '') {
        header('Location: ?page=error');
    }

    $sql = R::find('data_files', 'user=?', array($username));
    if ($result = R::findOne('users', 'login=?', array($username))) {

    if (!R::findOne('comp_views', 'user=? AND comp=?', array($_SESSION['login'], $username)) and $_SESSION['login']!='') {
        $comp_views = R::xdispense('comp_views');
        $comp_views ->user = $_SESSION['login'];
        $comp_views ->comp = $username;
        R::store($comp_views);
        R::exec("UPDATE `users` SET `views`=? WHERE `login`= ?", array($result['views']+1, $username));
    }

    if (isset($_POST['delete_account'])) {
        $username = $_SESSION['login'];
        foreach ($sql as $result_files) {
            if(!unlink('users/files/' . $result_files["files"] . '')) {
                die('file error');
            }
        }

        if (!unlink('users/files/' . $sql_user["company_img"] . '') and !unlink('users/files/' . $sql_user["avatar"] . '')) 
            die('file error');
            $result_files = R::exec("DELETE FROM `data_files` WHERE `user` = ?", array($username)) or die("Error ");
            $result = R::exec("DELETE FROM `users` WHERE `login` = ?", array($username)) or die("Error ");
            session_destroy();
            header('Location: ?page=companies');
            exit;
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
<div class="container-fluid col-md-5 col-xs-8" style='margin-top: 20px; background: #FFF; padding: 0;'>
  <div style='width:100%;height:300px;background:url("users/files/<?=$result['company_img']?>") 50% 50%;background-size:cover'>
  </div>
    <div style='width:150px;height:150px;background:url("users/files/<?=$result['avatar']?>");background-size:cover;border-radius:100%;border:3px solid white;margin-top:-60px;float:right;margin-right:70px;'></div>
    <div style="float:right;padding:10px;"><h3><?=$result['login']?></h3></div>
    <h2 style="text-transform:uppercase;padding:15px;font-weight:bold"><?=$result['company_name']?></h2>
    <h4><div style="padding:15px;margin-top:-35px;"><b><?=$result['problem']?></b></div></h4>

    <div style="padding:15px;word-wrap: break-word;margin-top:-20px;font-family: Segoe UI; font-size: 1.1em; line-height: 2;"><?=$result['company_desc']?></div>
<?php
}
$futur_money = $result["futur_money"];
$money = $result["money"];
$i = 0;
if (isset($_POST['delete_all'])){
    foreach ($sql as $result) {
        if($result["files"]!=""){
            unlink('users/files/'.$result["files"].'');
            $bool = true;
        }
}
    if($bool){
        $result = R::exec("DELETE FROM `data_files` WHERE `user` = ?", array($_GET['user'])) or die("Error ");
    }

}else{
    echo "<div style='width: 100%;
    height:120px;
    overflow: hidden;
    overflow-x: scroll;
    white-space:nowrap;'>";

    foreach ($sql as $result) {
    ?><div class='container' id="<?=$i?>" onclick="img($(this).attr('id'));" style='display: inline-block; vertical-align: top; height:100px; width:150px;background:url("users/files/<?=$result["files"]?>")100% 100% no-repeat;background-size:cover;'alt='".$result["files"]."'></div>

    <?php
    if($username == $_SESSION['login']){
        $_SESSION['id'] = $result["id"];
    echo"
<form style=''method='post'action='?page=company&user=".$result["user"]."&id=".$result["id"]."'>
<input type='submit'value='delete' name='delete'>
    </form>";
    }
    $i++;
  }
  echo "</div>";
}

?>
<form method = "post">
<?php
if($username == $_SESSION['login']){
?>
	<input type='submit' name="delete_all" value='delete all files'>
  <input type='submit' name="delete_account" value='delete account'>
    <input type='submit' name="withdraw_money" value='withdraw money'>

    <?php
}else{
?>

<?php
}
?>
<div class="container-fluid" style="background: #f7f7f7; width: 100%; margin: 0;">
<p class="text-center" style="font-size: 1.5em; padding-top: 20px;">This company need <?=$futur_money?>$. </p>
<p class="text-center" style="font-size: 1.5em;">This company have <?=$money?>$. </p>
<p class="text-center" style="font-size: 1.5em;">This company needs your help. </p>
<p class="text-center" style="padding-bottom: 20px;">
<input type="submit" class="btn btn-success" name="donate" value="donate">
</p>
</div>
</form>
</div>
<style>
    body {
      background: #f1f1f1;
    }
</style>
<?php
}else{
    echo 'company doesn`t exist<br>';
}
}else{
    echo 'you have no company<br>
    <a href="?page=create_company">create company</a>';
}
?>
<script type="text/javascript">
  function sd () {
    $(".i").detach();  
  }
</script>