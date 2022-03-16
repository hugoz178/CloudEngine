<?php
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



?>
<html>
<head>
	<title>Agenda</title>

	<!-- icono de la pagina -->
	<link rel="icon" href="images/icons/agenda.png">
	
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
	<script src="//oss.maxcdn.com/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/js/mdb.min.js"></script>
</head>

<body background="images/banner.jpg">
	<nav class="navbar navbar-inverse ">
		<div class="container-fluid ">
			<div class="navbar-header">
				<a class="navbar-brand" >web-Agenda Mis Contactos®</a>
			</div>
			<ul class="nav navbar-nav">
				<li class="active"><a><font size=4>Almacena tus Contactos en la Web</a></li>
				</ul>
			</div>
		</nav>
		<div class="container">
			<div id="signupbox" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="panel-title">Reg&iacute;strate</div>
						<div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="index.php">Iniciar Sesi&oacute;n</a></div>
					</div>  

					<div class="panel-body" >

						<form id="signupform" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">

							
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
 
     usuario: {
 
       validators: {
 
         notEmpty: {
 
           message: 'Debes ingresar tu nombre de usuario.'
 
         },

         regexp: {

                regexp: /[a-zs]/i,

                message: 'El nombre de usuario no permite el uso de dígitos ni caracteres especiales.\n'

          },

         stringLength: {
 
           min: 5,

           max: 15,
 
           message: 'Tu nombre de usuario debe de tener por lo menos 5 caracteres de longitud y 15 como máximo.'
 
         }
 
       }
 
     },



     correo: {
 
       validators: {

        emailAddress: {
 
           message: 'El correo electrónico debe ser válido.'
 
         },
 
         notEmpty: {
 
           message: 'Ingresa tu correo electrónico.'
 
         }
 
       }
 
     },


 
     contrasena: {
 
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
 
     },
 
     
     confirmar: {
 
       validators: {
 
         notEmpty: {
 
           message: 'Debes de confirmar tu contraseña.'
 
         },


         identical: {
                        field: 'contrasena',
                        message: 'La contraseñas deben de ser iguales.'
                    }
 
       }
 
     }   
 

  }
 
});

</script>