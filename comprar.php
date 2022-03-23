<?php
session_start();
require_once 'php/conexion.php';

$camp = $_SESSION['username'];

$sql=("SELECT * FROM saldo where usuario='$camp'");
        $result=mysqli_query($cnx,$sql);
        while($res=mysqli_fetch_array($result))
        {
          $saldo1=$res['saldo'];
          $sus=$res['usuario'];
        }
        $qu = "SELECT SUM(costoSoft) as co from carrito where usuario='$camp' ";

                        if ($r = mysqli_query($cnx, $qu)) {

                            $da = mysqli_fetch_assoc($r);
                        }


if($camp==$sus){
    $tu=$saldo1-$da['co'];

    $actua="UPDATE saldo SET saldo='$tu' WHERE usuario= '$camp';";
    $resul= mysqli_query($cnx,$actua);

    if($resul){

        $compra=("INSERT INTO compras SELECT * FROM carrito WHERE usuario='$camp'");
        $resultado=mysqli_query($cnx, $compra);

        if($resultado){

            if($tu==0){

                $elim1=("DELETE FROM saldo WHERE usuario='$camp'");
                $re1=mysqli_query($cnx,$elim1);

                if($re1){

                    $elim=("DELETE FROM carrito WHERE usuario='$camp'");
                    $re=mysqli_query($cnx,$elim);

                    if($re){

                        header("location:ver_carrito.php?correcto=1");

                    }else{

                        header("location:ver_carrito.php?error=1");

                    }

                }else{

                    header("location:ver_carrito.php?error=1");

                }

            }else{

                $elim2=("DELETE FROM carrito WHERE usuario='$camp'");
                $res2=mysqli_query($cnx,$elim2);

                if($re2){

                    header("location:ver_carrito.php?correcto=1");

                }else{
                    header("location:ver_carrito.php?error=1");
                }

            }

        }else{

            header("location:ver_carrito.php?error=1");

        }

    }else{

        header("location:ver_carrito.php?error=1");

    }

}else{

    header("location:ver_carrito.php?error=1");

}