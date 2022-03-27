<?php
ob_start() ;
session_start();
include("php/conexion.php");

if (isset($_POST['regBtn'])) 
{

  $user = $_POST['username'];
  $mail = $_POST['email'];
  $cel = $_POST['celular'];
  $psw = $_POST['password'];
  $encriptsha = sha1($psw);
  #$message = '<!--DOCTYPE html>
  /*<html>
  <body>
    <div>
    <h1 class="text-danger">Bienvenido a Electroniket!!</h1>
    <p>Gracias por registrarte a nuestra tienda<b> Electroniknet</b> </p>
    <br>
      <h1><a href="https://www.nfparty.com/nfparty.com/diegomendozaromero/project/electroniket/ingresa.php">Inicia sesión</a></h1>
  <p>Copyright &copy; 2019 &middot; Todos los derechos reservados</p>
  </body>
  </html>'*/;

  #$cabeceras = 'MIME-Version: 1.0' . "\r\n";
  #$cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";

  $registrar = "INSERT INTO usuarios (username,email,celular,password)
  VALUES ('$user','$mail','$cel','$encriptsha');";
  #$cor =mail($mail,"Registro con exito. Bienvenido a Electroniknet!",$message,$cabeceras);
  $listo = mysqli_query($cnx,$registrar);

  if ($listo) {
    header("Location:index.php");
  }else{
    echo 'error';
  }
}

# Se verifica si se presiona el botón llamado iniciar-sesion
if (isset($_POST['iniciar-session']))
{
  # Se guarda el contendio de las cajas de texto en las variables $us y $ps
  $us=$_POST['usuario'];
  $ps=$_POST['password'];
  $psSha = sha1($ps);
  
  # Se valida que las variables no esten vacias o nulas
  if (!empty($us) &&  !empty($ps))
  {
    # Query de consulta
    $query = "SELECT * from usuarios WHERE username='".$us."' AND password='".$psSha."'";

    # Asigna el registro del Query
    $registro=mysqli_query($cnx,$query);

    # Asigna los datos del registro a la variable $campo
    $campo=mysqli_fetch_array($registro);

    # Cuenta la cantidad de registros del Query
    $count=mysqli_num_rows($registro);

    # Valida que la variable count tenga un valor
    if($count)  
    { 
      if ($campo['username']=="hugoz178" AND $campo['password'] == $psSha)
      {
        $_SESSION['username'] = $campo['username'];
        header("location:vista_admin.php"); 
      }
      else
      {
        $_SESSION['nombre'] = $campo['name'];
        $_SESSION['username'] = $campo['username'];
        header("location:vista_usuario.php"); 
      } 
    } 
    else
    {
      echo "<div class='alert alert-danger'>
      <strong><h4>Ha surgido un Error<br>Verifica las credenciales de Acceso!</strong></div>";
    }
    
  }
}


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="//oss.maxcdn.com/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"></script>   
  <title></title>
</head>
<body style="background-color: #000000; overflow-x: hidden;">
  <div class="row">
      <nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-center">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Logo</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="index.php">Inicia Sesión</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" type="button" href="#" data-bs-toggle="modal" data-bs-target="#registro">Registrate</a>
              </li>  
            </ul>
          </div>
        </div>
      </nav>
    <div class="col-lg-1">

    </div>
    <div class="col-lg-10">
      <img src="images/bannerCloud.png" style="width:100%">
      <br><br>
      <h1 class="display-2 text-white">¿Quienes somos?</h1>
      <h4 class="text-white">Somos una plataforma de distribución digital de videojuegos, asi como de diversas herramientas digitales.</h4>
      <h1 class="display-2 text-white">Nuestra funcionalidad</h1>
      <h4 class="text-white">Nuestro servicios va a permitir que nuestros usuarios descargen juegos y otro software desde sus bibliotecas de software virtual. Los juegos que son integrados en CloudEngine son almacenados dentro de la nube, para que el usuario no tenga que usar mucho espacio de su almacenamiento en su ordenador.</h4>
    </div>
    <div class="col-lg-1">

    </div>
  </div>


  <div class="modal" id="registro">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
            <form id="form" name="form" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off" enctype="multipart/form-data">

              
              <div class="form-group">
                <label for="usuario" class="col-md-3 control-label">Usuario</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="username" placeholder="Usuario" >
                </div>
              </div>

              <div class="form-group">
                <label for="email" class="col-md-3 control-label">Email</label>
                <div class="col-md-9">
                  <input type="email" class="form-control" name="email" placeholder="Email" >
                </div>
              </div>

              <div class="form-group">
                <label for="nombre" class="col-md-3 control-label">Numero de telefono:</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="celular" placeholder="Numero de telefono"  >
                </div>
              </div>


              <div class="form-group">
                <label for="password" class="col-md-3 control-label">Password</label>
                <div class="col-md-9">
                  <input type="password" class="form-control" name="password" placeholder="Password" >
                </div>
              </div>

        

              <div class="form-group">                                      
                <div class="col-md-offset-3 col-md-9">
                  <button id="regBtn" name="regBtn" type="submit" class="btn btn-info"><i class="icon-hand-right"></i>Registrar</button> 
                </div>
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


<script type="text/javascript">

//java

$( "#form" ).bootstrapValidator({

   feedbackIcons: {
 
     valid: 'glyphicon glyphicon-ok',
 
     invalid: 'glyphicon glyphicon-remove',
 
     validating: 'glyphicon glyphicon-refresh'
 
   },
 
   fields: {
 
     username: {
 
       validators: {
 
         notEmpty: {
 
           message: 'Debes ingresar tu nombre de usuario.'
 
         },

         stringLength: {
 
           min: 5,

           max: 15,
 
           message: 'Tu nombre de usuario debe de tener por lo menos 5 caracteres de longitud y 10 como máximo.'
 
         }
 
       }
 
     },



     email: {
 
       validators: {

        emailAddress: {
 
           message: 'El correo electrónico debe ser válido.'
 
         },
 
         notEmpty: {
 
           message: 'Ingresa tu correo electrónico.'
 
         }
 
       }
 
     },

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


     },

 
     password: {
 
       validators: {
 
         notEmpty: {
 
           message: 'Debes ingresar una contraseña.'
 
         },
 
         stringLength: {
 
           min: 5,
          max:25,
 
           message: 'Maximo 5 caracteres y maximo 25.\n'
 
         },

         identical: {
                        field: 'confirmar',
                        message:'Confirma tu contraseña. '
                    }

 
       }
 
     }   
 

  }
 
});

</script>