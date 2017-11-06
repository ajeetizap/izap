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