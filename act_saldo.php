<?php
session_start();
require_once 'php/conexion.php';

$camp = $_SESSION['username'];
$saldo=$_POST['saldo'];

    $sql=("SELECT * FROM saldo where usuario='$camp'");
        $result=mysqli_query($cnx,$sql);
        while($res=mysqli_fetch_array($result))
        {
          $saldo1=$res['saldo'];
          $sus=$res['usuario'];
        }

        if($saldo>0){
            
            if($camp==$sus){
                $tol=$saldo+$saldo1;
                $actualiza="UPDATE saldo SET saldo = '$tol' WHERE usuario = '$camp';";
                $resul= mysqli_query($cnx,$actualiza);
            
                if ($resul) {
            
                     header("Location:saldo.php?correcto=2");
                    
                }
                else{
                    header("Location:ac_saldo.php?error=1");
                }
                }else{
                    header("Location:ac_saldo.php?error=1");
                }

        }else{
            header("Location:ac_saldo.php?error=1");
        }


?>