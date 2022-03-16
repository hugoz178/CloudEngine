<?php
ob_start() ;
session_start();
$campo = $_SESSION['username']; 
require_once 'php/conexion.php';
?>

<!doctype html>
	<html>
	<head>
		<meta charset="utf-8">
		<title>Agenda</title>

		<!-- icono de la pagina -->
		<link rel="icon" href="images/icons/agenda.png">

		<!-- Mis CSS -->
		<link rel="stylesheet" href="css/style.css">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

	</head>

	<body background="images/banner.jpg">

		<nav class="navbar navbar-inverse" style="background-color:black;">
			<div class="container-fluid ">
				<div class="navbar-header">
					<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#demo">
					  Open Offcanvas Sidebar
					</button>
				</div>
				<ul class="nav navbar-nav">
					<h1>Cloud Engine</h1>
				</ul>

			</div>
		</nav> 

		<div class="offcanvas offcanvas-start" id="demo">
 <div class="offcanvas-header">
    <h1 class="offcanvas-title"><?php echo $campo ?></h1>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body">
    <a href="softwares.php">Añade Software</a>
    <a href="logout.php">Cerrar Sesión</a>
  </div>
</div>



		<div class="row">
			<div class="col-md-4">
				<div class="card">
					<div class="card-body">
						<div class="container-fluid" id="Layer1" style="width:100%; height:480px; overflow: scroll;">
							<?php
							$consCS=$cnx->query("SELECT * FROM comentarios");
							while ($verCS=mysqli_fetch_array($consCS)) {
								?>
								<img src="https://i.pinimg.com/originals/bb/3d/43/bb3d43fa506c564d150130d91ed4b21b.jpg"  class="mr-3 mt-3" style="width:10%;">
								<h4><?php echo $verCS['username'] ?></h4>
								<p><small><?php echo $verCS['fechaCom'] ?></small></p>
								<p><?php echo $verCS['comSoft'] ?><p> 
									<?php
								}
								?>		

						</div>
					</div>
				</div>
			</div>
				<div class="col-md-8">
					<div class="container-fluid" id="Layer2" style="width:100%; height:480px; overflow: scroll;">
									<table>
										<br>
										<tr>
											<?php
											$con=0;
											$sql = $cnx->query("SELECT * FROM software");
											while ($row=mysqli_fetch_array($sql)) {

												?>
												<td>
													<?php echo '
													<div class="container mt-3">
													<h3>'.$row['nombreSoft'].'</h3>
													<p>'.$row['descripcionSoft'].'</p>
													
													<a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="'."#".$row['idSoft'].'" href="infsoftware.php?id='.$row['idSoft'].'">
													Open modal
													</a>
													</div>';
													?>
												</td>
												<?php
												$con=$con+1;
												if($con==1){
													echo "</tr>
													<tr>";
													$con=0;
												}
											}
											?>  
										</tr>     
									</table>
					</div>
				</div>

		</div>

			</body>
			</html>


			<?php
			ob_end_flush();
		?>					