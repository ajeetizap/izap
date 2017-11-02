<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);


include 'user.php';

$user = new user();
$data = $user->loginuser();
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
        <th><label>Name</label></th>

        <th><label>Item code</label></th>


    </tr>
    <tr>
        <td><input type="text" name="name" value="" placeholder="name" required=""></td>

        <td><input type="text" name="item_code" value="" placeholder="item code" required=""></td>

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



