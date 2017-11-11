
    <?php

    $basedir = realpath(__DIR__);
    include_once($basedir . '/users_file/user.php');



    if(isset($_SESSION['login_user'])){
        header("location: profile.php");
    }
    $user=new user();



    $insert = $user->insert_user();


    ?>

<html>
<head>
    <title>signin page</title>

</head>

<body>

<div id="container">

    <h1>Insert Here</h1>


    <form action="" method="POST">


        <table>
            <tr>
                <th><label>Name</label></th>

                <th><label>email</label></th>

                <th><label>password</label></th>



            </tr>
            <tr>
                <td><input type="text" name="fullname"  placeholder="fullname" required=""></td>

                <td><input type="text" name="email"  placeholder="email" required=""></td>

                <td><input type="password" name="password"  placeholder="password" required=""></td>


            </tr>

            <tr>
                <td>


                    <input type="hidden" name="id" value="<?php echo isset($_GET['update']) ? $_GET['update'] : ''; ?>" />
                    <input type="submit" name="submit" id="signup" value="signup">
                    <a href="loginpage.php"> <input type="button" name="login" value="Already signin"></a>


                </td>

            </tr>
        </table>



    </form>



</body>


</html>



