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

                if (!isset($_GET['update_user'])) {


                    $sql = "SELECT * FROM user WHERE email=? ";

                    if ($stmt = $this->conn->prepare($sql)) {

                        $stmt->bind_param("s", $email);
                        $stmt->execute();
                        $stmt->store_result();

                        $rows = $stmt->num_rows();


                        if ($rows >= 1) {
                            echo "email already exists";
                        } else {
                            extract($_POST);


                            $password = md5($_POST['password']);


                            $sql = $this->conn->prepare("INSERT INTO user (fullname,email,password) VALUES (?, ?, ?)");

                            $sql->bind_param("sss", $fullname, $email, $password);

                            $sql->execute();

                            echo "insert data successfully";
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
            $pass=md5($password);

                $stmt->bind_param('ss', $email,$pass);
                $stmt->execute();
                $stmt->store_result();

                $row = $stmt->num_rows();


                if ($row >= 1) {


//                    $_SESSION['login_user_name']= $fullname;
                    $_SESSION['login_user']=$email;
                    $_SESSION['user_id']=$id;


                    setcookie('login_user_name', $row['login_user_name'], time() + (60 * 60 * 24 * 30), "/");
                    setcookie('login_user', $row['login_user'], time() + (60 * 60 * 24 * 30), "/");



                    header("location: profile.php");

                }
                else {
                    echo  "Username or Password is invalid";
                }

            }
        }

    }
    
public function reset_password(){

    if (isset($_POST['submit'])) {


        extract($_REQUEST);

        $email=$_POST['email'];

        $sql = "SELECT * FROM user WHERE email= ?";

        if ($stmt = $this->conn->prepare($sql)) {


            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->store_result();

            $row = $stmt->num_rows();


            if ($row >= 1) {

                $password = md5($password);

                $stmt = $this->conn->prepare("UPDATE user SET email = ?, password = ? WHERE email=?");

                $stmt->bind_param('sss',$email,$password,$email);
                $stmt->execute();

                echo "password changed successfully";

            } else {
                echo "email id does not matches";
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


    }


    function update()
    {

        if (isset($_POST['submit'], $_GET['update_user']) && !empty($_GET['update_user'])) {
            $id = $_GET['update_user'];

            if($_SESSION['user_id']==$_GET['update_user']){


                extract($_REQUEST);

                $password = md5($password);
                $stmt = $this->conn->prepare("UPDATE user SET fullname = ?, email = ?, password = ? WHERE id=?");

                $stmt->bind_param('sssi', $fullname, $email, $password, $id);

                $stmt->execute();

                if ($stmt->errno) {
                    return false;
                }
                else {
                    echo "record updated";

                    return true;
                }

            }

            else{
                echo "not  updated";
            }



        }


    }


}


?>