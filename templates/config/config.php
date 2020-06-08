<?php
session_start();
require('plugins/rb/rb.php');

$username = $_SESSION['login'];
R::setup('mysql:host=127.0.0.1;dbname=simal', 'root', '');
if( !R::testConnection()){
    exit ('error database connecting');
}
R::ext('xdispense', function($table_name){
    return R::getRedBean()->dispense($table_name);
});
$sql_users = R::findAll('users', 'ORDER BY `views` DESC') or die('database problem');
$sql_user = R::findOne('users', 'login=?', array($username));
$sql = R::findAll("users", 'ORDER BY `invested_money`') or die('database error1');
$top_users[] = null;
$top_companies[] = null;
$sql_best_comp =  R::findAll('tbl_product_detail', 'ORDER BY `donated_money`') or die('database error2');
foreach ($sql as $result) {
    $invested_money = 0;
    $top_user = $result["login"];
    $sql_best_comp = R::find('tbl_product_detail', '`investor_name` = ?', array($result["login"]));
    foreach  ($sql_best_comp as $result_comp) {
        $invested_money = $invested_money + $result_comp['donated_money'];

    }
    array_push($top_users, $invested_money);
}

sort($top_users);
$user_counter[] = null;
foreach ($top_users as &$value) {
    if($value == ''){
        $value = 0;
    }
    foreach ($sql_users as $result_2) {
        $invested_money_2 = 0;
        $top_user = $result_2["login"];
        $sql_best_user = R::find('tbl_product_detail',"`investor_name` = ?", array($top_user));
        foreach ($sql_best_user as $result_best_user) {
            $invested_money_2 = $invested_money_2 + $result_best_user['donated_money'];
        }
        if($invested_money_2 == $value){
            array_push($user_counter, $top_user);
        }
    }

}
$user_ravn1 = array_unique($user_counter);
krsort($user_ravn1);
$bool = true;
foreach ($user_ravn1 as &$result){
    if($result!='' and $bool){
        $best_user = $result;
        $bool = false;
    }
}
$sql_best_user = R::findOne('users', '`login`=?', array($best_user));

function ban($user_ban){
    $sql = R::find('data_files', 'user=?', array($user_ban));
    $sql_user = R::findOne('users', 'login=?', array($user_ban));
    foreach ($sql as $result_files) {
        if(!unlink('users/files/' . $result_files["files"] . '')){
            die('file error');
        }
    }
    if(!unlink('users/files/' . $sql_user["company_img"] . '') and !unlink('users/files/' . $sql_user["avatar"] . ''))
            die('file error');

    R::exec("UPDATE `ban_users` SET `email`=?",array($sql_user["email"]));
    $result_files = R::exec("DELETE FROM `data_files` WHERE `user` = ?", array($user_ban)) or die("Error ");
    $result = R::exec("DELETE FROM `users` WHERE `login` = ?", array($user_ban)) or die("Error ");

}
$padding = 0;
$width = 0;
require('header.php');
//username
//connection
if(!$_GET['page']){
    header('Location: http://localhost/denwer/templates/?page=companies');
}