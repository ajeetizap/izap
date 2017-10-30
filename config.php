<?php

define('DB_SERVER', 'localhost');

define('DB_USERNAME', 'ajeet');

define('DB_PASSWORD', 'ajeet');

define('DB_DATABASE', 'ajeet');




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
