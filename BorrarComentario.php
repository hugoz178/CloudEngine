<?php 
ob_start();
require_once 'php/conexion.php';
session_start();
$camp = $_SESSION['username']; 
$id=$_GET['id'];
$elim=("DELETE FROM comentarios WHERE idCom = '$id'");

$resultado=mysqli_query($cnx,$elim);

if (!$resultado) {
	echo "<center><h1 clase='bg-dark'>No se borro con exito</h1></center>";
}else{
		header("location:softwares.php");
}
?>