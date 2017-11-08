<?php
$basedir = realpath(__DIR__);
include_once($basedir . '/users_file/connection.php');


if(session_destroy())
{
    header("Location: loginpage.php");
}
?>