<?php
session_start();
ob_start();
include 'php/conexion.php';
$camp = $_SESSION['username'];
include 'boot.php';


if (isset($_POST['subirfoto'])) 
{
	$foto = addslashes(file_get_contents($_FILES['foto']['tmp_name']));

	$actualiza="UPDATE fotousuarios SET fotousuario = '$foto', username = '$camp' WHERE username = '$camp';";
	$resultado=mysqli_query($cnx,$actualiza);

	if ($resultado) {
 		header("Location:configuracion.php");

	}else{
		echo "error";
	}
}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>

	<?php
      $cons=$cnx->query("SELECT * FROM usuarios WHERE username='$camp'");
      if ($cons){
        if ($_SESSION['username']=='hugoz178'){
          $consA=$cnx->query("SELECT * FROM usuarios WHERE username='$camp'");
            if ($verA=mysqli_fetch_array($consA)){
              ?>
    <nav class="navbar navbar-inverse" style="background-color:black;">
      <div class="container-fluid ">
        <div class="navbar-header">
            <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#demo">
              <i class='fas fa-bars' style='font-size:36px; color:#5D00B9;'></i>
            </button>
        </div>
        <ul class="nav navbar-nav">
          <h1>Cloud Engine</h1>
        </ul>

      </div>
    </nav> 

        <div class="offcanvas offcanvas-start" id="demo" style="background-color:#050503">
          <div class="offcanvas-header">
            <center><h2 class="offcanvas-title text-white" style="text-align: center;">Usuario: <?php echo $camp ?></h2></center>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
          </div>
          <div class="offcanvas-body">
            <div class="btn-group-vertical" style="width:280px">
            <a href="vista_admin.php" class="btn"><h2 style="color:#5D00B9">Inicio</h2></a>
            <a href="softwares.php" class="btn"><h2 style="color:#5D00B9">Añadir softwares</h2></a><br>
            <br>
            <a href="logout.php" class="btn"><h2 style="color:#5D00B9">Cerrar sesión</h2></a>
            </div>
          </div>
        </div>
              <?php
            }

        }else{
              $consU=$cnx->query("SELECT * FROM usuarios WHERE username='$camp'");
              if ($consU){
?>
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
            <center><h2 class="offcanvas-title text-white" style="text-align: center;">Usuario: <?php echo $camp ?></h2></center>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
          </div>
          <div class="offcanvas-body">
            <div class="btn-group-vertical" style="width:280px">
            <a href="vista_usuario.php" class="btn"><h2 style="color:#5D00B9">Inicio</h2></a><br>
            <a href="" class="btn"><h2 style="color:#5D00B9">Mi carrito</h2></a><br>
            <a href="logout.php" class="btn"><h2 style="color:#5D00B9">Cerrar sesión</h2></a>
            </div>
          </div>
        </div>
<?php
              }
            }
      }


		echo $camp;

		$sql = $cnx->query("SELECT fotousuario FROM fotousuarios");
		if ($sql == null){
			?>
			<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
			<img src="images/fotousuario.png"><br>
			<p>Sube tu imagen: </p>
			<input type="file" name="foto">
			<input type="submit" name="subirfoto">
			</form>
			<?php
		}else{
			if ($row=mysqli_fetch_array($sql)) {
				?>
					<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
					<?php echo '<img src="data:image/png;base64,'.base64_encode($row['fotousuario']). '" class="card-img-top" alt="photo" style="width:300px; height:300px;">
													</center>'; ?>
					<p>Actualizar imagen: </p>
					<input type="file" name="foto">
					<input type="submit" name="subirfoto">
					</form>
			<?php
			}
			
		}
	?>

</body>
</html>