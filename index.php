<?php
ob_start() ;
session_start();
require_once 'php/conexion.php';


if(!isset($_SESSION['username']) || $_SESSION['username']==null){

}
else{
    if($_SESSION['username'] == "hugoz178")
    {
    	header('location:vista_admin.php');
    }
    else{
    	header('location:vista_usuario.php');
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

<html>
<head>
	<title>Cloud Engine</title>

	<!-- icono de la pagina -->
	<link rel="icon" href="images/icons/agenda.png">
	<link rel="stylesheet"
      href="https://bootswatch.com/5/yeti/bootstrap.min.css"/>
	<!-- Bootstrap CSS -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="js/bootstrap.min.js" ></script>

</head>

<body>
		<div class="container">    
			<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
				<div class="panel panel-info" >  

					<div style="padding-top:30px" class="panel-body" >
						<h1 class="display-6">Inicia sesión</h1>

						<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

						<form id="loginform" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">

							<div style="margin-bottom: 25px" class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								<input id="usuario" type="text" class="form-control" name="usuario" value="" placeholder="Usuario">                                        
							</div>

							<div style="margin-bottom: 25px" class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
								<input id="password" type="password" class="form-control" name="password" placeholder="Password">
							</div>

							<div style="margin-top:10px" class="form-group">
								<div class="col-sm-12 controls">
									<button name="iniciar-session" id="btn-login" type="submit" class="btn btn-success">Iniciar Sesi&oacute;n</a>
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-12 control">
										<div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
											No tiene una cuenta! <a href="inicio.php">Registrate aquí</a>
										</div>
									</div>
								</div>    
							</form>
						</div>                     
					</div>  
				</div>
			</div>
		</body>
		</html>
		<!-- hola perra	 -->
		<?php
		ob_end_flush();
		?>				