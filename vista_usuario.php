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
?>

<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Cloud Engine</title>
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
			<button type="button" class="btn-close" data-bs-dismiss="offcanvas" style='color:#5D00B9;'></button>
		</div>
		<div class="offcanvas-body">
			<div class="btn-group-vertical" style="width:280px">
				<a href="misjuegos.php" class="btn">
					<h3 style="color:#5D00B9">Mis juegos</h3>
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

	<?php

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
				      <p><small>Puedes cerrar esta pestañita</small></p>
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
				      <p><small>Puedes cerrar esta pestañita</small></p>
				    </div>
				  </div>
				  ";
		}
	}

	?>


	<div class="container">
		<div class="row gx-3 justify-content-center">
			<div class="col-lg-1 col-md-12"></div>

			<div class="col-lg-10 col-md-6">
				<table>
					<br>
					<tr>
						<?php
						$con = 0;
						$sql3 = $cnx->query("SELECT * FROM software");
						while ($row = mysqli_fetch_array($sql3)) {

						?>
							<td>
								<?php echo '
										<div class="card card-cascade narrower" style="background-color:#050503" >
										  <div class="view view-cascade overlay"">
										    <center>
											  <img src="' . $row['fotoSoft'] . '" class="card-img-top" alt="photo" style="width:300px; height:300px;">
										    </center>
												<a>
												    <div class="mask rgba-white-slight"></div>
												</a>
										   </div>
												<div class="card-body card-body-cascade">
												    <h5 class="text-white pb-2 pt-1"><i class="fas fa-shopping-bag"></i>  ' . $row['categoriaSoft'] . '</h5>
												    <h4 class="font-weight-bold card-title text-white">' . $row['nombreSoft'] . '</h4>
												    <p class="card-text text-white">' . $row['descripcionSoft'] . '</p>
												    <a class="btn btn-secondary" style="background-color:#5D00B9" href="infsoftware.php?id=' . $row['idSoft'] . '">Obervar Software</a>
												  </div>
												</div>&nbsp';
								?>
							</td>
						<?php
							$con = $con + 1;
							if ($con == 3) {
								echo "</tr>
													<tr>";
								$con = 0;
							}
						}
						?>
					</tr>
				</table>
			</div>

			<div class="col-lg-1 col-md-6"></div>
		</div>
	</div>
	<br><br>

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