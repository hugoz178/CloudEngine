<?php
ob_start();
session_start();
include 'php/conexion.php';
include 'boot.php';
$camp = $_SESSION['username'];

if ($camp == null || $camp == ''){
  header("location:index.php");
  die();
}

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
	<title>Cloud Engine</title>
</head>
<body>

	<?php
      $cons=$cnx->query("SELECT * FROM usuarios WHERE username='$camp'");
      if ($cons){
        if ($_SESSION['username']=='hugoz178'){
          $consA=$cnx->query("SELECT * FROM usuarios WHERE username='$camp'");
            if ($consA){
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
            <center><h2 class="offcanvas-title text-white" style="text-align: center;">Usuario: <?php echo $_SESSION['username'] ?></h2></center>
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
            <center><h2 class="offcanvas-title text-white" style="text-align: center;">Usuario: <?php echo $_SESSION['username'] ?></h2></center>
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


		

		$sql = $cnx->query("SELECT fotousuario FROM fotousuarios WHERE username='$camp'");
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
		
      echo $camp;
	?>

     <!-- Button to Open the Modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
      Open modal
    </button>

    <!-- The Modal -->
    <div class="modal" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">No te vayas!!</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <form id="form" action="eliminarcuenta.php">
              <div>
                <p>Estás a punto de eliminar tu cuenta.</p>
                <p>Si deseas continuar presiona el boton de Eliminar</p>
              </div>
              <div>
                <input type="submit" name="borrar" value="Eliminar">
              </div>
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

