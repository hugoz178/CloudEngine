<?php
	ob_start();
	session_start();
	$camp = $_SESSION['username'];
	include 'php/conexion.php';

	$deleteUS = "DELETE FROM usuarios WHERE username = '$camp';";
	$deleteFO = "DELETE FROM fotousuarios WHERE username = '$camp';";
	$deleteCO = "DELETE FROM comentarios WHERE username = '$camp';";
	$deleteOP = "DELETE FROM opiniones WHERE username = '$camp';";

	$okUS = mysqli_query($cnx,$deleteUS);
	$okFO = mysqli_query($cnx,$deleteFO);
	$okCO = mysqli_query($cnx,$deleteCO);
	$okOP = mysqli_query($cnx,$deleteOP);

	$completo = $okUS.$okFO.$okCO.$okOP;

	if ($completo) {
		session_destroy();
		header("location:index.php");
	}else{
		echo 'error';
	}

