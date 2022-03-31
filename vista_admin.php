<?php
ob_start();
session_start();
$campo = $_SESSION['username'];
require_once 'php/conexion.php';
include 'boot.php';
if ($campo == null || $campo == '' || $campo !== 'hugoz178') {
	session_destroy();
	header("location:index.php");
	die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0">
	<title>Cloud Engine</title>
</head>

<body style="overflow-x:hidden;">
	<?php include 'loader.html'; ?>

	<nav class="navbar navbar-inverse" style="background-color:black;">
		<div class="container-fluid ">
			<div class="navbar-header">
				<button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#demo">
					<i class="material-icons" style="font-size:48px;color:#5D00B9">dehaze</i>
				</button>
			</div>
			<ul class="nav navbar-nav">
				<h1 style="color:#5D00B9">CloudEngine</h1>
			</ul>

		</div>
	</nav>

	<div class="offcanvas offcanvas-start" id="demo" style="background-color:#050503">
		<div class="offcanvas-header">
			<center>
				<h2 class="offcanvas-title text-white" style="text-align: center;">Usuario: <?php echo $campo ?></h2>
			</center>
			<<a type="button" class="btn-close" data-bs-dismiss="offcanvas" style='color:#ffffff;'><i class="fas fa-times fa-2x"></i></a>
		</div>
		<div class="offcanvas-body">
			<div class="btn-group-vertical" style="width:280px">
				<a href="softwares.php" class="btn">
					<h2 style="color:#5D00B9">Añadir softwares</h2>
				</a><br>
				<a href="configuracion.php" class="btn">
					<h2 style="color:#5D00B9">Configuración</h2>
				</a><br>
				<a href="logout.php" class="btn">
					<h2 style="color:#5D00B9">Cerrar sesión</h2>
				</a>
			</div>
		</div>
	</div>

	<div class="d-none d-lg-block">
		<div class="container">
			<div class="row gx-2 justify-content-center">
				<div class="col-md-3">
					<div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="position: absolute; top: 50%; transform: translate(0, -50%);">
						<a class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fas fa-shopping-bag"></i> Productos</a>
						<a class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false"><i class="fas fa-lightbulb"></i> Opiniones</a>
						<a class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false"><i class="fas fa-comment"></i> Mensages</a>
					</div>
				</div>

				<div class="col-md-9">
					<div class="tab-content" id="v-pills-tabContent">
						<div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
							<div id="Layer1" style="width:100%; height:550px; overflow: auto; border: 1px solid #ffffff;">
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
												  <img src="' . $row['fotoSoft'] . '" class="card-img-top" alt="photo" style="width:200px; height:200px;">
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
												</div>';
													?>
												</td>
											<?php
												$con = $con + 1;
												if ($con == 4) {
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
						<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
							<div id="Layer1" style="width:100%; height:550px; overflow: auto; border: 1px solid #ffffff;">
								<center>
									<table>
										<br>
										<tr>
											<?php
											$con = 0;
											$consCS = $cnx->query("SELECT * FROM comentarios ORDER BY idCom desc");
											while ($verCS = mysqli_fetch_array($consCS)) {
											?>
												<td>
													<?php echo '
													<div class="card" style="width:250px; border: 1px solid #5D00B9">
													<div class="card-body">
														<h5 class="card-title">' . $verCS['username'] . ' </h5>
														<p class=""><small>' . $verCS['fechaCom'] . ' ' . $verCS['hora'] . '</small></p>
														<p class="">' . $verCS['comSoft'] . '</p>
													</div>
												</div>';
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
								</center>
							</div>
						</div>
						<div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
							<div id="Layer1" style="width:100%; height:550px; overflow: auto; border: 1px solid #ffffff;">
								<center>
									<table>
										<br>
										<tr>
											<?php
											$con = 0;
											$consOP = $cnx->query("SELECT * FROM opiniones");
											while ($verOP = mysqli_fetch_array($consOP)) {
											?>
												<td>
													<?php echo '
													<div class="card" style="width:200px; border: 1px solid #5D00B9">
													<div class="card-body">
														<h5 class="card-title">Usuario: ' . $verOP['username'] . '</h5>
														<p class=""><small> El asunto es: ' . $verOP['asunto'] . '</small></p>	
														<p class=""><small>Esta es su opinión: ' . $verOP['opinion'] . '</small><p><br>	
													  </div>
												  </div>';
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
								</center>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="d-lg-none">
		<div class="container">
			<div class="row gx-3 ">
				<div class="col-md-6">
					<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
						<li class="nav-item" role="presentation">
							<a class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fas fa-shopping-bag"></i> Productos</a>
						</li>
						<li class="nav-item" role="presentation">
							<a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="fas fa-lightbulb"></i> Opiniones</a>
						</li>
						<li class="nav-item" role="presentation">
							<a class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false"><i class="fas fa-comment"></i> Mensages</a>
						</li>
					</ul>
				</div>

				<div class="col-md-6">
					<div class="tab-content" id="pills-tabContent">
						<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
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
													<div class="card card-cascade narrower" style="background-color:#050503" >
												  <div class="view view-cascade overlay"">
												  <center>
												  <img src="' . $row['fotoSoft'] . '" class="card-img-top" alt="photo" style="width:250px; height:250px;">
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
												</div>';
												?>
											</td>
										<?php
											$con = $con + 1;
											if ($con == 1) {
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
						<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
							<center>
								<table>
									<br>
									<tr>
										<?php
										$con = 0;
										$consCS = $cnx->query("SELECT * FROM comentarios ORDER BY idCom desc");
										while ($verCS = mysqli_fetch_array($consCS)) {
										?>
											<td>
												<?php echo '
													<div class="card" style="width:250px; border: 1px solid #5D00B9">
													<div class="card-body">
														<h5 class="card-title">' . $verCS['username'] . ' </h5>
														<p class=""><small>' . $verCS['fechaCom'] . ' ' . $verCS['hora'] . '</small></p>
														<p class="">' . $verCS['comSoft'] . '</p>
													</div>
												</div>';
												?>
											</td>
										<?php
											$con = $con + 1;
											if ($con == 1) {
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
						<div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
							<center>
								<table>
									<br>
									<tr>
										<?php
										$con = 0;
										$consOP = $cnx->query("SELECT * FROM opiniones");
										while ($verOP = mysqli_fetch_array($consOP)) {
										?>
											<td>
												<?php echo '
													<div class="card" style="width:200px; border: 1px solid #5D00B9">
													<div class="card-body">
														<h5 class="card-title">Usuario: ' . $verOP['username'] . '</h5>
														<p class=""><small> El asunto es: ' . $verOP['asunto'] . '</small></p>	
														<p class=""><small>Esta es su opinión: ' . $verOP['opinion'] . '</small><p><br>	
													  </div>
												  </div>';
												?>
											</td>
										<?php
											$con = $con + 1;
											if ($con == 1) {
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

			</div>
		</div>
	</div>


</body>

</html>


<?php
ob_end_flush();
?>