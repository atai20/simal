<?php
require('another_page.php');
$username = $_SESSION["login"];
if($username == ""){
    header('Location: ?page=login');
}else{
    if($sql_user['company_name']=='none'){
$uploadname = $_FILES['file']['name'];//записываем имя файла
$uploaddir = 'users/files/';

if(isset($_POST['submit'])){
    $futur_money = intval($_POST["futur_money"]);
    $company_desc = filter_var(trim($_POST["company_desc"]), FILTER_SANITIZE_STRING);
    $little_desc = filter_var(trim($_POST["little_desc"]), FILTER_SANITIZE_STRING);
    $problem = filter_var(trim($_POST["problem"]), FILTER_SANITIZE_STRING);
    $company_name = filter_var(trim($_POST["company_name"]), FILTER_SANITIZE_STRING);
    $problems = array('pollution','hunger','war','diseases');
    $width = '100%';
    $padding = '12px';
    $types = array('image/png', 'image/jpeg', 'image/pjpeg');
    if (!in_array($_FILES['file']['type'], $types)){
        $error = 'Files can be only: *.png, *.jpg';
    }elseif (mb_strlen($company_desc) < 50 || mb_strlen($company_desc) > 10000) {
        $error = 'invalid description length';
    }elseif (mb_strlen($little_desc) < 10 || mb_strlen($little_desc) > 100) {
        $error = 'invalid short description length';
    }elseif (mb_strlen($company_name) < 6 || mb_strlen($company_name) > 20) {
        $error = 'invalid name length';
    }elseif ($futur_money<=0 || $futur_money>1000000) {
        $error = 'invalid need money value';
    }elseif (!in_array($problem, $problems)) {
        exit('problem name error');
    }else {
                $info = new SplFileInfo($uploadname);
                $ras = $info->getExtension();
                $uploadfile = $sql_user['id'] . "_main_" . $username . "." . $ras;
            if(!R::find('users', '`company_name` = ?', array($company_name))) {
                if (filesize($_FILES['file']['tmp_name']) >= 2000000) {
                    $width = '100%';
                    $padding = '12px';
                    $error =  "file can't weight 2Mb";
                } else {
                if (move_uploaded_file($_FILES['file']['tmp_name'], "users/files/" . $uploadfile)) {
                    if (mb_strlen($company_name) < 5 || mb_strlen($company_name) > 30) {
                        $width = '100%';
                        $padding = '12px';
                        $error =  'invalid company name length';
                        exit();
                    } elseif (mb_strlen($company_desc) < 5) {
                        $width = '100%';
                        $padding = '12px';
                        $error =  '
              invalid description length';
                        exit();
                    } elseif (mb_strlen($little_desc) < 5) {
                        $width = '100%';
                        $padding = '12px';
                        $error =  '
              invalid little description length';
                        exit();
                    } else {
                        $avi = 0; // создаём переменную для цикла по папке films
                        $fileCount = count($_FILES['files']['name']);
                        $error = false;
                        for ($i = 0; $i < $fileCount; $i++) {
                            if (!in_array($_FILES['files']['type'][$i], $types)) {
                                $width = '100%';
                                $padding = '12px';
                                $error =  'Files can be only: *.png, *.jpg';
                            } else {
                                if (filesize($_FILES['files']['tmp_name'][$i]) >= 2000000) {
                                    $width = '100%';
                                    $padding = '12px';
                                    $error =  "file can't weight 2Mb";
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
                                                $width = '100%';
                                                $padding = '12px';
                                                $error =  "id file error";
                                            }
                                        } else {

                                            foreach ($result as $row) {

                                                $info = new SplFileInfo($uploadname);
                                                $ras = $info->getExtension();
                                                $new_file_name = $row['id'] + 1;
                                                if ($new_file_name) {
                                                    $fileName = $new_file_name . "_" . $username . "." . $ras;
                                                } else {
                                                    $width = '100%';
                                                    $padding = '12px';
                                                    $error =  "id file error";
                                                }
                                            }

                                        }
                                    }


                                    if (move_uploaded_file($_FILES['files']['tmp_name'][$i], 'users/files/' . $fileName)) {
                                        $data_files = R::xdispense('data_files');
                                        $data_files ->files = $fileName;
                                        $data_files ->user = $username;
                                        R::store($data_files);
                                    } else {
                                        $error = True;
                                        $width = '100%';
                                        $padding = '12px';
                                        $error =  "ERROR";
                                    }

                                }
                            }
                        }
                        if ($error == false) {
                            $width = '0';
                            $padding = '0';
                            R::exec("UPDATE `users` SET `company_name`=?,`problem`=?, `company_desc`=?,`little_desc`=?,`company_img`=?,`futur_money`=?,`date`=? WHERE `login`= ?",
                            array($company_name, $problem, $company_desc, $little_desc, $uploadfile, $futur_money, strval(100*date('Y')+100*date('z')+date('G')), $username));
                            header('Location: ?page=companies');
                        }
                    }
                } else {
                    $width = '100%';
                    $padding = '12px';
                    $error =  'progress error';
                }
            }
        } else{
                $width = '100%';
                $padding = '12px';
                $error =  'Company name already exist';}

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
box-shadow: 0px 3px 3px -1px rgba(135,135,135,1);padding-bottom:0;margin-top:50px;'class="col-md-12">
                <form id="login-form" class="form" action="" method="post"enctype = 'multipart/form-data'>
                    <h3 class="text-center text-info">Create company</h3>
                    <div class="form-group">
                        <input type="text" placeholder="name"name="company_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="description"name="company_desc" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="short description"name="little_desc" class="form-control">
                    </div>
                    <div class="text-info">company problem</div>
                    <div class="form-group">
                        <select  name="problem">
                            <option value="pollution">pollution</option>
                            <option value="hunger">hunger</option>
                            <option value="diseases">diseases</option>
                            <option value="illiteracy">illiteracy of countries</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="number" placeholder="need money"name="futur_money" class="form-control">
                    </div>
                    <div class="text-info">company images</div>
                    <div class="form-group">
                        <input type="file" multiple name="files[]" accept="image" required="required"  class="form-control">
                    </div>
                    <div class="text-info">main company image</div>
                    <div class="form-group">
                        <input type="file"  name="file" placeszaccept="image" required="required"  class="form-control">
                    </div>
                    <div class="form-group"><br>
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
<?php
}
