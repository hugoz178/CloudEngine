<html>
<head>
	<title>Agenda</title>

	<!-- icono de la pagina -->
	<link rel="icon" href="images/icons/agenda.png">
	

	
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

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
			<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
				<div class="panel panel-info" >
					<div class="panel-heading">
						<div class="panel-title">Recuperar Password</div>
						<div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="index.php">Iniciar Sesi&oacute;n</a></div>
					</div>     
					
					<div style="padding-top:30px" class="panel-body" >
						
						<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
						
						<form id="loginform" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
							
							<div style="margin-bottom: 25px" class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								<input id="email" type="email" class="form-control" name="email" placeholder="email" required>                                        
							</div>
							
							<div style="margin-top:10px" class="form-group">
								<div class="col-sm-12 controls">
									<button id="btn-login" type="submit" class="btn btn-success">Enviar</a>
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-12 control">
										<div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
											No tiene una cuenta! <a href="registro.php">Registrate aquí</a>
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