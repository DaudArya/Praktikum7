<?php
$servername = "localhost";
$username = "root";
$password = "";


$conn = mysqli_connect($servername, $username, $password);
//check connection
if (!$conn) {
	die("connection failed: " . mysqli_connect_error());
}

$sql = "CREATE DATABASE EmployeesDB";
if(mysqli_query($conn, $sql)) {
    echo "database create successfully";
}else{
    echo "Error Creating Database: ".mysqli_error($conn);
}

mysqli_close($conn);

?>