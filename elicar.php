<?php 
session_start();
require_once 'php/conexion.php';

$camp = $_SESSION['username'];

$id=$_GET['id'];
$elim=("DELETE FROM carrito WHERE idS = '$id'");

$resultado=mysqli_query($cnx,$elim);

if (!$resultado) {
	echo "<center><h1 clase='bg-dark'>No se borro con exito</h1></center>";
}else{
		header("location:ver_carrito.php");
}
?>