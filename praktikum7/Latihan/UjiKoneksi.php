<!DOCTYPE html>
<html>
<head>
	<title> Koneksi Database MySQL </title>
</head>
<body>
	<h1> Demo Koneksi Database MySQL </h1>
	<?php
	$conn = mysqli_connect("localhost","root","","newdb"); // Membuat koneksi database 

	// Cek koneksi
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: ". mysqli_connect_error();
		exit(); // Keluar
	}
	?>
</body>
</html>