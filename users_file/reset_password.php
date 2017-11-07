<?php
include_once('connection.php');

include('user.php');

$user=new user();

$data = $user->reset_password();

?>


    <html>

    <head>
        <title>reset password</title>
    </head>
        <body>
            <form action="" method="post">
                <table>
                    <tr>
                        <th><label>Email</label></th>
                        <th><label>password</label></th>
                    </tr>
                    <tr>
                        <td><input type="text" name="email"  placeholder="email" required></td>
                        <td><input type="password" name="password" placeholder="password" required></td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit" value="change password">
                        </td>
                    </tr>
                </table>
            </form>
        </body>
    </html>
