<?php
ob_start();
include 'php/conexion.php';
session_start();
$camp = $_SESSION['username'];

$nomS=$_REQUEST["nombreSoft"];
$desS=$_REQUEST["descripcionSoft"];
$cosS=$_REQUEST["costoSoft"];
$catS=$_REQUEST["categoriaSoft"];

$insertar=("INSERT into software (nombreSoft, descripcionSoft,costoSoft, categoriaSoft,username) values('$nomS','$desS','$cosS','$catS','$camp')");
$resultado=mysqli_query($cnx,$insertar);

if (!$resultado) {
  echo "<br><br>Error al registrar,intenta de nuevo";
  
  echo "<br><a href='añadir.php'>Regresar</a>";
}else
{
	header("Location:softwares.php");
}
?>