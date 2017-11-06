<?php
$basedir = realpath(__DIR__);
include_once($basedir . '/users_file/user.php');

$user_check=$_SESSION['login_user'];


if(!isset($_SESSION['login_user'])){
    header("location:loginpage.php");
}
?>


