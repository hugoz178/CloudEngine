<?php
ob_start();
session_start();
error_reporting(0);
include 'php/conexion.php';
include 'boot.php';
include 'loader.html';
$camp = $_SESSION['username'];

if ($camp == null || $camp == '') {
    header("location:index.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>

<body style="overflow-x: hidden;">

    <?php
    $cons = $cnx->query("SELECT * FROM usuarios WHERE username='$camp'");
    if ($cons) {
        if ($_SESSION['username'] == 'hugoz178') {
            $consA = $cnx->query("SELECT * FROM usuarios WHERE username='$camp'");
            if ($consA) {
    ?>
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
                            <h2 class="offcanvas-title text-white" style="text-align: center;">Usuario: <?php echo $_SESSION['username'] ?></h2>
                        </center>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div class="btn-group-vertical" style="width:280px">
                            <a href="vista_admin.php" class="btn">
                                <h2 style="color:#5D00B9">Inicio</h2>
                            </a>
                            <a href="softwares.php" class="btn">
                                <h2 style="color:#5D00B9">Añadir softwares</h2>
                            </a><br>
                            <br>
                            <a href="logout.php" class="btn">
                                <h2 style="color:#5D00B9">Cerrar sesión</h2>
                            </a>
                        </div>
                    </div>
                </div>
            <?php
            }
        } else {
            $consU = $cnx->query("SELECT * FROM usuarios WHERE username='$camp'");
            if ($consU) {
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
                        <center>
                            <h2 class="offcanvas-title text-white" style="text-align: center;">Usuario: <?php echo $_SESSION['username'] ?></h2>
                        </center>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div class="btn-group-vertical" style="width:280px">
                            <a href="vista_usuario.php" class="btn">
                                <h2 style="color:#5D00B9">Inicio</h2>
                            </a><br>
                            <a href="misjuegos.php" class="btn">
                                <h2 style="color:#5D00B9">Mi Juegos</h2>
                            </a><br>
                            <a href="configuracion.php" class="btn">
                                <h2 style="color:#5D00B9">Configuración</h2>
                            </a><br>                            
                            <?php
                            $sql = ("SELECT * FROM saldo where usuario='$camp'");
                            $result = mysqli_query($cnx, $sql);
                            while ($res = mysqli_fetch_array($result)) {
                                $saldo = $res['saldo'];

                            }
                            if ($saldo == 0) {
                                echo '
                                <a href="saldo.php" class="btn">
                                <h3 style="color:#5D00B9">Agregar saldo</h3>
                                <h3 style="color:#5D00B9"><i class="fas fa-plus"><span class="counter"> $ 0</span></i></h3>
                                </a>';
                            } else {
                                $sql2 = $cnx->query("SELECT * FROM saldo where usuario='$camp'");
                                while ($row1 = mysqli_fetch_array($sql2)) {
                                    echo '
                                    <a href="saldo.php" class="btn">
                                    <h3 style="color:#5D00B9">Agregar saldo</h3>
                                    <h3 style="color:#5D00B9"><i class="fas fa-plus"><span class="counter"> $ ' . $row1['saldo'] . '</span></i></h3>
                                    </a>';
                                }
                            }
                            ?>           
                            <br><br><br>                 
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


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-1 col-md-12">
            <?php
      if (isset($_GET['error'])) {
        echo "<center><div class='alert alert-danger'>Error al Comprar</div></center><br>";
      }
    
      if (isset($_GET['correcto'])) {
       echo "<center><div class='alert alert-success'>Compra con exito</div></center><br>";
      }
      ?>
            </div>

            <div class="col-lg-8 col-md-6">
                <section>
                    <!--for demo wrap-->
                    <h1>Carrito de compras</h1>
                    <div class="tbl-header">
                        <table cellpadding="0" cellspacing="0" border="0">
                            <thead>
                                <tr>
                                    <th>Foto</th>
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
                                    <th>categoria</th>
                                    <th>precio</th>
                                    <th>Borrar</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="tbl-content">
                        <table cellpadding="0" cellspacing="0" border="0">
                            <tbody>
                                <?php
                                $consultaA = $cnx->query("SELECT * FROM carrito WHERE usuario='$camp'");
                                while ($ver = mysqli_fetch_array($consultaA)) {
                                    echo '
                                        <tr>
                                        <td> <img src="'.$ver['fotoSoft'].'" width="50px" heigth="50px"></td>
                                        <td>' . $ver['nombreSoft'] . '</td>
                                        <td>' . $ver['descripcionSoft'] . '</td>
                                        <td>' . $ver['categoriaSoft'] . '</td>
                                        <td>$' . $ver['costoSoft'] . '</td>
                                        <td><a type="button" class="btn btn-danger" href="elicar.php?id=' . $ver['idS'] . '">X</a></td>
                                        </tr>
                                        ';
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>

            <div class="col-lg-3 col-md-6">
                <div style="width: 200px; height: 90px; position: absolute; top: 50%; background-color: rgba(255,255,255,0.3); text-align: center;">
                    <br>
                    <form method="POST" action="comprar.php">
                        <?php
                        $camp = $_SESSION['username'];
                        $qu = "SELECT SUM(costoSoft) as co from carrito where usuario='$camp' ";

                        if ($r = mysqli_query($cnx, $qu)) {

                            $da = mysqli_fetch_assoc($r);
                        }

                        if ($da['co'] == 0) {
                            echo '<b>$0</b>&nbsp;&nbsp;&nbsp;';
                        } else {
                            echo '<b>$' . $da['co'] . '</b>&nbsp;&nbsp;&nbsp;';
                        }


                        $sql = ("SELECT * FROM saldo where usuario='$camp'");
                        $result = mysqli_query($cnx, $sql);
                        while ($res = mysqli_fetch_array($result)) {
                            $saldo = $res['saldo'];
                        }

                        if ($saldo == 0) {
                            echo '<a class="btn btn-warning" href="saldo.php">Agregar saldo</a>';
                        } else {
                            if ($saldo < $da['co']) {
                                echo '<a class="btn btn-warning" href="saldo.php">Agregar saldo</a>';
                            } else {
                                echo '<button type="submit" class="btn btn-success">Comprar</button>';
                            }
                        }

                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="funcion.js"></script>


</body>

</html>