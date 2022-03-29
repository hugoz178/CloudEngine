<?php
ob_start();
session_start();
include 'php/conexion.php';
include 'boot.php';
include 'loader.html';
$camp = $_SESSION['username'];

if ($camp == null || $camp == ''){
  header("location:index.php");
  die();
}

if (isset($_POST['actpass'])) 
{
  $co = $_POST['correo'];
  $ce = $_POST['celular'];
  $sha = $_POST['contrasena'];
  $ps = sha1($sha);

	$actualiza="UPDATE usuarios SET username = '$camp', email = '$co', celular = '$ce', password = '$ps' WHERE username = '$camp';";

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
	?>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#contra">
      Cambiar contraseña
    </button>

    <div class="modal" id="contra">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <h4 class="modal-title">Cambia tu contraseña</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <div class="modal-body">
          <?php
            $sql = $cnx->query("SELECT * FROM usuarios WHERE username='$camp'");
              while ($row=mysqli_fetch_array($sql)) {
                ?>
              <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" >
                  <?php echo '
                  <input type="hidden" value="'.$row['email'].'" name="correo">
                  <input type="hidden" value="'.$row['celular'].'" name="celular">
                  '; ?>
                <p>Actualizar contrasena </p>
                <input type="password" name="contrasena">
                <input type="submit" name="actpass">
              </form>
              <?php
              }
          ?>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    </div> 

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tel">
      Cambiar CELULAR
    </button>

    <div class="modal" id="tel">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <h4 class="modal-title">Cambia tu num celular</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <div class="modal-body">
          <?php
            $sql = $cnx->query("SELECT * FROM usuarios WHERE username='$camp'");
              while ($row=mysqli_fetch_array($sql)) {
                ?>
              <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" >
                  <?php echo '
                  <input type="hidden" value="'.$row['email'].'" name="correo">
                  <input type="hidden" value="'.$row['password'].'" name="contrasena">
                  <p>Actualizar contrasena </p>
                  <input type="text" value="'.$row['celular'].'" name="celular">
                  <input type="submit" name="actpass">
                  '; ?>

              </form>
              <?php
              }
          ?>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    </div> 

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
      Eliminar cuenta
    </button>

    <div class="modal" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <h4 class="modal-title">No te vayas!!</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

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

          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    </div> 


</body>
</html>

