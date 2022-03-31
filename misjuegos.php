<?php
ob_start();
session_start();
error_reporting(0);
include("php/conexion.php");
include 'boot.php';
include 'loader.html';
$camp = $_SESSION['username'];

if ($camp == null || $camp == '' || $camp == 'hugoz178') {
	session_destroy();
	header("location:index.php");
	die();
}


if (isset($_POST['opBtn'])) {

	$as = $_POST['asunto'];
	$op = $_POST['opinion'];

	$registrar = "INSERT INTO opiniones (username,asunto,opinion)
	VALUES ('$camp','$as','$op');";

	$listo = mysqli_query($cnx, $registrar);

	if ($listo) {
		echo "
				  <div class='toast show' style='width:100%'>
				    <div class='toast-header'>
				      <strong class='me-auto'>Formulario enviado!!</strong>
				      <button type='button' class='btn-close' data-bs-dismiss='toast'></button>
				    </div>
				    <div class='toast-body'>
				      <p>Gracias por contactar con nosotros. Tu opinión nos interesa.</p>
				      <p><small>Puedes cerrar esta pestaña</small></p>
				    </div>
				  </div>
				  ";
	} else {
		echo "
				  <div class='toast show' style='width:100%'>
				    <div class='toast-header'>
				      <strong class='me-auto'>Error al enviar</strong>
				      <button type='button' class='btn-close' data-bs-dismiss='toast'></button>
				    </div>
				    <div class='toast-body'>
				      <p>Upss! Parece que hubo un error al enviar el formulario. Intentalo mas tarde</p>
				      <p><small>Puedes cerrar esta pestaña</small></p>
				    </div>
				  </div>
				  ";
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- icono de la pagina -->
	<link rel="stylesheet" href="css/estilo.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="//oss.maxcdn.com/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"></script>



</head>

<body style="overflow-x:hidden;">
	<nav class="navbar navbar-inverse" style="background-color:#000000;">
		<div class="container-fluid ">
			<div class="navbar-header">
				<div class="container-fluid mt-3">
					<button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#demo">
						<i class="material-icons" style="font-size:48px;color:#5D00B9">dehaze</i>
					</button>
				</div>
			</div>
			<ul class="nav navbar-nav">
				<h1 style="color:#5D00B9">CloudEngine</h1>
			</ul>
		</div>
	</nav>

	<div class="offcanvas offcanvas-start" id="demo" style="background-color:#050503">
		<div class="offcanvas-header">
			<center>
				<h2 class="offcanvas-title text-white" style="text-align: center;">Usuario: <?php echo $_SESSION['username'] ?></h2>
			</center>
			<a type="button" class="btn-close" data-bs-dismiss="offcanvas" style='color:#ffffff;'><i class="fas fa-times fa-2x"></i></a>
		</div>
		<div class="offcanvas-body">
			<div class="btn-group-vertical" style="width:280px">
				<a href="vista_usuario.php" class="btn">
					<h3 style="color:#5D00B9">Inicio</h3>
				</a><br>
				<a href="ver_carrito.php" class="btn">
					<h3 style="color:#5D00B9">Mi carrito</h3>
				</a><br>
				<a type="button" class="btn">
					<h3 style="color:#5D00B9" data-bs-toggle="modal" data-bs-target="#myModal">Contactanos</h3>
				</a><br>
				<a href="configuracion.php" class="btn">
					<h3 style="color:#5D00B9">Configuración</h3>
				</a><br>
				<?php
				$sql = ("SELECT * FROM saldo where usuario='$camp'");
				$result = mysqli_query($cnx, $sql);
				while ($res = mysqli_fetch_array($result)) {
					$saldo = $res['saldo'];
				}
				if ($saldo == 0) {
					echo '
					<a href="saldo.php" class="btn">
					<h3 style="color:#5D00B9">Agregar saldo</h3>
					<h3 style="color:#5D00B9"><i class="fas fa-plus"><span class="counter"> $ 0</span></i></h3>
					</a>';
				} else {
					$sql2 = $cnx->query("SELECT * FROM saldo where usuario='$camp'");
					while ($row1 = mysqli_fetch_array($sql2)) {
						echo '
						<a href="saldo.php" class="btn">
						<h3 style="color:#5D00B9">Agregar saldo</h3>
						<h3 style="color:#5D00B9"><i class="fas fa-plus"><span class="counter"> $ ' . $row1['saldo'] . '</span></i></h3>
						</a>';
					}
				}
				?>
				<br><br><br>
				<a href="logout.php" class="btn">
					<h3 style="color:#5D00B9">Cerrar sesión</h3>
				</a>
			</div>
		</div>
	</div>

	<div class="d-none d-lg-block">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-2 col-md-12">
				</div>

				<div class="col-lg-8 col-md-6">
					<section>
						<!--for demo wrap-->
						<h1 style="font-size: 30px; color: #fff; text-transform: uppercase; font-weight: 300; text-align: center; margin-bottom: 15px;">Tus productos</h1>
						<div class="tbl-header">
							<table cellpadding="0" cellspacing="0" border="0">
								<thead>
									<tr>
										<th>Foto</th>
										<th>Nombre</th>
										<th>Descripcion</th>
										<th>categoria</th>
										<th>precio</th>
										<th>Ver Producto</th>
									</tr>
								</thead>
							</table>
						</div>
						<div class="tbl-content">
							<table cellpadding="0" cellspacing="0" border="0">
								<tbody>
									<?php
									$sql3 = $cnx->query("SELECT * FROM compras WHERE usuario='$camp'");
									while ($row = mysqli_fetch_array($sql3)) {
										echo '
                                        <tr>
                                        <td> <img src="' . $row['fotoSoft'] . '" width="50px" heigth="50px"></td>
                                        <td>' . $row['nombreSoft'] . '</td>
                                        <td>' . $row['descripcionSoft'] . '</td>
                                        <td>' . $row['categoriaSoft'] . '</td>
                                        <td>$' . $row['costoSoft'] . '</td>
                                        <td><a type="button" class="btn btn-success" href="infsoftware.php?id=' . $row['idS'] . '"><i class="fas fa-angle-double-right"></i></a></td>
                                        </tr>
                                        ';
									} ?>
								</tbody>
							</table>
						</div>
					</section>
				</div>

				<div class="col-lg-2 col-md-6">

				</div>
			</div>
		</div>
	</div>
	<div class="d-lg-none">
		<section>
			<!--for demo wrap-->
			<h1 style="font-size: 30px; color: #fff; text-transform: uppercase; font-weight: 300; text-align: center; margin-bottom: 15px;">Tus productos</h1>
			<div class="tbl-header">
				<table cellpadding="0" cellspacing="0" border="0">
					<thead>
						<tr>
							<th>Foto</th>
							<th>Nombre</th>
							<th>precio</th>
							<th>Ver</th>
						</tr>
					</thead>
				</table>
			</div>
			<div class="tbl-content">
				<table cellpadding="0" cellspacing="0" border="0">
					<tbody>
						<?php
						$sql3 = $cnx->query("SELECT * FROM compras WHERE usuario='$camp'");
						while ($row = mysqli_fetch_array($sql3)) {
							echo '
                                        <tr>
                                        <td> <img src="' . $row['fotoSoft'] . '" width="50px" heigth="50px"></td>
                                        <td>' . $row['nombreSoft'] . '</td>
                                        <td>$' . $row['costoSoft'] . '</td>
                                        <td><a type="button" class="btn btn-success" href="infsoftware.php?id=' . $row['idS'] . '"><i class="fas fa-angle-double-right"></i></a></td>
                                        </tr>
                                        ';
						} ?>
					</tbody>
				</table>
			</div>
		</section>
	</div>







	<div class="modal" id="myModal">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Escribe tu opinon</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>

				<!-- Modal body -->
				<div class="modal-body">
					<center>
						<form id="form" name="form" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">

							<div class="form-group">
								<label for="usuario" class="col-md-3 control-label">Asunto del mensaje</label>
								<div class="col-md-11">
									<input type="text" name="asunto" id="asunto" placeholder="Escribe el asunto">
								</div>
							</div>
							<div class="form-group">
								<label for="usuario" class="col-md-3 control-label">Opinion</label>
								<div class="col-md-11">
									<textarea cols="40" rows="5" placeholder="Escribe tu opinon" name="opinion" id="opinion"></textarea>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-offset-3 col-md-10">
									<br>
									<button id="opBtn" name="opBtn" type="submit" class="btn btn-info"><i class="icon-hand-right"></i>Enviar opinon</button>
								</div>
							</div>
						</form>
					</center>

				</div>

				<!-- Modal footer -->
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
				</div>

			</div>
		</div>
	</div>

	<script src="funcion.js"></script>

	<script type="text/javascript">
		//java

		$("#form").bootstrapValidator({

			feedbackIcons: {

				valid: 'glyphicon glyphicon-ok',

				invalid: 'glyphicon glyphicon-remove',

				validating: 'glyphicon glyphicon-refresh'

			},

			fields: {

				asunto: {

					validators: {

						notEmpty: {

							message: 'Debes de escribir el asunto de tu solicitud'

						},

						stringLength: {

							min: 5,

							max: 20,

							message: 'Unicamente se permite 20 caracteres como maximo y un minimo de 5'

						}

					}

				},



				opinion: {

					validators: {

						notEmpty: {

							message: 'Debes de introducir una opinion'

						},

						stringLength: {

							min: 10,

							max: 50,

							message: 'Unicamente se permite 50 caracteres como maximo y un minimo de 10'

						}

					}

				}

			}

		});
	</script>


</body>

</html>

<?php
ob_end_flush();
?>