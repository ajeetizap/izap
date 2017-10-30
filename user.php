<?php
        include "config.php";



        class User extends database
        {


            public function insert_user()
            {


                if (isset($_GET['update'])) {
                    $id = $_GET['update'];
//                    $id = $this->conn->insert_id;
//                    header("Location:index.php");

                    extract($_POST);

                    $sql = $this->conn->prepare("INSERT INTO items (name,price,quantity,item_code,description,id) VALUES (?, ?, ?, ?, ?,?)");

                    $sql->bind_param("siissi", $name, $price, $quantity, $item_code, $description, $id);

                    $sql->execute();

                }


            }


            public function fetchdata($id = 0)

            {

                if ($id == 0) {
                    $sql = "select * from items";

                    $result = $this->conn->query($sql) or die($this->conn->connect_error . "Data cannot inserted");
                    return $result;

                } else {

                    $query = $this->conn->prepare("SELECT name,price,quantity,item_code,description FROM items WHERE id=?");

                    $query->bind_param("i", $id);
                    $query->execute();

                    $query->bind_result($name, $price, $quantity, $item_code, $description);

                    $query->fetch();

                    return ['name' => $name, 'price' => $price, 'quantity' => $quantity, 'item_code' => $item_code, 'description' => $description];


                }

            }


            public function delete($id, $table)
            {

                $query = "DELETE FROM $table WHERE id = ?";

                $sql = $this->conn->prepare($query);

                $sql->bind_param("i", $id);


                if ($sql->execute()) {

                    header("Location:index.php");

                } else {
                    echo "Error deleting record: " . $this->conn->error;
                }

                if ($sql == false) {
                    echo 'Error: cannot delete id ' . $id . ' from table ' . $table;
                    return false;
                } else {
                    return true;
                }


            }


            function update()
            {

                if (isset($_GET['update'])) {
                    $id = $_GET['update'];

                   // header("Location:index.php");


                    extract($_REQUEST);
                    $stmt = $this->conn->prepare("UPDATE items SET name = ?, price = ?, quantity = ?, item_code = ?, description = ? WHERE id=?");

                    $stmt->bind_param('siissi', $name, $price, $quantity, $item_code, $description, $id);

                    $stmt->execute();

                    if ($stmt->errno) {
                        return false;
                    } else {
                        return true;
                    }


                }

            }

        }


?>