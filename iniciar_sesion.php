<?php
ob_start();
session_start();
require_once 'php/conexion.php';
include 'boot.php';
include 'loader.html';


if (!isset($_SESSION['username']) || $_SESSION['username'] == null) {
} else {
	if ($_SESSION['username'] == "hugoz178") {
		header('location:vista_admin.php');
	} else {
		header('location:vista_usuario.php');
	}
}


# Se verifica si se presiona el botón llamado iniciar-sesion
if (isset($_POST['iniciar-session'])) {
	# Se guarda el contendio de las cajas de texto en las variables $us y $ps
	$us = $_POST['usuario'];
	$ps = $_POST['password'];
	$psSha = sha1($ps);

	# Se valida que las variables no esten vacias o nulas
	if (!empty($us) &&  !empty($ps)) {
		# Query de consulta
		$query = "SELECT * from usuarios WHERE username='" . $us . "' AND password='" . $psSha . "'";

		# Asigna el registro del Query
		$registro = mysqli_query($cnx, $query);

		# Asigna los datos del registro a la variable $campo
		$campo = mysqli_fetch_array($registro);

		# Cuenta la cantidad de registros del Query
		$count = mysqli_num_rows($registro);

		# Valida que la variable count tenga un valor
		if ($count) {
			if ($campo['username'] == "hugoz178" and $campo['password'] == $psSha) {
				$_SESSION['username'] = $campo['username'];
				header("location:vista_admin.php");
			} else {
				$_SESSION['nombre'] = $campo['name'];
				$_SESSION['username'] = $campo['username'];
				header("location:vista_usuario.php");
			}
		} else {
			echo "<div class='alert alert-danger'>
			<strong>
			<center>
			<h5>Ha surgido un Error<br>Verifica las credenciales de Acceso!</h5>
			</center>
			</strong>
			</div>";
		}
	}
}
?>

<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cloud Engine</title>
	<!-- icono de la pagina -->
	<link rel="icon" href="images/cloudlogo.png">
</head>

<body style="background: -webkit-linear-gradient(left, #5D00B9, #aa63f1); background: linear-gradient(to right, #5D00B9, #aa63f1); overflow-x: hidden;">
	<br><br><br><br>
	<div class="container">
		<div class="row gx-2 justify-content-center">

			<div class="col-lg-3 col-md-12">

			</div>

			<div class="col-lg-6 col-md-6">
				<div class="p-5 text-center bg-light">
					<h1 class="display-6">Inicia sesión</h1>

					<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

					<form id="loginform" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">

						<div style="margin-bottom: 25px" class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input id="usuario" type="text" class="form-control" name="usuario" value="" placeholder="Usuario">
						</div>

						<div style="margin-bottom: 25px" class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							<input id="password" type="password" class="form-control" name="password" placeholder="Password">
						</div>

						<div style="margin-top:10px" class="form-group">
							<div class="col-sm-12 controls">
								<button name="iniciar-session" id="btn-login" type="submit" class="btn btn-success">Iniciar Sesi&oacute;n</a>
							</div>
						</div>
						<br>
						<div class="form-group">
							<div class="col-md-12 control">
								<div style="border-top: 1px solid#888; padding-top:15px; font-size:85%">
									No tiene una cuenta! <a href="registro.php">Registrate aquí</a>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>

			<div class="col-lg-3 col-md-6">

			</div>

		</div>
	</div>

</body>

</html>
<?php
ob_end_flush();
?>