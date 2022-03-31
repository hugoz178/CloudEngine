<?php
ob_start();
session_start();
include("php/conexion.php");
include 'loader.html';
include 'boot.php';

if (!isset($_SESSION['username']) || $_SESSION['username'] == null) {
} else {
	if ($_SESSION['username'] == "hugoz178") {
		header('location:vista_admin.php');
	} else {
		header('location:vista_usuario.php');
	}
}
if (isset($_POST['regBtn'])) {
	$user = $_POST['username'];
	$mail = $_POST['email'];
	$cel = $_POST['celular'];
	$psw = $_POST['password'];
	$encriptsha = sha1($psw);

	$registrar = "INSERT INTO usuarios (username,email,celular,password)
	VALUES ('$user','$mail','$cel','$encriptsha');";

	$listo = mysqli_query($cnx, $registrar);

	if ($listo) {
		header("Location:iniciar_sesion.php");
	} else {
		echo 'error';
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cloud Engine</title>

	<!-- icono de la pagina -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="//oss.maxcdn.com/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"></script>
</head>

<body style="background: -webkit-linear-gradient(left, #5D00B9, #aa63f1); background: linear-gradient(to right, #5D00B9, #aa63f1); overflow-x: hidden;">
	<br><br><br><br>
	<div class="container">
		<div class="row gx-2 justify-content-center">

			<div class="col-lg-3 col-md-12">

			</div>

			<div class="col-lg-6 col-md-6">
				<div class="p-5 text-center bg-light">
					<h1 class="display-6">Reg&iacute;strate</h1>
					<div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="iniciar_sesion.php">Iniciar Sesi&oacute;n</a></div>

					<form id="form" name="form" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">

						<div class="form-group">
							<br>
							<label for="username" class="col-md-3 control-label">Usuario</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="username" placeholder="Usuario">
							</div>
						</div>

						<div class="form-group">
							<label for="email" class="col-md-3 control-label">Email</label>
							<div class="col-md-9">
								<input type="email" class="form-control" name="email" placeholder="Email">
							</div>
						</div>

						<div class="form-group">
							<label for="nombre" class="col-md-3 control-label">Numero de telefono:</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="celular" placeholder="Numero de telefono">
							</div>
						</div>

						<div class="form-group">
							<label for="password" class="col-md-3 control-label">Password</label>
							<div class="col-md-9">
								<input type="password" class="form-control" name="password" placeholder="Password">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-offset-3 col-md-9">
								<button id="regBtn" name="regBtn" type="submit" class="btn btn-info"><i class="icon-hand-right"></i>Registrar</button>
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


<script type="text/javascript">
	//java

	$("#form").bootstrapValidator({

		feedbackIcons: {

			valid: 'glyphicon glyphicon-ok',

			invalid: 'glyphicon glyphicon-remove',

			validating: 'glyphicon glyphicon-refresh'

		},

		fields: {

			username: {

				validators: {

					notEmpty: {

						message: 'Debes ingresar tu nombre de usuario.'

					},

					stringLength: {

						min: 5,

						max: 15,

						message: 'Tu nombre de usuario debe de tener por lo menos 5 caracteres de longitud y 10 como máximo.'

					}

				}

			},



			email: {

				validators: {

					emailAddress: {

						message: 'El correo electrónico debe ser válido.'

					},

					notEmpty: {

						message: 'Ingresa tu correo electrónico.'

					}

				}

			},

			celular: {

				message: 'Ingrese Su Número De Celular',

				validators: {

					notEmpty: {

						message: 'Ingrese Su Número De Celular'
					},

					regexp: {

						regexp: /^[0-9]+$/,

						message: 'El Número de Celular Solo Puede Contener Digitos'
					},

					stringLength: {

						min: 10,

						max: 10,

						message: 'Tu numero debe ser de 10 digitos'

					}

				}


			},


			password: {

				validators: {

					notEmpty: {

						message: 'Debes ingresar una contraseña.'

					},

					stringLength: {

						min: 5,
						max: 25,

						message: 'Maximo 5 caracteres y maximo 25.\n'

					}

				}

			}


		}

	});
</script>