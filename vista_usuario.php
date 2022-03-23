<?php
ob_start();
session_start();
include("php/conexion.php");
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

<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Agenda</title>
	<!-- icono de la pagina -->
	<link rel="icon" href="images/icons/agenda.png">
	<link rel="stylesheet" href="css/style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>


</head>

<body style="overflow-x:hidden; background-color:#000000;">
	<nav class="navbar navbar-inverse" style="background-color:#000000;">
		<div class="container-fluid ">
			<div class="navbar-header">
				<div class="container-fluid mt-3">
					<button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#demo">
						<i class='fas fa-bars' style='font-size:36px; color:#5D00B9;'></i>
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
			<button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
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
				<a href="logout.php" class="btn">
					<h3 style="color:#5D00B9">Cerrar sesión</h3>
				</a>
				<?php
				$mpdc = $_SESSION['s_correo'];

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
			</div>
		</div>
	</div>


	<div class="row">
		<div class="col-md-2"> </div>
		<div class="col-md-8">
			<div class="card" style="height:900px; background-color:#000000;">
				<div class="card-body">
					<center>
						<table>
							<br>
							<tr>
								<?php
								$con = 0;
								$sql = $cnx->query("SELECT * FROM software");
								while ($row = mysqli_fetch_array($sql)) {

								?>
									<td>
										<?php echo '
														<div class="card card-cascade narrower" style="background-color:#050503;" >
												  <div class="view view-cascade overlay"">
												  <center>
												  <img src="data:image/png;base64,' . base64_encode($row['fotoSoft']) . '" class="card-img-top" alt="photo" style="width:300px; height:300px;">
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
												</div>
												';
										?>
									</td>
								<?php
									$con = $con + 1;
									if ($con == 2) {
										echo "</tr>
													<tr>";
										$con = 0;
									}
								}
								?>
							</tr>
						</table>
					</center>



				</div>
			</div>

		</div>
		<div class="col-md-2"> </div>





	</div>


	<div class="modal" id="myModal">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Escribe tu opinon</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>

				<!-- Modal body -->
				<div class="modal-body">
					<form id="form" name="form" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">



						<div class="form-group">
							<input type="text" name="asunto" placeholder="Escribe el asunto">
						</div>
						<div class="form-group">
							<textarea placeholder="Escribe tu opinon" name="opinion"></textarea>
						</div>
						<div class="form-group">
							<button id="opBtn" name="opBtn" type="submit" class="btn btn-info"><i class="icon-hand-right"></i>Enviar opinon</button>
						</div>
						<div class="form-group"></div>

					</form>
				</div>

				<!-- Modal footer -->
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
				</div>

			</div>
		</div>
	</div>




</body>

</html>

<?php
ob_end_flush();
?>