<?php


include 'connection.php';

class login extends connection
{

    public function loginuser()
    {

        session_start();


        if (isset($_POST['submit'])) {

            $email = $_POST["email"];
            $password = $_POST["password"];


            $sql = "SELECT * FROM items WHERE email = ? AND password= ? ";

            if ($stmt = $this->conn->prepare($sql)) {

                $stmt->bind_param('ss', $email, $password);
                $stmt->execute();
                $stmt->store_result();

                echo $stmt->num_rows();

            } else {
                echo "not submitted";
            }
        }

    }
}







?>