<?php
if(!$_GET['page']){
    header('Location: http://localhost/denwer/templates/?page=companies');
}
$avatar='';

$act_top='';
$act_my_comp='';
$act_cr_comp='';
$act_not='';
$act_acc='';
$act_reg='';
$act_home='';
switch ($_GET['page']) {
    case "companies":
        $act_home = 'active';
        break;
    case "login":
        $act_log = 'active';
        break;
    case "account":
        $act_acc = 'active';
        break;
    case "notifications":
        $act_not = 'active';
        break;
    case "create_company":
        $act_cr_comp = 'active';
        break;
    case "company":
        if($_GET['user']==$username){
            $act_my_comp = 'active';
        }
        break;
    case "top":
        $act_top = 'active';
        break;
}


    $avatar = $sql_user['avatar'];

if($avatar=='' and $username!='' or $avatar=='none'){
    $avatar = 'users/defaults/avatar.png';
}
if(!$username==''){
    $link_comp = "?page=company&user=".$_SESSION['login'];
    $link_account = "?page=account&user=".$username;
    $link_notif = "?page=notifications";
    $link_create = "?page=create_company";

}else{
    $link_comp = "?page=login";
    $link_account = "?page=login";
    $link_notif = "?page=login";
    $link_create = "?page=login";

}
if (mysqli_connect_errno()) {
    printf("ERROR: %s\n", mysqli_connect_error());
    exit();
}
if (isset($_POST['exit'])){
  session_destroy();
  header('Location: ?page=companies');
  exit;
}
$sql_notif = R::findAll( 'users', 'ORDER BY `id`') or die('database problem');
$notif_counter = 0;
foreach ($sql_notif as $result) {
    if($result['comp_name_user'] == $username and $result['status'] == 0 and $username!=''){
        $notif_counter++;
    }
}
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,400;1,400;1,500&display=swap" rel="stylesheet"><meta charset="utf-8">
<nav class="navbar navbar-expand-lg navbar-dark"style="background: #17B1D5;">
    <link href="assets/css/index_styles.css" rel="stylesheet">
    <link rel="icon" href="favicon.ico" type="image/png">
  <a class="navbar-brand" href="?page=companies"><img style='width:30px'src="assets/img/logo2.png"><img style='margin-top:5px;width:50px'src="assets/img/logo_text.png"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item <?=$act_log?>">
        <a class="nav-link" href="?page=login">Login<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item <?=$act_cr_comp?>">
        <a class="nav-link" href="<?=$link_create?>">Create company <span class="sr-only">(current)</span></a>
      </li>
        <li class="nav-item <?=$act_acc?>">
            <a class="nav-link" href="<?=$link_account?>">Account <span class="sr-only">(current)</span></a>
        </li>
      <li class="nav-item <?=$act_not?>">
        <a class="nav-link" href="<?=$link_notif?>">Notifications <?php
            if($notif_counter != 0) {
                echo $notif_counter;
            }?></a>
      </li>
      <li class="nav-item <?=$act_my_comp?>">
        <a class="nav-link" href="<?=$link_comp?>">My company</a>
      </li>
      <li class="nav-item <?=$act_top?>">
        <a class="nav-link" href="?page=top">Top</a>
      </li>
        <form class="form-inline"action="?page=search"method='post'>
    <input class="form-control mr-sm-2"name='find_word' placeholder="find companies" aria-label="Search">
            <button type="submit" class='submit'name="submit">
            <svg class="bi bi-search" color="white"width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
            </svg>
            </button>
  </form>
        <?php
        if($username != ""){
        ?>
        <form class="form-inline"style='position:absolute;right:20px'method='post'>

            <div style='color:white;margin-right:10px;margin-top:5px;'><a href="?page=account&user=<?=$username?>"style="color:white"><?=$username?></a></div><div style = 'margin-top:5px;height:35px;width:35px;border-radius:100%;border: 1px solid white;background:url("users/files/<?=$avatar?>");background-size:cover'></div>

            <button style="border:none;margin-left:20px;background:none;margin-top:4px;color:white;cursor:pointer"name='exit' type="submit">exit</button>
  </form>
    <?php
    }
    ?>
    </ul>
  </div>
</nav>
<style>
    .submit{
        background:none;
        border:none;
        cursor:pointer;
    }
    body{
        background:#E5FFE6;
    }
</style>