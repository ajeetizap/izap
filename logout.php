<?php
$basedir = realpath(__DIR__);
include_once($basedir . '/users_file/connection.php');


if(session_destroy()) // Destroying All Sessions
{
    header("Location: index.php"); // Redirecting To Home Page
}
?>