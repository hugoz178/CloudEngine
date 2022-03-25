<?php
ob_start() ;
session_start();
$campo = $_SESSION['username']; 
require_once 'php/conexion.php';
include 'boot.php';

if ($campo == null || $campo == '' || $campo !== 'hugoz178'){
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

		<link rel="icon" href="images/icons/agenda.png">

		

	</head>

	<body style="overflow-x:hidden; background-color:#000000;">
		<?php include 'loader.html'; ?>

		<nav class="navbar navbar-inverse" style="background-color:black;">
			<div class="container-fluid ">
				<div class="navbar-header">
					  <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#demo">
					    <i class="material-icons" style="font-size:48px;color:#5D00B9">dehaze</i>
					  </button>
				</div>
				<ul class="nav navbar-nav">
					<h1>Cloud Engine</h1>
				</ul>

			</div>
		</nav> 

				<div class="offcanvas offcanvas-start" id="demo" style="background-color:#050503">
				  <div class="offcanvas-header">
				    <center><h2 class="offcanvas-title text-white" style="text-align: center;">Usuario: <?php echo $campo ?></h2></center>
				    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
				  </div>
				  <div class="offcanvas-body">
				  	<div class="btn-group-vertical" style="width:280px">
						<a href="softwares.php" class="btn"><h2 style="color:#5D00B9">Añadir softwares</h2></a><br>
						<a href="configuracion.php" class="btn"><h2 style="color:#5D00B9">Configuración</h2></a><br>
						<a href="logout.php" class="btn"><h2 style="color:#5D00B9">Cerrar sesión</h2></a>
				  	</div>
				  </div>
				</div>



		<div class="row">
			<div class="col-md-3">
				<div class="card" style="background-color: #050503; border: 1px solid white;">
					<div class="card-tittle">
						<h3 class="text-white">Comentarios recientes: </h3>
					 </div>
					<div class="card-body">
						<div class="container-fluid" id="Layer1" style="width:100%; height:480px; overflow: auto; overflow-x: hidden;">
							<?php
							$consCS=$cnx->query("SELECT * FROM comentarios ORDER BY idCom desc");
							while ($verCS=mysqli_fetch_array($consCS)) {
								?>
								<div style="border: 1px solid #5D00B9">
								<img src="https://i.pinimg.com/originals/bb/3d/43/bb3d43fa506c564d150130d91ed4b21b.jpg"  class="mr-3 mt-3" style="width:10%;">
								<h4 class="text-white"><?php echo $verCS['username'] ?></h4>
								<p class="text-white"><small><?php echo $verCS['fechaCom'] ?></small></p>
								<p class="text-white"><?php echo $verCS['comSoft'] ?><p> 
								</div>	
									<?php
								}
								?>		

						</div>
					</div>
				</div>
			</div>
				<div class="col-md-6">
					<div class="container-fluid" id="Layer2" style="width:100%; height:512px; overflow: auto; border: 1px solid #5D00B9">
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
												  <img src="data:image/png;base64,'.base64_encode($row['fotoSoft']). '" class="card-img-top" alt="photo" style="width:300px; height:300px;">
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
												</div>';
													?>
												</td>
												<?php
												$con=$con+1;
												if($con==2){
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
				<div class="col-md-3">
				<div class="card" style="background-color: #050503; border: 1px solid white;">
					<div class="card-tittle"><p class="text-white">Opiniones:</p> </div>
					<div class="card-body">
						<div class="container-fluid" id="Layer1" style="width:100%; height:480px; overflow: auto; overflow-x: hidden;">
							<?php
							$consOP=$cnx->query("SELECT * FROM opiniones");
							while ($verOP=mysqli_fetch_array($consOP)) {
								echo '
								<div style="border: 1px solid #5D00B9">
								<h4 class="text-white">Usuario: '. $verOP['username'].'</h4>
								<p class="text-white"><small> El asunto es: '. $verOP['asunto'].'</small></p>
								<p class="text-white">Esta es su opinión: '. $verOP['opinion'].'<p> 
								</div>';	
									
								}
								?>		

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