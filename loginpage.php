<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);


$basedir = realpath(__DIR__);
include_once($basedir . '/users_file/login.php');

$login = new login();

$data = $login->loginuser();

?>

<html>
<head>
    <title>
        login page
    </title>
</head>

<body>
<form action="" method="post">
<table>
    <tr>
        <th><label>Email</label></th>

        <th><label>password</label></th>


    </tr>
    <tr>
        <td><input type="text" name="email" value="" placeholder="email" required=""></td>

        <td><input type="text" name="password" value="" placeholder="password" required=""></td>


    </tr>

    <tr>
        <td>

            <input type="submit" name="submit" value="insert">


        </td>

    </tr>
</table>

</form>
</body>
</html>


