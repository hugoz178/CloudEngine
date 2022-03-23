<?php
ob_start();
session_start();
include 'php/conexion.php';
include 'boot.php';
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

<body>

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
                            <a href="" class="btn">
                                <h2 style="color:#5D00B9">Mi Juegos</h2>
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


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-2 col-md-12">
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
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <?php
                    $consultaA = $cnx->query("SELECT * FROM carrito WHERE usuario='$camp'");
                    while ($ver = mysqli_fetch_array($consultaA)) {   ?>
                        <div class="tbl-content">
                            <table cellpadding="0" cellspacing="0" border="0">
                                <tbody>
                                    <tr>
                                        <?php
                                        echo'
                                        <td><img src="data:image/png;base64,' . base64_encode($ves['fotoSoft']) . '" class="card-img-top" alt="photo" style="width:300px; height:300px;"></td>
                                        <td>'.$ver['nombreSoft'].'</td>
                                        <td>'.$ver['descripcionSoft'].'</td>
                                        <td>'.$ver['categoriaSoft'].'</td>
                                        <td>'.$ver['costoSoft'].'</td>
                                        ';
                                        ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>
                </section>
            </div>

            <div class="col-lg-2 col-md-6">

            </div>
        </div>
    </div>
    <script src="funcion.js"></script>


</body>

</html>