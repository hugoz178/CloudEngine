<?php
ob_start() ;
session_start();
$camp = $_SESSION['username']; 
if ($camp == null || $camp == '' || $camp !== 'hugoz178'){
 	session_destroy();
 	header("location:index.php");
 	die();
 }

require_once 'php/conexion.php';
include 'boot.php';
include 'loader.html';
$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!#$%&';
$cadena = substr(str_shuffle($permitted_chars), 1, 10);



if (isset($_POST['registrar'])) 
{
	$camp = $_SESSION['username'];
	$nomS=$_REQUEST["nombreSoft"];
	$desS=$_REQUEST["descripcionSoft"];
	$cosS=$_REQUEST["costoSoft"];
	$catS=$_REQUEST["categoriaSoft"];
	$foto=$_FILES["foto"]["name"];
	$ruta=$_FILES["foto"]["tmp_name"];
	$destino="fotoS/".$foto;
	copy($ruta,$destino);

	$insertar=("INSERT into software (idSoft,nombreSoft, fotoSoft, descripcionSoft,costoSoft, categoriaSoft,username) values('$cadena','$nomS', '$destino','$desS','$cosS','$catS','$camp')");
	$resultado=mysqli_query($cnx,$insertar);

	if (!$resultado) {
	  echo "<br><br>Error al registrar,intenta de nuevo";
	  
	  echo "<br><a href='software.php'>Regresar</a>";
	}else
	{
		header("Location:softwares.php");
	}
}

if (isset($_POST['buscar'])) 
{
	if (!empty($_POST['nombreSoft'])|| $_POST['categoriaSoft']|| $_POST['descripcionSoft']|| $_POST['costoSoft']|| $_POST['idSoft']!="Ingresa soft")
	{
		$sql="SELECT * FROM software where idSoft ='$_POST[idSoft]'";
		$registro=mysqli_query($cnx,$sql);
		$campo=mysqli_fetch_array($registro);
	}
}


#Códigos de ELIMINAR

if (isset($_POST['eliminar'])) 
{
	if (!empty($_POST['nombreSoft']))
	{
		$sql="DELETE from software where nombreSoft='$_POST[nombreSoft]'";
		$registro=mysqli_query($cnx,$sql);
		header("location:softwares.php");
	}
}


#Códigos de ACTUALIZAR

if (isset($_POST['actualizar'])) 
{
	if (!empty($_POST['nombreSoft']))
	{
		mysqli_query($cnx,"UPDATE software set
			nombreSoft='$_POST[nombreSoft]',
			descripcionSoft='$_POST[descripcionSoft]',
			costoSoft='$_POST[costoSoft]',
			categoriaSoft='$_POST[categoriaSoft]'
			where nombreSoft='$_POST[nombreSoft]'");
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/style.css">
	<title>Cloud Engine</title>
</head>
<body style="background-color:#000000;" class="hidden">
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
				    <center><h2 class="offcanvas-title text-white" style="text-align: center;">Usuario: <?php echo $_SESSION['username'] ?></h2></center>
				    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
				  </div>
				  <div class="offcanvas-body">
				  	<div class="btn-group-vertical" style="width:280px">
						<a href="vista_admin.php" class="btn"><h2 style="color:#5D00B9">Inicio</h2></a><br>
            			<a href="configuracion.php" class="btn"><h2 style="color:#5D00B9">Configuración</h2></a><br>
						<a href="logout.php" class="btn"><h2 style="color:#5D00B9">Cerrar sesión</h2></a>
				  	</div>
				  </div>
				</div>


		<!-- <div align="center">
			<img src="images/agenda.png" >
		</div> -->
		<div class="container">

			<div class="row">
				<div class="col-md-4">
					<form class="login" method="post" enctype="multipart/form-data">
						<h1 class="login-title"><span class="glyphicon glyphicon-tasks"></span> Softwares</h1>

						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input id="idSoft" type="text" class="form-control input-lg" placeholder="idSoft" style="background-color: #2D2D2D; color:white;" name="idSoft" value="<?php if (isset($_POST['buscar'])) echo $campo['idSoft']?>">
						</div><br>


						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input id="nombreSoft" type="text" class="form-control input-lg" placeholder="Nombre del software" style="background-color: #2D2D2D; color:white;" name="nombreSoft" value="<?php if (isset($_POST['buscar'])) echo $campo['nombreSoft']?>">
						</div><br>


						<div class="input-group">
							<span class="input-group-addon"></span>
							<input class="btn form-control input-lg" style="background-color: #2D2D2D; color:white;" type="file" name="foto" id="foto" accept="image/png, .jpeg, .jpg">
						</div><br>

						<div class="input-group">
							<input id="descripcionSoft" type="text" class="form-control input-lg" placeholder="Descripcion del software" name="descripcionSoft" style="background-color: #2D2D2D; color:white;" value="<?php if (isset($_POST['buscar'])) echo $campo['descripcionSoft']?>">
						</div><br>


						<div class="input-group">
							<input id="costoSoft" type="text" class="form-control input-lg" placeholder="Precio del softwareftware" style="background-color: #2D2D2D; color:white;" name="costoSoft" value="<?php if (isset($_POST['buscar'])) echo $campo['costoSoft']?>" >
						</div><br>

						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
							<input id="categoriaSoft" type="text" style="background-color: #2D2D2D; color:white;" class="form-control input-lg" placeholder="Categoria" name="categoriaSoft" value="<?php if (isset($_POST['buscar'])) echo $campo['categoriaSoft']?>">
						</div><br>

						<center>
						<button type="submit" class="btn" style="background-color:#5D00B9" name="registrar"><i class='fas fa-plus' style='color:white; font-size:26px'></i></button>

						<button type="submit" class="btn" style="background-color:#5D00B9" name="eliminar"><i class="material-icons" style='color:white; font-size:26px'>delete</i></button>
						
						<button type="submit" class="btn" style="background-color:#5D00B9" name="buscar"><i class='fas fa-search' style='color:white; font-size:26px'></i></button>

						<button type="submit" class="btn" style="background-color:#5D00B9" name="actualizar"><i class="material-icons" style='color:white; font-size:26px'>edit</i></button>
						</center>
					</form>
				</div>

				<div class="col-md-8">
<br><br>
<div class="container-fluid" id="Layer1" style="width:100%; height:550px; overflow: auto; border: 1px solid #5D00B9;">
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
		  <img src="'.$row['fotoSoft'].'" class="card-img-top" alt="photo" style="width:300px; height:300px;">
		 </center>
			<a>
			<div class="mask rgba-white-slight"></div>
			</a>
		</div>
			<div class="card-body card-body-cascade">
				<h5 class="text-white pb-2 pt-1"><i class="fas fa-shopping-bag"></i>  '.$row['categoriaSoft']. ' Id:'.$row['idSoft'].'</h5>
				<h4 class="font-weight-bold card-title text-white">'.$row['nombreSoft'].'</h4>
				<p class="card-text text-white">'.$row['descripcionSoft'].'</p>
				<a class="btn btn-secondary" style="background-color:#5D00B9" href="infsoftware.php?id='.$row['idSoft'].'">Obervar Software</a>
			</div>
				';
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




					<br><br><br> 	 	


				</div>	
			</div>
			
		</div>


</body>
</html>