 <?php
/**
 * Created by PhpStorm.
 * User: ajeet
 * Date: 10/31/17
 * Time: 4:09 PM
 */

include('config.php');

 class database
 {

     public $conn;


     public function __construct()
     {

         $this->conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

         if ($this->conn->connect_error) {

             die("Connection failed: " . $this->conn->connect_error);
         }
         else{
             echo "";
         }

     }
 }


 ?>

 