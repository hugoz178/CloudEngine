<?php
session_start();
require_once 'php/conexion.php';

$camp = $_SESSION['username'];
$saldo=$_POST['saldo'];


$insertar=("INSERT into saldo (saldo,usuario) values('$saldo','$camp')");
$resultado=mysqli_query($cnx,$insertar);

if ($resultado) {
  header("Location:saldo.php?correcto=1");
}else
{
	header("Location:ag_saldo.php?error=1");
}
?>