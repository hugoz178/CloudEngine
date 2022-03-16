<?php
	session_start();
	//con este se destruye la sesión 
	session_destroy();
	header("location:index.php");
?>