<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="manifest" href="manifest.json">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="//oss.maxcdn.com/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"></script>
  <link rel="icon" href="images/cloudlogo.png">
  <title>Cloud Engine</title>
</head>

<body style="overflow-x: hidden;">

  <!--Inicio de nav-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <!-- Container wrapper -->
    <div class="container-fluid">
      <!-- Toggle button -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Collapsible wrapper -->
      <div class="collapse navbar-collapse justify-content-center" id="collapsibleNavbar">
        <!-- Left links -->
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">CloudEngine</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="iniciar_sesion.php">Inicia Sesión</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" type="button" href="registro.php">Registrate</a>
          </li>
        </ul>
        <!-- Left links -->
      </div>
      <!-- Collapsible wrapper -->
    </div>
    <!-- Container wrapper -->
  </nav>
  <!--Final de nav-->

  <!--Inicio de Imagen-->
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-2 col-md-12">
      </div>
      <div class="col-lg-8 col-md-6">
        <img src="images/bannerCloud.png" style="width:90%">
      </div>
      <div class="col-lg-2 col-md-6">
      </div>
    </div>
  </div>
  <!--Final de Imagen-->
  <br><br>
  <!--Inicio de Info-->
  <div class="container">
    <div class="row gx-4 justify-content-center">
      <div class="col-md-6">
        <center>
          <h1>¿Quienes somos?</h1>
        </center>
        <p class="fs-5">Somos una plataforma de distribución digital de videojuegos, asi como de diversas herramientas digitales.</p>
      </div>

      <div class="col-md-6">
        <center>
          <h1>Nuestra funcionalidad</h1>
        </center>
        <p class="fs-5">Nuestro servicios va a permitir que nuestros usuarios descargen juegos y otro software desde sus bibliotecas de software virtual. Los juegos que son integrados en CloudEngine son almacenados dentro de la nube, para que el usuario no tenga que usar mucho espacio de su almacenamiento en su ordenador.</p>
      </div>
    </div>
  </div>
  <!--Fin de Info-->

  <script type="text/javascript">
    //java

    $("#form").bootstrapValidator({

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


        }

      }

    });
  </script>
<script src="./script.js"></script>
</body>

</html>