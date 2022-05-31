<?php

require_once  __DIR__ . '/mysql_db.php';
require_once  __DIR__ . '/headers.php';

$remote_url = $_SERVER['REQUEST_URI'];  




$prod = new ProductDb();
// $prod->CreateProductsTable($con);

// $con находиться в mysql_db.php

switch ($remote_url){

    case "/":
        print_r("Ты на главной странице 0 _ 0");
        break;

    case "/CreateProduct":
        $prod->CreateProductsTable($con);
        break; 
    
    case "/JsonProduct":
        header("Content-Type: application/json");
        $prod->SelectAllFromProducts($con);
        break;
    
    case "/AppProduct":

        if ($_SERVER['REQUEST_METHOD'] == "POST"){   
            
            $title = $_POST["title"];
            $disc = $_POST["disc"];
            $price = $_POST["price"];
            $pathImg = $_POST["pathImg"];

            $prod->InsertProductsRecord($con,$title,$disc,$price,$pathImg);
        }else{
            print_r("Это не Post это " . $_SERVER['REQUEST_METHOD']);
        }
        break;
    

    case "/SearchProductByTitle":
        header("Content-Type: application/json");
        if ($_SERVER['REQUEST_METHOD'] == "POST"){  
             
            $title = $_POST["title"];
            $prod->SearchByTitle($con,$title);

        }else{
            print_r("Это не Post это " . $_SERVER['REQUEST_METHOD']);
        }
        break;



    default:
        print_r("404 kekw");
} 




?>