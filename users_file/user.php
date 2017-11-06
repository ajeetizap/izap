<?php

include('connection.php');



class user extends connection
{


    public function insert_user()
    {
        if (isset($_POST['submit'])) {


            $email =$_POST["email"];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "Invalid email format";
            }else{

                if (!isset($_GET['update'])) {

                    $sql = "SELECT * FROM user WHERE email=? ";

                    if ($stmt = $this->conn->prepare($sql)) {

                        $stmt->bind_param("s", $email);
                        $stmt->execute();
                        $stmt->store_result();

                        $rows = $stmt->num_rows();


                        if ($rows >= 1) {
                            echo "email exists";
                        } else {
                            extract($_POST);

                            $sql = $this->conn->prepare("INSERT INTO user (fullname,email,password) VALUES (?, ?, ?)");

                            $sql->bind_param("sss", $fullname, $email, $password);

                            $sql->execute();
                        }
                    }

                }

            }

        }
       }


    public function loginuser()
    {


        if (isset($_POST['submit'])) {
            extract($_POST);
            $sql = "SELECT * FROM user WHERE email= ? AND password=?";

            if ($stmt = $this->conn->prepare($sql)) {

                $stmt->bind_param('ss', $email,$password);
                $stmt->execute();
                $stmt->store_result();

                $row = $stmt->num_rows();


                if ($row >= 1) {

                    $_SESSION['login_user']=$email;


                    header("location: profile.php");

                    /*$_SESSION['login_user'] = $email;


                    header("Location:profile.php");*/
                }
                else {
                    echo  "Username or Password is invalid";
                }

            }
        }

    }
    


    public function fetchdata($id=0)

    {

        if($id==0) {
            $sql = "select * from user";

            $result = $this->conn->query($sql) or die($this->conn->connect_error . "Data cannot inserted");
            return $result;

        }
        else{
            $query=$this->conn->prepare("SELECT fullname,email,password FROM user WHERE id=?");

            $query->bind_param("i",$id);
            $query->execute();

            $query->bind_result($fullname,$email,$password);

            $query->fetch();

            return ['fullname'=>$fullname,'email'=>$email,'password'=>$password];




        }

    }


    public function delete($id, $table)
    {

        $query = "DELETE FROM $table WHERE id = ?";

        $sql = $this->conn->prepare($query);

        $sql->bind_param("i",$id);




        if ($sql->execute()) {


            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $this->conn->error;
        }

        if ($sql == false) {
            echo 'Error: cannot delete id ' . $id . ' from table ' . $table;
            return false;
        } else {
            header("Location:index.php");
        }


    }



    function update()
    {
        if (isset($_POST['submit'], $_GET['update']) && !empty($_GET['update'])) {
            $id = $_GET['update'];

            extract($_REQUEST);

            $stmt = $this->conn->prepare("UPDATE user SET fullname = ?, email = ?, password = ? WHERE id=?");

            $stmt->bind_param('sssi', $fullname, $email, $password, $id);

            $stmt->execute();

            if ($stmt->errno) {
                return false;
            } else {
                header("Location:index.php");
//                return true;
            }

        }
    }


}


?>