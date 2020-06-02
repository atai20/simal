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

require('header.php');
//username
//connection
if(!$_GET['page']){
    header('Location: http://localhost/denwer/templates/?page=companies');
}