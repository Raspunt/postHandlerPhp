<?php

$con = new mysqli('127.0.0.1','root','qaqsqdqe','garden_today');

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 


class ProductDb{


    function CreateProductsTable($db){


        $sql = "
            CREATE TABLE IF NOT EXISTS products (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(100) NOT NULL,
                disc VARCHAR(500) NOT NULL,
                price INT NOT NULL,
                pathImg VARCHAR(100) NOT NULL
                ) 
                
            ";

    $db->query($sql);

    }


    function SelectAllFromProducts($db){


        $sql ="
            SELECT * FROM products;
        ";



        if ($res = $db->query($sql)) {
            $rows = $res->fetch_all(MYSQLI_ASSOC);
            echo json_encode($rows);
        } else {
            echo $con->error;
        }

    }


    function InsertProductsRecord($db,$title,$disc,$price,$pathImg){


        $sql = "
            INSERT INTO products (title,disc,price,pathImg)
            VALUES ('$title','$disc','$price','$pathImg');
        ";

        if ($db->query($sql) === TRUE) {
            // echo "Record created successfully";
        } else {
            echo $db->error;
        }


    }


    function SearchByTitle($db,$title){

    $sql = "
        SELECT * FROM products WHERE title LIKE '$title%';
    ";
    // print_r($sql);

        $result = $db->query($sql);

        $rows = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($rows);
    
  
    }

     


}


class UserDb{

    function CreateUsersTable($db){


        $sql = "
            CREATE TABLE IF NOT EXISTS user (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(100) NOT NULL,
                email VARCHAR(200) NOT NULL,
                password VARCHAR(200) NOT NULL
                ) 
            ";

    $db->query($sql);

    }


}



// SelectAllFromProducts($con);
// InsertProductsRecord($con,"morkov","овощь как овощь","/home/maxim/justPhp/postHandler");
