<?php
ob_start() ;
session_start();
$camp = $_SESSION['username']; 
require_once 'php/conexion.php';

date_default_timezone_set("America/Mexico_City");
$time= date("h:i a");
$date= date("d-M-Y");
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <title></title>
</head>
<body style="overflow-x:hidden; background-color:#000000;">
        <?php
        if(isset($_GET['id'])){
          $id=$_GET['id'];
          $consulta=$cnx->query("SELECT * FROM software WHERE idSoft='$id'");
          if ($consulta) {
              $cons=$cnx->query("SELECT * FROM usuarios WHERE username='$camp'");
              if ($cons) {
                if ($_SESSION['username']=='hugoz178') {
                  $consA=$cnx->query("SELECT * FROM usuarios WHERE username='$camp'");
                  if ($verA=mysqli_fetch_array($consA)) {
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
            <center><h2 class="offcanvas-title text-white" style="text-align: center;">Usuario: <?php echo $camp ?></h2></center>
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

                        <div class="row">
                          <div class="col-md-4">
                            <div class="card" style="background-color: #000000; border: 1px solid #5D00B9">
                              <div class="card-body">
                                <?php 
                                $consultaA=$cnx->query("SELECT * FROM software WHERE idSoft='$id'");
                                if ($ver=mysqli_fetch_array($consultaA)) {             ?>
                                <h1 class="card-tittle display-6 text-white">
                                  <?php echo $ver['nombreSoft'] ?>
                                </h1>
                                <p class="card-text text-white">
                                  <?php echo $ver['descripcionSoft'] ?>
                                </p>
                                <p class="card-text text-white">
                                  Precio del software: <?php echo $ver['descripcionSoft'] ?>
                                </p>
                                <p class="card-text text-white">
                                  Categoria del software: <?php echo $ver['descripcionSoft'] ?>
                                </p>                    
                                <?php } ?> 
                              </div>
                            </div>
                          </div>
                          <div class="col-md-8">
                            <div class="card" style="background-color:#000000; border: 1px solid #5D00B9">
                              <div class="card-body">
                                <div class="container mt-3">
                                  <h1 class="display-6 text-white">Comentarios</h1>
                                  <p class="text-white">Escribe tu comentario </p>
                                  <?php                       
                                      if (isset($_POST['subircom'])) 
                                      {
                                        if (!empty($_POST['comentario']))
                                        {
                                          mysqli_query($cnx,"INSERT into comentarios values
                                            ( ' ',
                                              '$id',
                                              '$camp',
                                              '$date',
                                              '$time',
                                              '$_POST[comentario]')");
                                        }
                                      }
                                  ?>
                                  <form method="POST">
                                    <div class="row">
                                    <div class="col-sm-2">
                                    <label id="image" class="text-white"><?php echo $camp ?></label><br>
                                    <img src="https://i.pinimg.com/originals/bb/3d/43/bb3d43fa506c564d150130d91ed4b21b.jpg" style="width:75px" id="image" >
                                        </div>
                                        <div class="col-sm-10">
                                          <label id="comentario" class="text-white">Comentario</label>
                                          <textarea id="comentario" name="comentario" class="form-control" placeholcer="ingresa comentario" row="5" style="height:60px; resize: none;background-color: #2D2D2D; color:white;"></textarea>
                                          <input type="submit" class="form-control btn" style="background-color:#5D00B9; color: white;" name="subircom" value="Enviar comentario">
                                        </div>
                                    </div>
                                  </form>
                                </div>
                                <!-- VER COMENTARIOS VISTA ADMIN -->
                                <div class="container mt-3">
                                  <div class="container-fluid" id="Layer1" style="width:100%; height:480px; overflow: scroll; border: 1px solid white;">
                                    <div class="media">
                                      <div class="row">
                                      <?php

                                      $consCA=$cnx->query("SELECT * FROM comentarios WHERE idSoft='$id' ORDER BY comSoft asc");
                                      while ($verCA=mysqli_fetch_array($consCA)) {
                                      ?>
                                        <div class="col-sm-4" >
                                          <img src="https://i.pinimg.com/originals/bb/3d/43/bb3d43fa506c564d150130d91ed4b21b.jpg"  class="mr-3 mt-3" style="width:10%;">
                                        </div>
                                        <div class="col-sm-10">
                                          <h4 class="text-white"><?php echo $verCA['username'] ?></h4>
                                          <p class="text-white"><small><?php echo $verCA['fechaCom'] ?></small></p>
                                          <p class="text-white"><small><?php echo $verCA['comSoft'] ?></small><p>
                                          <?php echo '<a type="button" class="btn" style="background-color:#5D00B9; color: white;" href="BorrarComentario.php?id='.$verCA['idCom'].'">Borrar comentario</a>' ?>
                                          <?php
                                          }
                                          ?>
                                          
                                        </div>
                                      
                                      </div>
                                      
                                    </div> <!-- Cierre Media -->
                                  </div><!-- CIERRE SCROLL -->
                                </div>
                              </div><!-- Fin de card body -->
                            </div>
                          </div>
                        </div>
                    <?php
                  }
                }
                else {
                  $consU=$cnx->query("SELECT * FROM usuarios WHERE username='$camp'");
                  if ($verU=mysqli_fetch_array($consU)) {
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
            <center><h2 class="offcanvas-title text-white" style="text-align: center;">Usuario: <?php echo $camp ?></h2></center>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
          </div>
          <div class="offcanvas-body">
            <div class="btn-group-vertical" style="width:280px">
            <a href="index.php" class="btn"><h2 style="color:#5D00B9">Inicio</h2></a><br>
            <a href="" class="btn"><h2 style="color:#5D00B9">Mi carrito</h2></a><br>
            <a href="logout.php" class="btn"><h2 style="color:#5D00B9">Cerrar sesión</h2></a>
            </div>
          </div>
        </div>
                        <div class="row">
                          <div class="col-md-4">
                            <div class="card" style="background-color:#000000; border: 1px solid #5D00B9">
                              <div class="card-body">
                                <?php 
                                $consultaA=$cnx->query("SELECT * FROM software WHERE idSoft='$id'");
                                if ($ver=mysqli_fetch_array($consultaA)) {             ?>
                                <h1 class="card-tittle display-6 text-white">
                                  <?php echo $ver['nombreSoft'] ?>
                                </h1>
                                <p class="card-text text-white">
                                  <?php echo $ver['descripcionSoft'] ?> 
                                </p>
                                <p class="card-text text-white">
                                  Precio del software: <?php echo $ver['costoSoft'] ?>
                                </p>
                                <p class="card-text text-white">
                                  Categoria del software <?php echo $ver['categoriaSoft'] ?>
                                </p>                    
                                <?php } ?>                    
                              </div>
                            </div>
                          </div>
                          <div class="col-md-8">
                            <div class="card" style="background-color:#000000; border: 1px solid #5D00B9">
                              <div class="card-body">
                                <div class="container mt-3">
                                  <h1 class="display-6 text-white">Comentarios</h1>
                                  <p class="text-white">Escribe tu comentario: </p>
                                  <?php                       
                                      if (isset($_POST['subircom'])) 
                                      {
                                        if (!empty($_POST['comentario']))
                                        {
                                          mysqli_query($cnx,"INSERT into comentarios values
                                            ( ' ',
                                              '$id',
                                              '$camp',
                                              '$date',
                                              '$time',
                                              '$_POST[comentario]')");
                                        }
                                      }
                                  ?>                                  
                                  <form method="POST">
                                    <div class="row">
                                    <div class="col-sm-2">
                                    <label id="image" class="text-white"><?php echo $camp ?></label><br>
                                    <img src="https://i.pinimg.com/originals/bb/3d/43/bb3d43fa506c564d150130d91ed4b21b.jpg" style="width:75px" id="image" >
                                    </div>
                                        <div class="col-sm-10">
                                          <label id="comentario" class="text-white">Comentario</label>
                                          <textarea id="comentario" name="comentario" class="form-control" placeholcer="ingresa comentario" row="5" style="height:60px; resize: none; background-color: #2D2D2D; color:white;" name="message-box" id="message-box"></textarea>
                                          <input type="submit" class="form-control btn" name="subircom" value="Enviar comentario" style="background-color:#5D00B9; color: white;">
                                        </div>
                                    </div>
                                  </form>
                                </div>

                                <!-- VER COMENTARIOS VISTA USUARIO -->
                                <div class="container mt-3">
                                  <div class="container-fluid" id="Layer1" style="width:100%; height:480px; overflow: scroll; border: 1px solid white">
                                    <div class="media">
                                      <div class="row">
                                      
                                      <?php
                                      $consCS=$cnx->query("SELECT * FROM comentarios WHERE idSoft='$id'");
                                      while ($verCS=mysqli_fetch_array($consCS)) {
                                      ?>
                                        <div class="col-sm-4">
                                          <img src="https://i.pinimg.com/originals/bb/3d/43/bb3d43fa506c564d150130d91ed4b21b.jpg"  class="mr-3 mt-3" style="width:10%;">
                                        </div> 
                                        <div class="col-sm-10">
                                          <h4 class="text-white" ><?php echo $verCS['username'] ?></h4>
                                          <p class="text-white"><small><?php echo $verCS['fechaCom'] ?></small></p>
                                          <p class="text-white"><?php echo $verCS['comSoft'] ?><p> 
                                          <?php
                                          }
                                          ?>
                                        </div>
                                      
                                    </div>
                                      
                                    </div> <!-- Cierre Media -->
                                  </div><!-- CIERRE SCROLL -->
                                </div>

                              </div><!-- Fin de card body -->
                            </div>
                          </div>
                        </div>
                      <?php
                    

                  }
                }
              }

          }
        }
        ?>










  </body>
  </html>