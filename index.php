
<?php

$basedir = realpath(__DIR__);
include_once($basedir . '/users_file/user.php');

if(isset($_SESSION['login_user'])){
    header("location: profile.php");
}

$user=new  user();


if(isset($_GET['update'])) {

    $id=$_GET['update'];

    $data = $user->fetchdata($id);

}

$updates = $user->update();

$insert = $user->insert_user();


if (isset($_GET['delete']))

{
    $id = $_GET['delete'];

    $result = $user->delete($id, 'user');
}


?>

<!--<script type="text/javascript">
    signup = document.getElementById("signup"); //searches for and detects the input element from the 'myButton' id
    signup.value = "update";

</script>-->

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
                <td><input type="text" name="fullname" value="<?php echo isset( $data['fullname']) ? $data['fullname'] : ''; ?>" placeholder="fullname" required=""></td>

                <td><input type="text" name="email" value="<?php echo isset( $data['email']) ? $data['email'] : ''; ?>" placeholder="email" required=""></td>

                <td><input type="password" name="password" value="<?php echo isset( $data['password']) ? $data['password'] : ''; ?>" placeholder="password" required=""></td>


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



    <br> <br> <br> <br> <br> <br>





    <table>
        <tr>


            <th><label>Name</label></th>
            <th><label>email</label></th>
            <th><label>password</label></th>


        </tr>






        <?php




        $sql=$user->fetchdata();



        while($rows = $sql->fetch_assoc()) {
            echo "<tr>";

            echo "<td> <center>" . $rows["fullname"] . "<center></td>";
            echo "<td> <center>" . $rows["email"] . "<center></td>";
            echo "<td> <center>" . $rows["password"] . "</center></td>";


            echo "<td> <a href='index.php?update=$rows[id]'>edit<br /></td>";
            echo "<td> <a href='index.php?delete=$rows[id]'>drop<br /></td>";
            echo "</tr>";



        }
        echo "Fetched data successfully\n";





        ?>





    </table>






</body>


</html>



