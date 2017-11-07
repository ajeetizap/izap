<?php

   include('session.php');


?>



<!DOCTYPE html>
<html>
<head>
    <title>Your Home Page</title>

</head>
<body>
<div id="profile">

    <b id="welcome">Welcome <br>
        <?php
       echo $user_check;

        ?>

    <b id="logout">&nbsp;&nbsp;
        <a href="logout.php">Log Out</a></b>
</div>
</body>
</html>





<?php

$basedir = realpath(__DIR__);
include_once($basedir . '/users_file/user.php');


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

<html>
<head>
    <title>signin page</title>

</head>

<body>


 <table>
     <tr>
         <td>
             <h1>You are Logged in</h1>


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


                     echo "<td> <a href='profile.php?update=$rows[id]'><input type='button' id='edit' value='edit'></a><br /></td>";
                     echo "<td> <a href='profile.php?delete=$rows[id]'><input type='button' id='drop' value='drop'></a><br /></td>";
                     echo "</tr>";



                 }
                 echo "Fetched data successfully\n";





                 ?>





             </table>
         </td>




         <td>


             <?php

             $basedir = realpath(__DIR__);
             include_once($basedir . '/users_file/items.php');

             $items=new  items();



             if(isset($_GET['update'])) {

                 $id=$_GET['update'];


                 $data = $items->fetchdata($id);


             }

             $updates = $items->update();

             $insert = $items->insert_user();


             if (isset($_GET['delete']))

             {
                 $id = $_GET['delete'];

                 $result = $items->delete($id, 'items');
             }


             ?>


             <html>
             <head>

             </head>

             <body>

             <div id="container">

                 <h1>Insert item</h1>


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
                             <td><input type="text" name="name" value="<?php echo isset( $data['name']) ? $data['name'] : ''; ?>" placeholder="name" required=""></td>

                             <td><input type="text" name="price" value="<?php echo isset( $data['price']) ? $data['price'] : ''; ?>" placeholder="price" required=""></td>

                             <td><input type="text" name="quantity" value="<?php echo isset( $data['quantity']) ? $data['quantity'] : ''; ?>" placeholder="quantity" required=""></td>

                             <td><input type="text" name="item_code" value="<?php echo isset( $data['item_code']) ? $data['item_code'] : ''; ?>" placeholder="item code" required=""></td>

                             <td><input type="text" name="description" value="<?php echo isset( $data['description']) ? $data['description'] : ''; ?>" placeholder="description" required=""></td>

                             <td><input type="checkbox" name="active" checked></td>
                         </tr>

                         <tr>
                             <td>


                                 <input type="hidden" name="id" value="<?php echo isset($_GET['update']) ? $_GET['update'] : ''; ?>" />
                                 <input type="submit" name="insert_item" value="insert">


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




                     $sql=$items->fetchdata();



                     while($rows = $sql->fetch_assoc()) {
                         echo "<tr>";

                         echo "<td> <center>" . $rows["name"] . "<center></td>";
                         echo "<td> <center>" . $rows["price"] . "<center></td>";
                         echo "<td> <center>" . $rows["quantity"] . "</center></td>";
                         echo "<td> <center>" . $rows["item_code"] . "<center></td>";
                         echo "<td> <center>" . $rows["description"] . "<center></td>";


                         echo "<td> <a href='profile.php?update=$rows[id]'>edit<br /></td>";
                         echo "<td> <a href='profile.php?delete=$rows[id]'>drop<br /></td>";
                         echo "</tr>";



                     }
                     echo "Fetched data successfully\n";





                     ?>





                 </table>






             </body>


             </html>




         </td>
     </tr>
 </table>






</body>


</html>



