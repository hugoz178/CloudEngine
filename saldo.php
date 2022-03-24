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
    <title>Cloud Engine</title>
</head>

<body style="background: -webkit-linear-gradient(left, #5D00B9, #aa63f1); background: linear-gradient(to right, #5D00B9, #aa63f1); overflow-x: hidden;">
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
                            <a href="ver_carrito.php" class="btn">
                                <h2 style="color:#5D00B9">Mi carrito</h2>
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
        <div class="row">
            <div class="col-md-3"></div>

            <div class="col-md-7">
                <center>
                <?php
                        if (isset($_GET['correcto'])) {
                            echo "<center>
                            <div class='alert' style='width: 500px; height: 90px; position: absolute; top: 15%; background-color: rgba(255,255,255,0.3); text-align: center;'>
                            <h3>saldo recargado con exito</h3>
                            </div>
                            </center>
                            <br>";
                        }
                        ?>
                    <div class="text-center" style="width: 500px; height: 300px; position: absolute; top: 30%; background-color: rgba(255,255,255,0.3); text-align: center;">
                        <h1 class="h1">Cuentas con:</h1>
                        <?php
                        $camp = $_SESSION['username'];
                        $sql = ("SELECT * FROM saldo where usuario='$camp'");
                        $result = mysqli_query($cnx, $sql);
                        while ($res = mysqli_fetch_array($result)) {
                            $saldo = $res['saldo'];
                        }
                        if ($saldo == 0) {
                            echo '<h1 class="h1">$0</h1>';
                        } else {
                            $sql2 = $cnx->query("SELECT * FROM saldo where usuario='$camp'");
                            while ($row1 = mysqli_fetch_array($sql2)) {
                                echo '<h1 class="h1"><b>$' . $row1['saldo'] . '</b></h1>';
                            }
                        }
                        ?>
                        <h3 class="h3">Deseas agregar mas saldo a tu cuenta</h3>
                        <hr class="my-4">
                        <div class="pt-2">
                            <?php
                            if ($saldo <= 0) {
                                echo '<a class="btn btn-success" href="ag_saldo.php">Agregar saldo</a>';
                            } else {
                                echo '<a class="btn btn-success" href="ac_saldo.php">Agregar mas saldo</a>';
                            }
                            ?>
                        </div>
                    </div>
                </center>
            </div>

            <div class="col-md-2"></div>
        </div>
    </div>

</body>

</html>