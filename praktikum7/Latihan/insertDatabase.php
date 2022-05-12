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
$sql = "INSERT INTO liga (kode, negara, champion) VALUES ('jer', 'Jerman', '5')";

    if (mysqli_query($conn,$sql)){
        echo "New Record Created Successfully";
    } else {
        echo "Error : ". $sql . "<br>" .mysqli_error($conn);
    }
    mysqli_close($conn);
?>