<?php
ob_start() ;
session_start();
$camp = $_SESSION['username']; 
if ($camp == null || $camp = '' || $camp != 'hugoz178'){
 	header("location:index.php");
 	die();
 }

require_once 'php/conexion.php';
$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!#$%&';
$cadena = substr(str_shuffle($permitted_chars), 1, 10);



if (isset($_POST['registrar'])) 
{
	$nomS=$_REQUEST["nombreSoft"];
	$desS=$_REQUEST["descripcionSoft"];
	$cosS=$_REQUEST["costoSoft"];
	$catS=$_REQUEST["categoriaSoft"];

	$insertar=("INSERT into software (idSoft,nombreSoft, descripcionSoft,costoSoft, categoriaSoft,username) values('$cadena','$nomS','$desS','$cosS','$catS','$camp')");
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
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	<title></title>
</head>
<body>
	<nav class="navbar navbar-inverse" style="background-color:black;">
		<div class="container-fluid ">
			<div class="navbar-header">
				<a class="navbar-brand" >web-Agenda Mis Contactos®</a>
			</div>
			<ul class="nav navbar-nav">
				<li class="active"><a><font size=4><?php echo $_SESSION['username'] ?></a></li>
			</ul>
			<ul class="nav navbar-nav">
				<li><a href="logout.php"><font size=4>Cerrar Sesión</a></li>
			</ul>
		</div>
	</nav> 


		<!-- <div align="center">
			<img src="images/agenda.png" >
		</div> -->
		<div class="container">

			<div class="row">
				<div class="col-md-4">
					<form class="login" method="post">
						<h1 class="login-title"><span class="glyphicon glyphicon-tasks"></span> Softwares</h1>

						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input id="idSoft" type="text" class="form-control input-lg" placeholder="idSoft" name="idSoft" value="<?php if (isset($_POST['buscar'])) echo $campo['idSoft']?>">
						</div><br>


						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input id="nombreSoft" type="text" class="form-control input-lg" placeholder="Nombre del software" name="nombreSoft" value="<?php if (isset($_POST['buscar'])) echo $campo['nombreSoft']?>">
						</div><br>


						<div class="input-group">
							<span class="input-group-addon"></span>
							<input class="btn form-control input-lg" type="file" name="fotoSoft" id="fotoSoft">
						</div><br>

						<div class="input-group">
							<input id="descripcionSoft" type="text" class="form-control input-lg" placeholder="Descripcion del software" name="descripcionSoft" value="<?php if (isset($_POST['buscar'])) echo $campo['descripcionSoft']?>">
						</div><br>


						<div class="input-group">
							<input id="costoSoft" type="text" class="form-control input-lg" placeholder="Precio del softwareftware" name="costoSoft" value="<?php if (isset($_POST['buscar'])) echo $campo['costoSoft']?>" >
						</div><br>

						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
							<input id="categoriaSoft" type="text" class="form-control input-lg" placeholder="Categoria" name="categoriaSoft" value="<?php if (isset($_POST['buscar'])) echo $campo['categoriaSoft']?>">
						</div><br>

						<button type="submit" class="btn btn-primary btn-lg btn-warning" name="registrar">Registrar</button>

						<button type="submit" class="btn btn-primary btn-lg btn-warning" name="eliminar">Eliminar</button>

						<button type="submit" class="btn btn-primary btn-lg btn-warning" name="buscar">Buscar</button>

						<button type="submit" class="btn btn-primary btn-lg btn-warning" name="actualizar">Actualizar</button>

					</form>
				</div>

				<div class="col-md-8">
<br><br>
<div class="container-fluid" id="Layer1" style="width:100%; height:480px; overflow: scroll;">
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
  <p><small>ID:'.$row['idSoft'].' </small></p>
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




					<br><br><br> 	 	


				</div>	
			</div>

			<div class="row">
				<div class="col-md-12">
					<p align="center">Copyright © 2020 Master-db. Todos los derechos reservados. Desarrollado por el David Belmares// <a>BootStraps HTML5 + CSS3 + PHP</a> <a href="https://postparaprogramadores.com/libro-bootstraps/"></a></p>
				</div>
			</div>
			
		</div>


</body>
</html>