<!DOCTYPE html>
<html>
<head>
	<title>Akses databse MySql PHP</title>
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "newDB";

$conn = mysqli_connect($servername, $username, $password, $dbname); 

if(!$conn){
    die("connection failed: ". mysqli_connect_error());
}

$sql = "SELECT kode, negara, champion FROM liga";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result)>0){
	while ($row = mysqli_fetch_assoc($result)) {
		echo "kode : " . $row["kode"]. "<br> negara : " . $row["negara"] . "<br>champion : " . $row["champion"] . "<br>";
	}
}else {
	echo "Zero Result";
}
mysqli_close($conn);
?>

	
</body>
</html>