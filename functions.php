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

  $registarfoto = "INSERT INTO fotousuarios (username,fotousuario) VALUES ('$user','');";

  #$cor =mail($mail,"Registro con exito. Bienvenido a Electroniknet!",$message,$cabeceras);
  $listo = mysqli_query($cnx,$registrar);
  $listo2 = mysqli_query($cnx,$registarfoto);


  if ($listo) {
    header("Location:index.php");
  }else{
    echo 'error';
  }
}

?>