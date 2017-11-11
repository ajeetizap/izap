    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);


    $basedir = realpath(__DIR__);
    include_once($basedir . '/users_file/user.php');

    $user=new user();

    $data = $user->reset_password();

    ?>


    <html>

    <head>
        <title>reset password</title>
    </head>
        <body>
            <form action="" method="post" name="change_pass">
                <table>
                    <tr>
                        <th><label>Email</label></th>

                    </tr>
                    <tr>
                        <td><input type="text" name="email"  placeholder="email" required></td>

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
