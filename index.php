<?php

require_once  __DIR__ . '/mysql_db.php';
require_once  __DIR__ . '/headers.php';

$remote_url = $_SERVER['REQUEST_URI'];  




$prod = new ProductDb();
$users = new UserDb();
$Orders = new OrderDb();

// $prod->CreateProductsTable($con);
// $users->CreateUsersTable($con);
// $Orders->CreateOrderTable($con);

// $prod->InsertProductsRecord($con,"Картошка","Овощь",150,"/home/maxim");


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
            
            break;
        }
    
    case "/CreateUser":
        
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"];

            $encrypted_password = password_hash($password,PASSWORD_DEFAULT);

            $users->InsertUser($con,$username,$email,$encrypted_password);
            print_r("User created");
            

        break;
        }

    case "/IsUserAuthenticated":

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $username = $_POST["username"];
            $password = $_POST["password"];

            $users->IsUserAuthenticated($con,$username,$password);

        break;
        }

    case "/MakeOrder":


        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            
            print_r($_POST);

            


            $product_id = $_POST['product_id']  ;
            $country=$_POST['country'];
            $city=$_POST['city'];
            $streetAndHouse=$_POST['streetAndHouse'];
            
            


            $Orders->InsertOrder($con,$product_id,$country,$city,$streetAndHouse);
            

            break;
        };


        



    default:
        print_r("404 kekw");
} 




?>