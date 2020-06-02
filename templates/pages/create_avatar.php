<?php
require('another_page.php');
if($username == ""){
    echo "<meta http-equiv='Refresh' content='0; url=login.php' />";
}else {
    $upload_avatar_name = $_FILES['avatar']['name'];//записываем имя файла
    $uploaddir = 'users/files/';

    if (isset($_POST['submit'])) {
        $types = array('image/png', 'image/jpeg', 'image/pjpeg');
        if (!in_array($_FILES['avatar']['type'], $types)) {
            echo 'Files can be only: *.png, *.jpg';
        } else {
            $result = R::findOne('users', '`login`=?', array($username));
                    if (filesize($_FILES['avatar']['tmp_name']) >= 2000000) {
                        echo filesize("file can't weight 2Mb");
                    }else {


                        $info_avatar = new SplFileInfo($upload_avatar_name);
                        $ras_avatar = $info_avatar->getExtension();
                        $avatar_new = $result['id'] . "_avatar_" . $username . "." . $ras_avatar;
                        if (move_uploaded_file($_FILES['avatar']['tmp_name'], "users/files/" . $avatar_new)) {

                        R::exec("UPDATE `users` SET `avatar`=? WHERE `login`= ?", array($avatar_new, $username));
                            header('Location: ?page=create_company');

                        } else {
                            echo $avatar;
                        }

                }



        }
    }
}
?>
<form method="post" enctype = 'multipart/form-data'>
    <input type="file" name="avatar" accept="image" accept="image" required="required" />
    <input type="submit"name="submit">
</form>
