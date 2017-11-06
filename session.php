<?php
$basedir = realpath(__DIR__);
include_once($basedir . '/users_file/user.php');
$user=new user();

$data = $user->loginuser();

echo 'welcome'.$_SESSION['email'];
exit();

$user_check=$_SESSION['email'];
$result = mysqli_query($conn,"SELECT * FROM user WHERE email='$user_check'");

$row = mysqli_fetch_array($conn,$result);


$login_session = $row['email'];

if(!isset($_SESSION['login_user'])){
    header("location:loginpage.php");
}
?>


