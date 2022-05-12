<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "newDB";

$conn = mysqli_connect($servername, $username, $password, $dbname); 

if(!$conn){
    die("connection failed: ". mysqli_connect_error());
}

//create table
$sql = "CREATE TABLE liga ( 
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    kode VARCHAR(3) NOT NULL, 
    negara VARCHAR(30) NOT NULL, 
    champion int(3))";

    if (mysqli_query($conn,$sql)){
        echo "Database Table Created Successfully";
    } else {
        echo "Error Creating Database : " .mysqli_error($conn);
    }
    mysqli_close($conn);
?>
    