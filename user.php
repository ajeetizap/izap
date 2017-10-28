<?php
        include "config.php";



        class User extends database
        {


            public function insert_user($name, $price, $quantity, $item_code, $description)
            {

                $item_code = md5($item_code);

               /*  $sql = $this->conn->prepare("SELECT * FROM items WHERE item_code=?");

                 $sql->bind_param("s", $item_code);

                 $check = $this->query($sql);

                 $data = $this->conn->query($check, MYSQLI_NUM);

                 if ($data[0] > 1) {
                     echo "User Already in Exists<br/>";

                 }
                else {*/
                    $sql = $this->conn->prepare("INSERT INTO items (name,price,quantity,item_code,description) VALUES (?, ?, ?, ?, ?)");

                    $sql->bind_param("siiss", $name, $price, $quantity, $item_code, $description);

                    $sql->execute();

                /*}

                if ($this->conn->query($sql)) {

                    echo "You are now registered<br/>";
                }
                else {
                    echo "Error adding user in database<br/>";
                }*/

            }


            public function fetchdata($id=0)

            {

                if($id==0) {
                    $sql = "select * from items";

                    $result = $this->conn->query($sql) or die($this->conn->connect_error . "Data cannot inserted");
                    return $result;

                }
                else{
                    $query=$this->conn->prepare("SELECT name,price,quantity,item_code,description FROM items WHERE id=?");

                    $query->bind_param("i",$id);
                    $query->execute();

                    $query->bind_result($name,$price,$quantity,$item_code,$description);

                    $query->fetch();

                    return ['name'=>$name,'price'=>$price,'quantity'=>$quantity,'item_code'=>$item_code,'description'=>$description];




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
                    return true;
                }

//                $this->conn->close();
            }








            function update($name,$price,$quantity,$item_code,$description,$id)
            {


                $stmt = $this->conn->prepare("UPDATE items SET name = ?, price = ?, quantity = ?, item_code = ?, description = ? WHERE id=?");

                $stmt->bind_param('siissi',$name, $price, $quantity, $item_code, $description, $id);

                $stmt->execute();

                if ($stmt->errno) {
                    return false;
                }
                else {
                    return true;
                }

            }


        }


?>