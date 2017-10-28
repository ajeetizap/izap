<?php
/**
 * Created by PhpStorm.
 * User: ajeet
 * Date: 10/26/17
 * Time: 12:24 PM
 */

$check="SELECT * FROM loginuser WHERE item_code = '$_POST[item_code]'";
$rs = mysqli_query($this->conn,$check);
$data = mysqli_fetch_array($rs, MYSQLI_NUM);
if($data[0] > 1) {
    echo "User Already in Exists<br/>";
}

else
{
    $newUser="INSERT INTO persons(Email,FirstName,LastName,PassWord) values('$_POST[eMailTxt]','$_POST[NameTxt]','$_POST[LnameTxt]','$_POST[passWordTxt]')";
    if (mysqli_query($con,$newUser))
    {
        echo "You are now registered<br/>";
    }
    else
    {
        echo "Error adding user in database<br/>";
    }
}
?>