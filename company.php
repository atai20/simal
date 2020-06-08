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
$username = $_GET['user'];
if($username == ''){
    header('Location: ?page=error');
}
$sql = mysqli_query($db, "SELECT * FROM `data_files` WHERE `user` = '$username'") or die("Error files_database");
$sql_user_photo = mysqli_query($db, "SELECT * FROM `users` WHERE `login` = '$username'") or die("Error users database");

if (isset($_POST['delete'])){
    $sqla = mysqli_query($db, "SELECT * FROM `data_files` WHERE `user` = '$username'AND `id` = ".$_SESSION['id']."");
    while ($result = mysqli_fetch_array($sqla)) {
        unlink('files/'.$result["files"].'');
        $query = "DELETE FROM `data_files` WHERE `user` = '$username' AND `id`='".$_SESSION['id']."'";
        if($result2 = mysqli_query($db, $query)){
            header("Refresh:0");
        }else{
            header('Location: ?page=error');

        }
    }

}
while ($result = mysqli_fetch_array($sql_user_photo)) {
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
        $result['avatar'] = 'defaults/avatar.png';
    }
?>
<div class="container-fluid col-md-5" style="margin-top: 20px; background: #FFF; padding: 0;">
  <div style='width:100%;height:300px;background:url("files/<?=$result['company_img']?>");background-size:cover'>
  </div>
    <div style='width:150px;height:150px;background:url("files/<?=$result['avatar']?>");background-size:cover;border-radius:100%;border:3px solid white;margin-top:-60px;float:right;margin-right:70px;'></div>
    <div style="float:right;padding:10px;"><h3><?=$result['login']?></h3></div>
    <h2 style="text-transform:uppercase;padding:15px;font-weight:bold"><?=$result['company_name']?></h2>
    <h4><div style="padding:15px;margin-top:-35px;"><b><?=$result['problem']?></b></div></h4>

    <div style="padding:15px; margin-top:-20px; font-family: Segoe UI; font-size: 1.1em;"><?=$result['company_desc']?></div>
    <?php
    echo '<div style="padding:15px">';
    $zagruzk = $result["futur_money"] / 100;
    $progress = round($result["money"] / $zagruzk);
    $futur_money = $result["futur_money"];
    $money = $result["money"];
    if ($result["futur_money"] != 0 and $result["money"] != 0) {
    } else {
        echo 'no progress<br>';
    }
}
}
if (isset($_POST['delete_account'])){
  $username = $_SESSION['login'];
  $sql = mysqli_query($db, "SELECT * FROM `data_files` WHERE `user` = '$username'") or die("Error files_database");
  $sql_user_photo = mysqli_query($db, "SELECT * FROM `users` WHERE `login` = '$username'") or die("Error users database");
      while ($result_files = mysqli_fetch_array($sql)) {
          unlink('files/' . $result_files["files"] . '');
      }
      while ($result = mysqli_fetch_array($sql_user_photo)) {
          unlink('files/' . $result["company_img"] . '');
          unlink('files/' . $result["avatar"] . '');
      }

  $query_files = "DELETE FROM `data_files` WHERE `user` = '$username'";
  $result_files = mysqli_query($db, $query_files) or die("Error " . mysqli_error($db)); 
  $query = "DELETE FROM `users` WHERE `login` = '$username'";
  $result = mysqli_query($db, $query) or die("Error " . mysqli_error($db));
  session_destroy();
    header('Location: ?page=companies');
  exit;
}
$i = 0;
if (isset($_POST['delete_all'])){
while ($result = mysqli_fetch_array($sql)) {
	unlink('files/'.$result["files"].'');
}
$query ="DELETE FROM `data_files` WHERE `user` = '".$_GET['user']."'";
$result = mysqli_query($db, $query) or die("Error " . mysqli_error($db)); 

}else{
    echo "<div style='width: 100%;
    height:120px;
    overflow: hidden;
    overflow-x: scroll;
    white-space:nowrap;'>";
while ($result = mysqli_fetch_array($sql)) {
    ?><div class='container img_div' id="<?=$i?>" onclick="img($(this).attr('id'));" style='display: inline-block; vertical-align: top; height:100px; width:150px;background:url("files/<?=$result["files"]?>")0% 0% no-repeat;background-size:cover;'alt='".$result["files"]."'></div>

    <?php
    if($username == $_SESSION['login']){
        $_SESSION['id'] = $result["id"];
    echo"
<form style=''method='post'action='?page=company&user=".$result["user"]."'>
<input type='submit'value='delete' name='delete'>
    </form>";
    }
  $i++;
  }
}
  echo"</div>";
  echo'</div>';
 $db->close();

?>
<form method = "post"style="margin: 0;">
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
</form>
</div>
<form method="post">
<div class="container-fluid" style="background: #f7f7f7; width: 100%; margin: 0;">
<p class="text-center" style="font-size: 1.5em; padding-top: 20px;">This company need <?=$futur_money?>$. </p>
<p class="text-center" style="font-size: 1.5em;">This company have <?=$money?>$. </p>
<p class="text-center" style="font-size: 1.5em;">This company needs your help. </p>
<p class="text-center" style="padding-bottom: 20px;">
<input type="submit" class="btn btn-success" name="donate" value="donate">
</p>
</div>
</form>
</form>
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
    body {
      background: #f1f1f1;
    }
</style>
<script type="text/javascript">
  function sd () {
    $(".i").detach();  
  }
</script>