<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "EmployeesDB";

$conn = mysqli_connect($servername, $username, $password, $dbname); 

if(!$conn){
    die("connection failed: ". mysqli_connect_error());
}

//create table
$sql = "CREATE TABLE employee (Id_Emp INT(10) 
UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
Name_Emp VARCHAR(200) NOT NULL, 
Email_emp VARCHAR(50) NOT NULL, 
Address_Emp VARCHAR(150) NOT NULL,
salary_emp INT(50) NOT NULL, 
stat VARCHAR(15) NOT NULL)";

    if (mysqli_query($conn,$sql)){
        echo "Database Table Created Successfully";
    } else {
        echo "Error Creating Database : " .mysqli_error($conn);
    }
    mysqli_close($conn);
?>
    