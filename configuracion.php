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


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="//oss.maxcdn.com/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"></script> 
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
<?php 
if (isset($_POST['actpass'])) 
{
  $co = $_POST['correo'];
  $ce = $_POST['celular'];
  $sha = $_POST['contrasena'];
  $ps = sha1($sha);

  $actualiza="UPDATE usuarios SET username = '$camp', email = '$co', celular = '$ce', password = '$ps' WHERE username = '$camp';";

  $resultado=mysqli_query($cnx,$actualiza);

  if ($resultado) {
    echo "
        <div class='toast show' style='width:100%'>
          <div class='toast-header'>
            <strong class='me-auto'>Formulario enviado!!</strong>
            <button type='button' class='btn-close' data-bs-dismiss='toast'></button>
          </div>
          <div class='toast-body'>
            <p>Tus cambios han sido guardados con exito!!</p>
            <p><small>Puedes cerrar esta pestañita</small></p>
          </div>
        </div>
          ";
  }else{
    echo "
        <div class='toast show' style='width:100%'>
          <div class='toast-header'>
            <strong class='me-auto'>Error al enviar</strong>
            <button type='button' class='btn-close' data-bs-dismiss='toast'></button>
          </div>
          <div class='toast-body'>
            <p>Upss! Parece que hubo un error al enviar el formulario. Intentalo mas tarde</p>
            <p><small>Puedes cerrar esta pestañita</small></p>
          </div>
        </div>
          ";
  }
}

?>   

        <div class="offcanvas offcanvas-start" id="demo" style="background-color:#050503">
          <div class="offcanvas-header">
            <center><h2 class="offcanvas-title text-white" style="text-align: center;">Usuario: <?php echo $_SESSION['username'] ?></h2></center>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
          </div>
          <div class="offcanvas-body">
            <div class="btn-group-vertical" style="width:280px">
            <a href="vista_usuario.php" class="btn"><h2 style="color:#5D00B9">Inicio</h2></a><br>
            <a href="misjuegos.php" class="btn"><h2 style="color:#5D00B9">Mis Juegos</h2></a><br>
            <a href="ver_carrito.php" class="btn"><h2 style="color:#5D00B9">Mi carrito</h2></a><br><br><br>
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
              <form id="formpass" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" >
                  <?php echo '
                  <input type="hidden" value="'.$row['email'].'" name="correo">
                  <input type="hidden" value="'.$row['celular'].'" name="celular">
                  '; ?>
                <p>Actualizar contrasena </p>
                <div class="form-group">
                  <input type="password" name="contrasena" maxlength="10">
                </div>
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
              <form id="formcel" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" >
                  <?php echo '
                  <input type="hidden" value="'.$row['email'].'" name="correo">
                  <input type="hidden" value="'.$row['password'].'" name="contrasena">
                  <p>Actualizar contrasena </p>
                  <div class="form-group">
                  <input type="text" value="'.$row['celular'].'" id="celular" name="celular" maxlength="10">
                  </div>
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

<script type="text/javascript">

//java

$( "#formcel" ).bootstrapValidator({

   feedbackIcons: {
 
     valid: 'glyphicon glyphicon-ok',
 
     invalid: 'glyphicon glyphicon-remove',
 
     validating: 'glyphicon glyphicon-refresh'
 
   },
 
   fields: {
 
     celular: {
       
       message: 'Ingrese Su Número De Celular',
       
       validators: {
         
         notEmpty: {
           
           message: 'Ingrese Su Número De Celular'
         },

         regexp: {

           regexp: /^[0-9]+$/,

           message: 'El Número de Celular Solo Puede Contener Digitos'
         },

         stringLength: {
 
           min: 10,

           max: 10,
 
           message: 'Tu numero debe ser de 10 digitos'
 
         }  

       }

     } 

  }
 
});
</script>

<script type="text/javascript">

//java

$( "#formpass" ).bootstrapValidator({

   feedbackIcons: {
 
     valid: 'glyphicon glyphicon-ok',
 
     invalid: 'glyphicon glyphicon-remove',
 
     validating: 'glyphicon glyphicon-refresh'
 
   },
 
   fields: {
 
     contrasena: {
 
       validators: {
 
         notEmpty: {
 
          message: 'Debes ingresar una contraseña.'
 
         },
 
         stringLength: {
 
          min: 5,
          max:15,
 
           message: 'Maximo 5 caracteres y maximo 15.\n'
 
         }

       }
 
     }   
 
  }
 
});

</script>