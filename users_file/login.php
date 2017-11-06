<!--
--><?php
/*

include 'connection.php';

session_start();

$error='';

class login extends connection
{

    public function loginuser()
    {


        if (isset($_POST['submit'])) {

            $email = $_POST["email"];
            $password = $_POST["password"];


            $sql = "SELECT * FROM items WHERE email = ? AND password= ? ";

            if ($stmt = $this->conn->prepare($sql)) {

                $stmt->bind_param('ss', $email, $password);
                $stmt->execute();
                $stmt->store_result();
//                $rows= mysql_num_rows($stmt);
              echo $rows = $stmt->num_rows();
              exit;

                if ($rows == 1) {

                    $_SESSION['login_user'] = $email;
                    echo "login";
//                    header("location: profile.php"); // Redirecting To Other Page
                } else {
                    $error = "Username or Password is invalid";
                }

            }
        }

        }


}







*/?>