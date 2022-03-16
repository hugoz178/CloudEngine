
<?php
ob_start() ;
?>

<!-- Iniciar Sesión -->
<?php
session_start();
?>

<!-- Códigos de CONEXION -->
<?php
include("php/conexion.php");
$camp = $_SESSION['username']; 
	#require_once('php/conexion.php');
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

	<body style="overflow-x:hidden; background-color: #000000; ">
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
				    <center><h1 class="offcanvas-title text-white" style="text-align: center;">Usuario: <?php echo $camp ?></h1></center>
				    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
				  </div>
				  <div class="offcanvas-body">
				  	<div class="btn-group-vertical" style="width:280px">
						<a href="misjuegos.php" class="btn"><h1 style="color:#5D00B9">Mis juegos</h1></a><br>
						<a href="" class="btn"><h1 style="color:#5D00B9">Mi carrito</h1></a><br>
						<a href="logout.php" class="btn"><h1 style="color:#5D00B9">Cerrar sesión</h1></a>
				  	</div>

				  </div>
				</div>


				<div class="row">
					<div class="col-md-1"> </div>
					<div class="col-md-10">
						<div class="card" style="height:900px; background-color:#000000">
							<div class="card-body">
								
								<center><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/8c/XBOX_logo_2012.svg/1280px-XBOX_logo_2012.svg.png" style="width:500px"></center><br>
																
								<center>
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
														<div class="card card-cascade narrower" style="background-color:#050503;" >
												  <div class="view view-cascade overlay"">
												  <center>
												  <img src="https://laverdadnoticias.com/__export/1598298460906/sites/laverdad/img/2020/08/24/zoro_one_piece_anime.jpg_423682103.jpg" class="card-img-top" alt="photo" style="width:300px; height:300px;">
												    </center>
												    <a>
												      <div class="mask rgba-white-slight"></div>
												    </a>
												  </div>
												  <div class="card-body card-body-cascade">
												    <h5 class="text-white pb-2 pt-1"><i class="fas fa-shopping-bag"></i>  '.$row['categoriaSoft'].'</h5>
												    <h4 class="font-weight-bold card-title text-white">'.$row['nombreSoft'].'</h4>
												    <p class="card-text text-white">'.$row['descripcionSoft'].'</p>
												    <a class="btn btn-secondary" style="background-color:#5D00B9" href="infsoftware.php?id='.$row['idSoft'].'">Obervar Software</a>
												  </div>
												</div>
												';
													?>
												</td>
												<?php
												$con=$con+1;
												if($con==3){
													echo "</tr>
													<tr>";
													$con=0;
												}
											}
											?>  
										</tr>     
									</table>
									</center>


								
							</div>
						</div>

					</div>
					<div class="col-md-1"> </div>





				</div>







			</body>
			</html>

			<?php
			ob_end_flush();
			?>

