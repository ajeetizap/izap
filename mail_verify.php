<?php
$basedir = realpath(__DIR__);
include_once($basedir . '/users_file/user.php');

$user=new  user();

$data = $user->mail_verify();

?>




<html>

<head>
    <title>reset password</title>
</head>
<body>
<form action="" method="post">
    <table>
        <tr>

            <th><label>password</label></th>
        </tr>
        <tr>
            <td><input type="password" name="password" placeholder="password" required></td>
        </tr>
        <tr>
            <td>
                <input type="submit" name="submit" value="change password">
                <a href="loginpage.php"> <input type="button" name="login_page" value="Login here"></a>
            </td>
        </tr>
    </table>
</form>
</body>
</html>

