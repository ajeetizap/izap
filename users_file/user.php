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


            $sql = "SELECT fullname,email,password,id FROM user WHERE email= ? AND password=?";

            if ($stmt = $this->conn->prepare($sql)) {
                extract($_POST);

                $pass=md5($_POST['password']);

                $stmt->bind_param('ss', $email,$pass);
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($fullname,$email,$password,$id);
                $stmt->fetch();

                $row = $stmt->num_rows();


                if ($row >= 1) {


                    $_SESSION['login_user']=$email;
                    $_SESSION['user_id']=$id;


                    setcookie('login_user', $row['login_user'], time() + (60 * 60 * 24 * 30), "/");
                    setcookie('user_id', $row['user_id'], time() + (60 * 60 * 24 * 30), "/");



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


        extract($_POST);

        $email=$_POST['email'];

        $sql = "SELECT * FROM user WHERE email= ?";

        if ($stmt = $this->conn->prepare($sql)) {


            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->store_result();

            $row = $stmt->num_rows();


            if ($row >= 1) {

//                $selector = bin2hex(random_bytes(8));
                $token = random_bytes(16);
                $token = md5($token);

                $stmt = $this->conn->prepare("UPDATE user SET token = ? WHERE email= ?");
                $stmt->bind_param("ss",$token,$email);
                $stmt->execute();


                require("PHPMailer_5.2.4/class.phpmailer.php");


                $mail = new PHPMailer;

                $mail->SMTPDebug = 1;
                $mail->isSMTP();
                $mail->Host = "smtp.gmail.com";
                $mail->SMTPAuth = true;
                $mail->Username = 'kishor@izap.in';
                $mail->Password = 'kishore001';
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;
                $mail->setFrom("kishor@izap.in") ;

                $mail->addAddress('ajeet.kumar@izap.in');

                $mail->addReplyTo('kishor@izap.in');
                $mail->isHTML(true);
                $mail->Subject = 'Here is the subject';
                $mail->Body    = 'This is the HTML message body <b>in bold!</b>
                            <p>click here http://localhost:9090/mail_verify.php?'.http_build_query(['token' => $token,]); '</p>';

                if($mail->Send()) {
                    echo "Message sent!";
                } else {
                    echo "Mailer Error: " . $mail->ErrorInfo;
                }



            } else {
                echo "email id does not matches";
            }

        }

    }

}


function mail_verify(){

    if(isset($_GET['token'])) {

        $mailtoken=$_GET['token'];

        if (isset($_POST['submit'])) {

            $password = md5($_POST['password']);

            $stmt = $this->conn->prepare("UPDATE user SET password = ? WHERE token=?");

            $stmt->bind_param('ss', $password, $mailtoken);

            $result = $stmt->execute();

            if ($result == true) {
                echo "password changed successfully";
            }
            else {
                echo "password does not changed";
            }

        }


    }

}



function password_update(){
    $password = md5($_POST['password']);

    $stmt = $this->conn->prepare("UPDATE user SET password = ? WHERE token=?");

    $stmt->bind_param('sss', $password, $token);
    $stmt->execute();

    echo "password changed successfully";
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


    public function delete()
    {



        extract($_POST);

        if (isset($_GET['delete_user'])) {
            $id = $_GET['delete_user'];


            if ($_SESSION['user_id'] == $id) {

                $query = "DELETE FROM user WHERE id = ?";

                $sql = $this->conn->prepare($query);

                $sql->bind_param("i", $id);


                if ($sql->execute()) {


                    echo "Record deleted successfully";


                } else {
                    echo "Error deleting record: " . $this->conn->error;
                }


            }
        }




    }


    function update()
    {

        if (isset($_POST['submit'], $_GET['update_user']) && !empty($_GET['update_user'])) {
            $id = $_GET['update_user'];


             if($_SESSION['user_id']==$id){
                 extract($_POST);

            $stmt = $this->conn->prepare("UPDATE user SET fullname = ?, email = ? WHERE id=?");

            $stmt->bind_param('ssi', $fullname, $email, $id);

            $stmt->execute();

                /* print_r($stmt);
                 exit();*/

            if ($stmt) {
                echo "record updated";
            }
            else {
                return false;
            }


            }

            else{
                echo "not  updated";
            }
        }



    }


}


?>