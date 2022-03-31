<?php
ob_start();
session_start();
$camp = $_SESSION['username'];
require_once 'php/conexion.php';
include 'loader.html';
include 'boot.php';


if ($camp == null || $camp == '') {
  header("location:index.php");
  die();
}

date_default_timezone_set("America/Mexico_City");
$time = date("h:i a");
$date = date("d-M-Y");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cloud Engine</title>
</head>

<body style="overflow-x:hidden;">

  <?php
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $consulta = $cnx->query("SELECT * FROM software WHERE idSoft='$id'");

    if ($consulta) {
      $cons = $cnx->query("SELECT * FROM usuarios WHERE username='$camp'");
      if ($cons) {
        if ($_SESSION['username'] == 'hugoz178') {
          if ($verA = mysqli_fetch_array($cons)) {
  ?>
            <!-- NAV ADMIN -->
            <nav class="navbar navbar-inverse" style="background-color:black;">
              <div class="container-fluid ">
                <div class="navbar-header">
                  <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#demo">
                    <i class="material-icons" style="font-size:48px;color:#5D00B9">dehaze</i>
                  </button>
                </div>
                <ul class="nav navbar-nav">
                  <h1 style="color:#5D00B9">Cloud Engine</h1>
                </ul>

              </div>
            </nav>

            <div class="offcanvas offcanvas-start" id="demo" style="background-color:#050503">
              <div class="offcanvas-header">
                <center>
                  <h2 class="offcanvas-title text-white" style="text-align: center;">Usuario: <?php echo $camp ?></h2>
                </center>
                <a type="button" class="btn-close" data-bs-dismiss="offcanvas" style='color:#ffffff;'><i class="fas fa-times fa-2x"></i></a>
              </div>
              <div class="offcanvas-body">
                <div class="btn-group-vertical" style="width:280px">
                  <a href="vista_admin.php" class="btn">
                    <h2 style="color:#5D00B9">Inicio</h2>
                  </a>
                  <a href="softwares.php" class="btn">
                    <h2 style="color:#5D00B9">Añadir softwares</h2>
                  </a><br>
                  <a href="configuracion.php" class="btn">
                    <h2 style="color:#5D00B9">Configuración</h2>
                  </a><br>
                  <a href="logout.php" class="btn">
                    <h2 style="color:#5D00B9">Cerrar sesión</h2>
                  </a>
                </div>
              </div>
            </div>
          <?php
          }
        } else {
          if ($cons) {
          ?>
            <!-- NAV USUARIO -->
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
                <center>
                  <h2 class="offcanvas-title text-white" style="text-align: center;">Usuario: <?php echo $camp ?></h2>
                </center>
                <a type="button" class="btn-close" data-bs-dismiss="offcanvas" style='color:#ffffff;'><i class="fas fa-times fa-2x"></i></a>
              </div>
              <div class="offcanvas-body">
                <div class="btn-group-vertical" style="width:280px">
                  <a href="vista_usuario.php" class="btn">
                    <h2 style="color:#5D00B9">Inicio</h2>
                  </a><br>
                  <a href="ver_carrito.php" class="btn">
                    <h2 style="color:#5D00B9">Mi carrito</h2>
                  </a><br>
                  <a href="configuracion.php" class="btn">
                    <h2 style="color:#5D00B9">Configuración</h2>
                  </a><br>
                  <a href="logout.php" class="btn">
                    <h2 style="color:#5D00B9">Cerrar sesión</h2>
                  </a>
                </div>
              </div>
            </div>
      <?php
          }
        }
      }
      ?>

      <div class="d-none d-lg-block">
        <div class="container">
          <div class="row gx-2 ">

            <div class="col-md-4">
              <div class="p-5 text-center bg-light">
                <?php
                $consultaA = $cnx->query("SELECT * FROM software WHERE idSoft='$id'");
                if ($ver = mysqli_fetch_array($consultaA)) {   ?>
                  <form action="car.php?idS=<?php echo $ver['idSoft'] ?>" method="POST">
                    <h1 class="card-tittle">
                      <?php echo $ver['nombreSoft'] ?>
                    </h1>
                    <?php echo '<img src="' . $ver['fotoSoft'] . '" class="card-img-top" alt="photo" style="width:200px; height:200px;">' ?>
                    <br><br>
                    <p class="card-text" style="font-size: 15px;">
                      <?php echo $ver['descripcionSoft'] ?>
                    </p>
                    <p class="card-text" style="font-size: 15px;">
                      Precio del software: <?php echo $ver['costoSoft'] ?>
                    </p>
                    <p class="card-text" style="font-size: 15px;">
                      Categoria del software <?php echo $ver['categoriaSoft'] ?>
                    </p>
                    <?php
                    $cons = $cnx->query("SELECT * FROM usuarios WHERE username='$camp'");
                    if ($cons) {
                      if ($_SESSION['username'] == 'hugoz178') {
                        if ($verBA = mysqli_fetch_array($cons)) {
                        }
                      } else {
                        if ($cons) {
                          $boton = $cnx->query("SELECT idS, usuario FROM compras WHERE usuario = '$camp' AND idS = '$id'");
                          if ($busqueda = mysqli_fetch_array($boton)) {
                            $username = $busqueda['usuario'];
                            $idsoft = $busqueda['idS'];
                            if ($username and $idsoft == true) {
                              echo '<p>Ya compraste este producto</p>';
                            }
                          } else {
                            echo '<button class="btn btn-primary">Agregar al carrito</button>';
                          }
                        }
                      }
                    }
                    ?>
                  </form>
                <?php } ?>
              </div>
            </div>

            <div class="col-md-8">
              <div class="p-5 text-center bg-light">
                <h1>Comentarios</h1>
                <p style="font-size: 20px;">Escribe tu comentario: </p>
                <?php
                if (isset($_POST['subircom'])) {
                  if (!empty($_POST['comentario'])) {
                    mysqli_query($cnx, "INSERT into comentarios values ( ' ', '$id', '$camp', '$date', '$time', '$_POST[comentario]')");
                  }
                }
                ?>
                <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
                  <textarea id="comentario" name="comentario" class="form-control" placeholcer="ingresa comentario" row="5" maxlength="100"></textarea>
                  <br>
                  <input type="submit" class="form-control btn btn-primary" name="subircom" value="Enviar comentario">
                </form>
                <br>
                <?php
                $conCom = $cnx->query("SELECT * FROM usuarios WHERE username='$camp'");
                if ($conCom) {
                  if ($_SESSION['username'] == 'hugoz178') {
                    $comA = $cnx->query("SELECT * FROM usuarios WHERE username='$camp'");
                    if ($comA) {
                ?>
                      <div id="Layer1" style="width:100%; height:200px; overflow: auto; border: 1px solid #ffffff;">
                        <center>
                          <table>
                            <br>
                            <tr>
                              <?php
                              $con = 0;
                              $consCA = $cnx->query("SELECT * FROM comentarios WHERE idSoft='$id' ORDER BY comSoft asc");
                              while ($verCA = mysqli_fetch_array($consCA)) {
                              ?>
                                <td>
                                  <?php echo '
                                  <div class="card" style="width:250px; border: 1px solid #5D00B9">
                                  <div class="card-body">
                                    <h4 >' . $verCA['username'] . ' </h4>
                                    <p><small>' . $verCA['fechaCom'] . '</small></p>
                                    <p><small>' . $verCA['comSoft'] . '</small></p>
                                    <a type="button" class="btn" style="background-color:#5D00B9; color: white;" href="BorrarComentario.php?id=' . $verCA['idCom'] . '">Borrar comentario</a>
                                  </div>
                                  </div>';
                                  ?>
                                </td>
                              <?php
                                $con = $con + 1;
                                if ($con == 2) {
                                  echo "</tr>
													      <tr>";
                                  $con = 0;
                                }
                              }
                              ?>
                            </tr>
                          </table>
                        </center>
                      </div>
                    <?php
                    }
                  } else {
                    $comU = $cnx->query("SELECT * FROM usuarios WHERE username='$camp'");
                    if ($comU) {
                    ?>
                      <div id="Layer1" style="width:100%; height:200px; overflow: auto; border: 1px solid #ffffff;">
                        <center>
                          <table>
                            <br>
                            <tr>
                              <?php
                              $con = 0;
                              $consCS = $cnx->query("SELECT * FROM comentarios WHERE idSoft='$id'");
                              while ($verCS = mysqli_fetch_array($consCS)) {
                              ?>
                                <td>
                                  <?php echo '
													<div class="card" style="width:250px; border: 1px solid #5D00B9">
													<div class="card-body">
                          <h4>' . $verCS['username'] . '</h4>
                          <p><small>' . $verCS['fechaCom'] . '</small></p>
                          <p>' . $verCS['comSoft'] . '</p>
													</div>
												</div>';
                                  ?>
                                </td>
                              <?php
                                $con = $con + 1;
                                if ($con == 2) {
                                  echo "</tr>
													<tr>";
                                  $con = 0;
                                }
                              }
                              ?>
                            </tr>
                          </table>
                        </center>
                      </div>
                <?php
                    }
                  }
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="d-lg-none">
        <div class="container">
          <div class="row gx-2 ">

            <div class="col-md-4">
              <div class="p-5 text-center bg-light">
                <?php
                $consultaA = $cnx->query("SELECT * FROM software WHERE idSoft='$id'");
                if ($ver = mysqli_fetch_array($consultaA)) {   ?>
                  <form action="car.php?idS=<?php echo $ver['idSoft'] ?>" method="POST">
                    <h1 class="card-tittle">
                      <?php echo $ver['nombreSoft'] ?>
                    </h1>
                    <?php echo '<img src="' . $ver['fotoSoft'] . '" class="card-img-top" alt="photo" style="width:200px; height:200px;">' ?>
                    <br><br>
                    <p class="card-text" style="font-size: 15px;">
                      <?php echo $ver['descripcionSoft'] ?>
                    </p>
                    <p class="card-text" style="font-size: 15px;">
                      Precio del software: <?php echo $ver['costoSoft'] ?>
                    </p>
                    <p class="card-text" style="font-size: 15px;">
                      Categoria del software <?php echo $ver['categoriaSoft'] ?>
                    </p>
                    <?php
                    $cons = $cnx->query("SELECT * FROM usuarios WHERE username='$camp'");
                    if ($cons) {
                      if ($_SESSION['username'] == 'hugoz178') {
                        if ($verBA = mysqli_fetch_array($cons)) {
                        }
                      } else {
                        if ($cons) {
                          $boton = $cnx->query("SELECT idS, usuario FROM compras WHERE usuario = '$camp' AND idS = '$id'");
                          if ($busqueda = mysqli_fetch_array($boton)) {
                            $username = $busqueda['usuario'];
                            $idsoft = $busqueda['idS'];
                            if ($username and $idsoft == true) {
                              echo '<p>Ya compraste este producto</p>';
                            }
                          } else {
                            echo '<button class="btn btn-primary">Agregar al carrito</button>';
                          }
                        }
                      }
                    }
                    ?>
                  </form>
                <?php } ?>
              </div>
            </div>

            <div class="col-md-8">
              <div class="p-5 text-center bg-light">
                <h1>Comentarios</h1>
                <p style="font-size: 20px;">Escribe tu comentario: </p>
                <?php
                if (isset($_POST['subircom'])) {
                  if (!empty($_POST['comentario'])) {
                    mysqli_query($cnx, "INSERT into comentarios values ( ' ', '$id', '$camp', '$date', '$time', '$_POST[comentario]')");
                  }
                }
                ?>
                <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
                  <textarea id="comentario" name="comentario" class="form-control" placeholcer="ingresa comentario" row="5" maxlength="100"></textarea>
                  <br>
                  <input type="submit" class="form-control btn btn-primary" name="subircom" value="Enviar comentario">
                </form>
                <br>
                <?php
                $conCom = $cnx->query("SELECT * FROM usuarios WHERE username='$camp'");
                if ($conCom) {
                  if ($_SESSION['username'] == 'hugoz178') {
                    $comA = $cnx->query("SELECT * FROM usuarios WHERE username='$camp'");
                    if ($comA) {
                ?>
                      <div id="Layer1" style="width:100%; height:550px; overflow: auto; border: 1px solid #ffffff;">
                        <center>
                          <table>
                            <br>
                            <tr>
                              <?php
                              $con = 0;
                              $consCA = $cnx->query("SELECT * FROM comentarios WHERE idSoft='$id' ORDER BY comSoft asc");
                              while ($verCA = mysqli_fetch_array($consCA)) {
                              ?>
                                <td>
                                  <?php echo '
                                  <div class="card" style="width:245px; border: 1px solid #5D00B9">
                                  <div class="card-body">
                                    <h4>' . $verCA['username'] . ' </h4>
                                    <p><small>' . $verCA['fechaCom'] . '</small></p>
                                    <p><small>' . $verCA['comSoft'] . '</small></p>
                                    <a type="button" class="btn" style="background-color:#5D00B9; color: white;" href="BorrarComentario.php?id=' . $verCA['idCom'] . '">Borrar comentario</a>
                                  </div>
                                  </div>';
                                  ?>
                                </td>
                              <?php
                                $con = $con + 1;
                                if ($con == 1) {
                                  echo "</tr>
													      <tr>";
                                  $con = 0;
                                }
                              }
                              ?>
                            </tr>
                          </table>
                        </center>
                      </div>
                    <?php
                    }
                  } else {
                    $comU = $cnx->query("SELECT * FROM usuarios WHERE username='$camp'");
                    if ($comU) {
                    ?>
                      <div id="Layer1" style="width:100%; height:200px; overflow: auto; border: 1px solid #ffffff;">
                        <center>
                          <table>
                            <br>
                            <tr>
                              <?php
                              $con = 0;
                              $consCS = $cnx->query("SELECT * FROM comentarios WHERE idSoft='$id'");
                              while ($verCS = mysqli_fetch_array($consCS)) {
                              ?>
                                <td>
                                  <?php echo '
													<div class="card" style="width:245px; border: 1px solid #5D00B9">
													<div class="card-body">
                          <h4>' . $verCS['username'] . '</h4>
                          <p><small>' . $verCS['fechaCom'] . '</small></p>
                          <p>' . $verCS['comSoft'] . '</p>
													</div>
												</div>';
                                  ?>
                                </td>
                              <?php
                                $con = $con + 1;
                                if ($con == 1) {
                                  echo "</tr>
													<tr>";
                                  $con = 0;
                                }
                              }
                              ?>
                            </tr>
                          </table>
                        </center>
                      </div>
                <?php
                    }
                  }
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
  <?php
    }
  }
  ?>
</body>

</html>