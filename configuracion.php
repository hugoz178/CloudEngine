<?php
session_start();
ob_start();
include 'php/conexion.php';
$camp = $_SESSION['username'];
include 'boot.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>

	<h1><?php echo $camp ?></h1>


</body>
</html>