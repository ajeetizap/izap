<?php


include 'connection.php';

class user extends database
{

    public function loginuser()
    {

        session_start();


        if (isset($_POST['submit'])) {

            $name = $_POST["name"];
            $item_code = $_POST["item_code"];


            $sql = "SELECT * FROM items WHERE name = ? AND item_code= ? ";

            if ($stmt = $this->conn->prepare($sql)) {

                $stmt->bind_param('ss', $name, $item_code);
                $stmt->execute();
                $stmt->store_result();

                echo $stmt->num_rows();

            } else {
                echo "not submitted";
            }
        }

    }
}




            /*$count = $this->conn->num_rows($sql);

            if($count == 1) {
                session_register("name");
                $_SESSION['login_user'] = $name;

                header("location: ../index.php");
            }else {
                $error = "Your Login Name or Password is invalid";
            }*/





?>