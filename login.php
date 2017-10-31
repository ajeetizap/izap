<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

include("configuration.php");



session_start();

if(isset($_POST['submit'])) {
    // username and password sent from form

    $name = mysqli_real_escape_string($db,$_POST['name']);
    $price = mysqli_real_escape_string($db,$_POST['price']);
    $quantity = mysqli_real_escape_string($db,$_POST['quantity']);
    $item_code = mysqli_real_escape_string($db,$_POST['item_code']);
    $description = mysqli_real_escape_string($db,$_POST['description']);

    $sql = "SELECT * FROM items WHERE name = '$name' and price = '$price' AND quantity= '$quantity' AND item_code='$item_code' AND description= '$description'";
    $result = mysqli_query($conn,$sql);

    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

    $active = $row['active'];

    $count = mysqli_num_rows($result);

    // If result matched $myusername and $mypassword, table row must be 1 row

    if($count == 1) {
        session_register("name");
        $_SESSION['login_user'] = $name;

        header("location: index.php");
    }else {
        $error = "Your Login Name or Password is invalid";
    }
}

?>
<html>

<body>
<form action="index.php" method="post">
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



            <input type="submit" name="submit" value="insert">


        </td>

    </tr>
</table>

</form>
</body>
</html>