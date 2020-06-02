<?php
require('another_page.php');
$username = $_SESSION["login"];
if($username == ""){
	echo "<meta http-equiv='Refresh' content='0; url=login.php' />";
}else{
$uploadname = $_FILES['file']['name'];//записываем имя файла
$uploaddir = 'users/files/';

if(isset($_POST['submit'])){
$types = array('image/png', 'image/jpeg', 'image/pjpeg');
if (!in_array($_FILES['file']['type'], $types)){
     echo 'Files can be only: *.png, *.jpg';
}else {

    if ($result = R::find('users', "`login`=?", array($username))) {
            foreach ($result as $row) {
                $info = new SplFileInfo($uploadname);
                $ras = $info->getExtension();
                $uploadfile = $row['id'] . "_main_" . $username . "." . $ras;
            }



            $company_desc = filter_var(trim($_POST["company_desc"]), FILTER_SANITIZE_STRING);
            $little_desc = filter_var(trim($_POST["little_desc"]), FILTER_SANITIZE_STRING);
            $problem = filter_var(trim($_POST["problem"]), FILTER_SANITIZE_STRING);
            $company_name = filter_var(trim($_POST["company_name"]), FILTER_SANITIZE_STRING);
            if(!R::find('users', '`company_name` = ?', array($company_name))) {
                if (filesize($_FILES['file']['tmp_name']) >= 2000000) {
                    echo "file can't weight 2Mb";
                } else {
                if (move_uploaded_file($_FILES['file']['tmp_name'], "users/files/" . $uploadfile)) {
                    if (mb_strlen($company_name) < 5 || mb_strlen($company_name) > 30) {
                        echo '<div style = "max-width:510px; width:100%; margin:auto;margin-top:20px;"class="alert alert-danger" role="alert">
              invalid company name length
                </div>';
                        exit();
                    } elseif (mb_strlen($company_desc) < 5) {
                        echo '<div style = "max-width:510px; width:100%; margin:auto;margin-top:20px;"class="alert alert-danger" role="alert">
              invalid description length
                </div>';
                        exit();
                    } elseif (mb_strlen($little_desc) < 5) {
                        echo '<div style = "max-width:510px; width:100%; margin:auto;margin-top:20px;"class="alert alert-danger" role="alert">
              invalid little description length
                </div>';
                        exit();
                    } else {
                        $avi = 0; // создаём переменную для цикла по папке films
                        $fileCount = count($_FILES['files']['name']);
                        $error = false;
                        for ($i = 0; $i < $fileCount; $i++) {
                            if (!in_array($_FILES['files']['type'][$i], $types)) {
                                echo 'Files can be only: *.png, *.jpg';
                            } else {
                                if (filesize($_FILES['files']['tmp_name'][$i]) >= 2000000) {
                                    echo "file can't weight 2Mb";
                                } else {
                                    if ($result=R::findAll("data_files", 'ORDER BY `id` DESC LIMIT 1')) {
                                        $num = count("data_files");
                                        if ($num == 0) {
                                            $info = new SplFileInfo($uploadname);
                                            $ras = $info->getExtension();
                                            $new_file_name = 1;
                                            if ($new_file_name) {
                                                $fileName = $new_file_name . "_" . $username . "." . $ras;
                                            } else {
                                                echo "id file error";
                                            }
                                        } else {

                                            foreach ($result as $row) {

                                                $info = new SplFileInfo($uploadname);
                                                $ras = $info->getExtension();
                                                $new_file_name = $row['id'] + 1;
                                                if ($new_file_name) {
                                                    $fileName = $new_file_name . "_" . $username . "." . $ras;
                                                } else {
                                                    echo "id file error";
                                                }
                                            }

                                        }
                                    }


                                    if (move_uploaded_file($_FILES['files']['tmp_name'][$i], 'users/files/' . $fileName)) {
                                        $data_files = R::xdispense('data_files');
                                        $data_files ->files = $fileName;
                                        $data_files ->user = $username;
                                        R::store($data_files);

                                        echo "File Upload Succesfully";
                                    } else {
                                        $error = True;
                                        echo "ERROR";
                                    }

                                }
                            }
                        }
                        if ($error == false) {
                            $futur_money = intval($_POST["futur_money"]);
                            R::exec("UPDATE `users` SET `company_name`=?,`problem`=?, `company_desc`=?,`little_desc`=?,`company_img`=?,`futur_money`=?,`date`=? WHERE `login`= ?",
                            array($company_name, $problem, $company_desc, $little_desc, $uploadfile, $futur_money, strval(date('n')+date('Y')), $username));
                            header('Location: ?page=companies');
                        }
                    }
                } else {
                    echo 'progress error';
                }
            }
        } else echo 'Company name already exist';


    }else{
        echo 'database error: comp_img';
    }
}
}
}
?>
<form method="post" enctype = 'multipart/form-data'>
    <input type="text" name="company_name">
    <input type="text" name="company_desc">
    <input type="text" name="little_desc">
    <select  name="problem">
        <option value="pollution">pollution</option>
        <option value="hunger">hunger</option>
        <option value="war">war</option>
        <option value="diseases">diseases</option>
    </select>
    <input type="number" name="futur_money">
    <input type="file" multiple name="files[]" accept="image" required="required"  />
    <input type="file" name="file" accept="image" accept="image" required="required" />
    <input type="submit"name="submit">
</form>
