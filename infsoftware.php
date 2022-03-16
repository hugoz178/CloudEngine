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
  <title></title>
</head>
<body style="overflow-x:hidden;">

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
                      <div class="container-fluid mt-3">
                        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#demo">
                          Admin
                        </button>
                      </div>
                          </div>
                        </nav> 
                        <div class="offcanvas offcanvas-start" id="demo">
                          <div class="offcanvas-header">
                            <h1 class="offcanvas-title"><?php echo $camp ?></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                          </div>
                          <div class="offcanvas-body">
                            <p>Admin</p>
                            <a href="vista_admin.php">Inicio</a><br>
                            <a href="softwares.php">Ver Softwares</a><br>
                            <a href="logout.php">cerrar</a><br>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-4" style="background-color:seagreen;">
                            <div class="card">
                              <div class="card-body">
                                <?php 
                                $consultaA=$cnx->query("SELECT * FROM software WHERE idSoft='$id'");
                                if ($ver=mysqli_fetch_array($consultaA)) {             ?>
                                <h1 class="card-tittle display-6">
                                  <?php echo $ver['nombreSoft'] ?>
                                </h1>
                                <p class="card-text">
                                  Descripcion de: 
                                </p>
                                <p class="card-text">
                                  Su precio es de: Costo
                                </p>
                                <p class="card-text">
                                  Categoria
                                </p>                    
                                <?php } ?> 
                              </div>
                            </div>
                          </div>
                          <div class="col-md-8" style="background-color:skyblue;">
                            <div class="card">
                              <div class="card-body">
                                <div class="container mt-3">
                                  <h1 class="display-6">Comentarios</h1>
                                  <p>Comentarios de </p>
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
                                    <label id="image">nombre</label><br>
                                    <img src="https://i.pinimg.com/originals/bb/3d/43/bb3d43fa506c564d150130d91ed4b21b.jpg" style="width:75px" id="image" >
                                        </div>
                                        <div class="col-sm-10">
                                          <label id="comentario">Comentario</label>
                                          <textarea id="comentario" name="comentario" class="form-control" placeholcer="ingresa comentario" row="5" style="height:60px; resize: none;"></textarea>
                                          <input type="submit" name="subircom">
                                        </div>
                                    </div>
                                  </form>
                                </div>
                                <!-- VER COMENTARIOS VISTA ADMIN -->
                                <div class="container mt-3">
                                  <div class="container-fluid" id="Layer1" style="width:100%; height:480px; overflow: scroll;">
                                    <div class="media">
                                      <div class="row">
                                      <?php

                                      $consCA=$cnx->query("SELECT * FROM comentarios WHERE idSoft='$id'");
                                      while ($verCA=mysqli_fetch_array($consCA)) {
                                      ?>
                                        <div class="col-sm-4">
                                          <img src="https://i.pinimg.com/originals/bb/3d/43/bb3d43fa506c564d150130d91ed4b21b.jpg"  class="mr-3 mt-3" style="width:10%;">
                                        </div>
                                        <div class="col-sm-10">
                                          <h4><?php echo $verCA['username'] ?></h4>
                                          <p><small><?php echo $verCA['fechaCom'] ?></small></p>
                                          <p><?php echo $verCA['comSoft'] ?><p>
                                          <?php echo '<a type="button" class="btn btn-danger" href="BorrarComentario.php?id='.$verCA['idCom'].'">Quitar producto</a>' ?>
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
                      <nav class="navbar navbar-inverse" style="background-color:black;">
                          <div class="container-fluid ">
                      <div class="container-fluid mt-3">
                        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#demo2">
                          User
                        </button>
                      </div>
                          </div>
                        </nav> 
                        <div class="offcanvas offcanvas-start" id="demo2">
                          <div class="offcanvas-header">
                            <h1 class="offcanvas-title">Heading</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                          </div>
                          <div class="offcanvas-body">
                            <p>Usuario</p>
                            <a href="vista_usuario.php">Inicio</a><br>
                            <a href="logout.php">Cerrar Sesión</a>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4" style="background-color:seagreen;">
                            <div class="card">
                              <div class="card-body">
                                <?php 
                                $consultaA=$cnx->query("SELECT * FROM software WHERE idSoft='$id'");
                                if ($ver=mysqli_fetch_array($consultaA)) {             ?>
                                <h1 class="card-tittle display-6">
                                  <?php echo $ver['nombreSoft'] ?>
                                </h1>
                                <p class="card-text">
                                  Descripcion de: 
                                </p>
                                <p class="card-text">
                                  Su precio es de: Costo
                                </p>
                                <p class="card-text">
                                  Categoria
                                </p>                    
                                <?php } ?>                    
                              </div>
                            </div>
                          </div>
                          <div class="col-md-8" style="background-color:skyblue;">
                            <div class="card">
                              <div class="card-body">
                                <div class="container mt-3">
                                  <h1 class="display-6">Comentarios</h1>
                                  <p>Comentarios de </p>
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
                                    <label id="image">nombre</label><br>
                                    <img src="https://i.pinimg.com/originals/bb/3d/43/bb3d43fa506c564d150130d91ed4b21b.jpg" style="width:75px" id="image" >
                                    </div>
                                        <div class="col-sm-10">
                                          <label id="comentario">Comentario</label>
                                          <textarea id="comentario" name="comentario" class="form-control" placeholcer="ingresa comentario" row="5" style="height:60px; resize: none;"></textarea>
                                          <input type="submit" name="subircom">
                                        </div>
                                    </div>
                                  </form>
                                </div>

                                <!-- VER COMENTARIOS VISTA USUARIO -->
                                <div class="container mt-3">
                                  <div class="container-fluid" id="Layer1" style="width:100%; height:480px; overflow: scroll;">
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
                                          <h4><?php echo $verCS['username'] ?></h4>
                                          <p><small><?php echo $verCS['fechaCom'] ?></small></p>
                                          <p><?php echo $verCS['comSoft'] ?><p> 
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