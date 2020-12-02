<?php

if (isset($_POST["submit"])) // check if you're a robot
{
    echo "You clicked the submit button. </br>";
}

echo " </br> ";

$okay = true; // begins validation process

if (empty($_POST['prodName']))
{
    echo "<p style ='color: red'> Please enter a product name </p> </br>" ;
    $okay = false;
}

if (empty($_POST['quantity']))
{
    echo "<p style ='color: red'> Please enter a quantity </p> </br>" ;
    $okay = false;
}

if (empty($_POST['price']))
{
    echo "<p style ='color: red'> Please enter a price </p> </br>" ;
    $okay = false;
}

echo " </br> ";

  echo "I am in process page </br>";
    // host name
    $host = "127.0.0.1";
     //user name
    $user = "root";   
    // password
    $pass = "";

    $link = mysqli_connect($host, $user, $pass);
  
    if (!$link)
    {
        echo "Error linking to server </br>".mysqli_errno($link);
    }
    else{
        echo "Connected to server </br>";
    }
  

   $createDBquery = "CREATE DATABASE IF NOT EXISTS tranc;";
    // we use mysqli_querry($link, $createDBquery )
    
    $db_result = mysqli_query($link , $createDBquery );
    if (!$db_result){
        echo "Error Database was not created </br>".mysqli_errno($link);
    }
    else{
        echo "Database created successfully </br>";
    }

mysqli_select_db($link, 'tranc');
   $createTableQuery = "CREATE TABLE IF NOT EXISTS products
   (
       prod_id INT(5) PRIMARY KEY NOT NULL AUTO_INCREMENT,
       prod_code CHAR(3),
       prod_name VARCHAR(30),
       quantity INT(100), 
       price DECIMAL(10,2)
    )";
    
    $result_tbleQuery = mysqli_query($link, $createTableQuery);
    if (!$result_tbleQuery){
        echo "Error: Table was not created </br>" . mysqli_errno($link);
    }
    else{
        echo "Table created successfully </br>";
    }

    $pname = (isset($_POST['prodName'])  ? $_POST['prodName']  : '');
    $qu    = (isset($_POST['quantity'])  ? $_POST['quantity']  : '');
    $pr    = (isset($_POST['price'])  ? $_POST['price']  : '');


    $insertQ = "INSERT INTO  products(prod_name, quantity, price)
               VALUES('$pname', '$qu', '$pr'); ";
    $insertResult = mysqli_query($link, $insertQ );
  

    echo "<h3> Here are all of the products in the inventory: " . "</h3>" ;

 $sql ="SELECT * FROM products";
    $select_result = mysqli_query($link, $sql );
    if ($select_result){
         $row = mysqli_num_rows( $select_result);
         while($row = mysqli_fetch_array($select_result))
         {
            echo "Product Name: " . $row['prod_name'] . "<br />";
            echo "Quantity: " . $row['quantity'] . "<br />";
            echo "Price: $"  .  $row['price']     . "<br />";  
            echo "<br />";   
         }
    }
    
?> 



