<?php
require('another_page.php');
if($username == ""){
    header('Location: login.php');
}else {
    $upload_avatar_name = $_FILES['avatar']['name'];//записываем имя файла
    $uploaddir = 'users/files/';

    if (isset($_POST['submit'])) {
        $types = array('image/png', 'image/jpeg', 'image/pjpeg');
        if (!in_array($_FILES['avatar']['type'], $types)) {
            $error = 'Files can be only: *.png, *.jpg';
            $padding = '12px';
            $width = '100%';
        } else {
                    if (filesize($_FILES['avatar']['tmp_name']) >= 2000000) {
                        echo filesize("file can't weight 2Mb");
                    }else {
                        $info_avatar = new SplFileInfo($upload_avatar_name);
                        $ras_avatar = $info_avatar->getExtension();
                        $avatar_name = $sql_user['id'] . "_avatar_" . $username;
                        $avatar_new = $sql_user['id'] . "_avatar_" . $username. "." . $ras_avatar;
                        $sql_avatar = R::findOne('users','`login`=?', array($username));
                        $split_avatar = explode(".", $sql_avatar['avatar']);
                        if (move_uploaded_file($_FILES['avatar']['tmp_name'], "users/files/" . $avatar_new)) {
                            if($split_avatar[0]==$avatar_name and $split_avatar[1]!=$ras_avatar){
                                echo $split_avatar[1].' '.$ras_avatar;
                                unlink('users/files/'.$sql_avatar['avatar']);
                            }
                            $avatar_new1 = $sql_user['id'] . "_avatar_" . $username . "." . $ras_avatar;
                            R::exec("UPDATE `users` SET `avatar`=? WHERE `login`= ?", array($avatar_new1, $username));
                            header('Location: ?page=create_company');

                        } else {
                            echo 'file uploading error';
                        }

                }



        }
    }
}
?>
<body>
<div id="login">
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" style='background:white; border:none;border-radius:4px;-webkit-box-shadow: 0px 3px 3px -1px rgba(135,135,135,1);
-moz-box-shadow: 0px 3px 3px -1px rgba(135,135,135,1);
box-shadow: 0px 3px 3px -1px rgba(135,135,135,1);padding-bottom:0;'class="col-md-12">
                    <form id="login-form" class="form" action="" method="post"enctype = 'multipart/form-data'>
                        <h3 class="text-center text-info">Avatar</h3>
                        <div class="form-group">
                            <input type="file"  name="avatar" placeszaccept="image" required="required"  class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-info btn-md">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div style = "max-width:510px;  width:<?=$width?>;padding:<?=$padding?>; margin:auto;margin-top:20px;"class="alert alert-danger" role="alert">
    <?=$error?>
</div>
</body>
