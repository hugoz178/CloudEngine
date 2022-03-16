<!-- Códigos de REGISTRAR -->
<?php
/*if (isset($_POST['registrar'])) 
{
	if (!empty($_POST['matricula']) && !empty($_POST['nombre']) && !empty($_POST['celular']) && !empty($_POST['email']) && !empty($_POST['ciudad']))
	{
		#$usuario = $_SESSION['usuario'];
		mysqli_query($cnx,"INSERT into agenda values
			( '$_POST[matricula]',
			'$_POST[nombre]',
			'$_POST[celular]',
			'$_POST[email]',
			'$_POST[ciudad]',
			'$_SESSION[usuario]')");
	}
}
?>-

<!-- Códigos de BUSQUEDA -->
<?php
if (isset($_POST['buscar'])) 
{
	if (!empty($_POST['matricula'])|| $_POST['nombre']|| $_POST['celular']|| $_POST['email']|| $_POST['ciudad']!="Ingresa Matricula")
	{
		$sql="SELECT * from agenda where matricula ='$_POST[matricula]'";
		$registro=mysqli_query($cnx,$sql);
		$campo=mysqli_fetch_array($registro);
	}
}
?>

<!-- Códigos de ELIMINAR -->
<?php
if (isset($_POST['eliminar'])) 
{
	if (!empty($_POST['matricula']))
	{
		$sql="DELETE from agenda where matricula='$_POST[matricula]'";
		$registro=mysqli_query($cnx,$sql);
		header("location:vista_usuario.php");
	}
}
?>

<!-- Códigos de ACTUALIZAR -->
<?php
if (isset($_POST['actualizar'])) 
{
	if (!empty($_POST['matricula']))
	{
		mysqli_query($cnx,"UPDATE agenda set
			matricula='$_POST[matricula]',
			nombre='$_POST[nombre]',
			celular='$_POST[celular]',
			email='$_POST[email]',
			ciudad='$_POST[ciudad]'
			where matricula='$_POST[matricula]'");
	}
}




		<!-- <div align="center">
			<img src="images/agenda.png" >
		</div> -->
		<!--div class="container">

			<div class="row">
				<div class="col-md-4">
					<form class="login" method="post">
						<h1 class="login-title"><span class="glyphicon glyphicon-tasks"></span> Alumnos</h1>

						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>
							<input id="matricula" type="text" class="form-control input-lg" placeholder="Ingresa Matricula" autofocus name="matricula" value="<?php if (isset($_POST['buscar'])) echo $campo['matricula']?>">
						</div><br>

						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input id="nombre" type="text" class="form-control input-lg" placeholder="Ingresa Nombre Completo" name="nombre" value="<?php if (isset($_POST['buscar'])) echo $campo['nombre']?>">
						</div><br>


						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
							<input id="celular" type="text" class="form-control input-lg" placeholder="Ingresa Celular" name="celular" value="<?php if (isset($_POST['buscar'])) echo $campo['celular']?>" >
						</div><br>

						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
							<input id="email" type="text" class="form-control input-lg" placeholder="Correo electrónico " name="email" value="<?php if (isset($_POST['buscar'])) echo $campo['email']?>">
						</div><br>

						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
							<input id="ciudad" type="text" class="form-control input-lg" placeholder="Ciudad " name="ciudad" value="<?php if (isset($_POST['buscar'])) echo $campo['ciudad']?>">
						</div><br>

						<button type="submit" class="btn btn-primary btn-lg btn-warning" name="registrar"><span class="glyphicon glyphicon-plus"></span></button>

						<button type="submit" class="btn btn-primary btn-lg btn-warning" name="eliminar"><span class="glyphicon glyphicon-minus"></span></button>

						<button type="submit" class="btn btn-primary btn-lg btn-warning" name="buscar"><span class="glyphicon glyphicon-search"></span></button>

						<button type="submit" class="btn btn-primary btn-lg btn-warning" name="actualizar"><span class="glyphicon glyphicon-refresh"></span></button>

					</form>
				</div>

				<div class="col-md-8">
					<br><br><br> 	 	
					<table class="table table-hover table-condensed table-bordered">
						<tr>
							<td>Matrícula</td>
							<td>Nombre</td>
							<td>Celular</td>
							<td>Correo</td>
							<td>Ciudad</td>
						</tr>
						<?php
						$sql="SELECT * from agenda";
						$registro=mysqli_query($cnx,$sql);
						while($campo=mysqli_fetch_array($registro))
						{
							if ($campo['usuario']==$_SESSION['usuario'])
							{
							?>
							<tr class="small">
								<td><?php echo $campo['matricula'];?></td>
								<td><?php echo $campo['nombre'];?></td>
								<td><?php echo $campo['celular'];?></td>
								<td><?php echo $campo['email'];?></td>
								<td><?php echo $campo['ciudad'];?></td>
							</tr>

							<?php
							}
						}
						?>
					</table>

				</div>	
			</div>

			<div class="row">
				<div class="col-md-12">
					<p align="center">Copyright © 2020 Master-db. Todos los derechos reservados. Desarrollado por el David Belmares// <a>BootStraps HTML5 + CSS3 + PHP</a> <a href="https://postparaprogramadores.com/libro-bootstraps/"></a></p>
				</div>
			</div>
		</div> -->

$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!#$%&';
echo substr(str_shuffle($permitted_chars), 1, 10);


*/
?>

<?php
$h = 'hola';
$c = 'como';
$e = 'estas';

$frase = $h.' '.$c.' '.$e;

echo $frase;

?>