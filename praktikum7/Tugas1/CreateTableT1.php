<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_tugas";

$conn = mysqli_connect($servername, $username, $password, $dbname); 

if(!$conn){
    die("connection failed: "
    . mysqli_connect_error());
}

//create table
$sql = "CREATE TABLE table_Crud (ID_BT INT(10) 
UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
NAMA VARCHAR(200) NOT NULL, 
EMAIL VARCHAR(50) NOT NULL, 
ISI TEXT)";

    if (mysqli_query($conn,$sql)){
        echo "Database Table Created Successfully";
    } else {
        echo "Error Creating Database : " 
        .mysqli_error($conn);
    }
    mysqli_close($conn);
?>
    