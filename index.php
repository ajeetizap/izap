<?php
session_start();
$basedir = realpath(__DIR__);
include_once($basedir . '/users_file/usersignup.php');

$usersignup=new  usersignup();


if(isset($_GET['update'])) {

    $id=$_GET['update'];

    $data = $usersignup->fetchdata($id);

}

$updates = $usersignup->update();

$insert = $usersignup->insert_user();


if (isset($_GET['delete']))

{
    $id = $_GET['delete'];

    $result = $usersignup->delete($id, 'user');
}


?>



<html>
<head>

</head>

<body>

<div id="container">

    <h1>Insert Here</h1>


    <form action="" method="POST">


        <table>
            <tr>
                <th><label>Name</label></th>

                <th><label>eail</label></th>

                <th><label>password</label></th>



            </tr>
            <tr>
                <td><input type="text" name="fullname" value="<?php echo isset( $data['fullname']) ? $data['fullname'] : ''; ?>" placeholder="fullname" required=""></td>

                <td><input type="email" name="email" value="<?php echo isset( $data['email']) ? $data['email'] : ''; ?>" placeholder="email" required=""></td>

                <td><input type="password" name="password" value="<?php echo isset( $data['password']) ? $data['password'] : ''; ?>" placeholder="password" required=""></td>


            </tr>

            <tr>
                <td>


                    <input type="hidden" name="id" value="<?php echo isset($_GET['update']) ? $_GET['update'] : ''; ?>" />
                    <input type="submit" name="submit" value="insert">


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




        $sql=$usersignup->fetchdata();



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



