<?php
error_reporting(E_ALL); ini_set('display_errors', 1);
        include_once 'user.php';

        $user = new User();


$insert = $user->insert_user();
    if(isset($_GET['update'])) {

        $data = $user->fetchdata();

    }
$updates = $user->update();

if (isset($_GET['delete']))

    {
        $id = $_GET['delete'];
        $result = $user->delete($id, 'items');
    }


?>


<html>
<head>
    <title>insert, update and delete file</title>

</head>

<body>

<div id="container">

    <h1>Insert Here</h1>


    <form action="" method="POST">


        <table>
            <tr>
                <th><label>Name</label></th>

                <th><label>Price</label></th>

                <th><label>quantity</label></th>

                <th><label>Item code</label></th>

                <th><label>Description</label></th>

                <th><label>Active</label></th>

            </tr>
            <tr>
                <td><input type="text" name="name" value="" placeholder="name" required=""></td>

                <td><input type="text" name="price" value="" placeholder="price" required=""></td>

                <td><input type="text" name="quantity" value="" placeholder="quantity" required=""></td>

                <td><input type="text" name="item_code" value="" placeholder="item code" required=""></td>

                <td><input type="text" name="description" value="" placeholder="description" required=""></td>

                <td><input type="checkbox" name="active" checked></td>
            </tr>

            <tr>
                <td>


                    <input type="hidden" name="id" value=""/>
                    <input type="submit" name="submit" value="insert">


                </td>

            </tr>
        </table>



    </form>



    <br> <br> <br> <br> <br> <br>





    <table>
        <tr>


            <th><label>Name</label></th>
            <th><label>Price</label></th>
            <th><label>quantity</label></th>
            <th><label>Item code</label></th>
            <th><label>Description</label></th>
            <th><label>Active</label></th>



        </tr>



        <?php


        $fetch = $user->fetchdata();

if($fetch->num_rows>0) {


    while ($rows = $fetch->fetch_assoc()) {
        echo "<tr>";

        echo "<td> <center>" . $rows["name"] . "<center></td>";
        echo "<td> <center>" . $rows["price"] . "<center></td>";
        echo "<td> <center>" . $rows["quantity"] . "</center></td>";
        echo "<td> <center>" . $rows["item_code"] . "<center></td>";
        echo "<td> <center>" . $rows["description"] . "<center></td>";


        echo "<td> <a href='index.php?update=$rows[id]'>edit<br /></td>";
        echo "<td> <a href='index.php?delete=$rows[id]'>drop<br /></td>";
        echo "</tr>";


    }
}
else{
    echo "zero result";
}



       /* while($rows=$user->mysqli_stmt_fetch($fetch)) {
                echo "<tr>";

                echo "<td> <center>" . $rows["name"] . "<center></td>";
                echo "<td> <center>" . $rows["price"] . "<center></td>";
                echo "<td> <center>" . $rows["quantity"] . "</center></td>";
                echo "<td> <center>" . $rows["item_code"] . "<center></td>";
                echo "<td> <center>" . $rows["description"] . "<center></td>";


                echo "<td> <a href='index.php?update=$rows[id]'>edit<br /></td>";
                echo "<td> <a href='index.php?delete=$rows[id]'>drop<br /></td>";
                echo "</tr>";


            }*/
//            echo "Fetched data successfully\n";




        ?>




    </table>






</body>


</html>



