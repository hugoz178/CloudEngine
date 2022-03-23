<?php
session_start();
require_once 'php/conexion.php';

$camp = $_SESSION['username']; 

$idS=$_REQUEST['idS'];

$sql=("SELECT * from software where idSoft='$idS'");
        $result=mysqli_query($cnx,$sql);
        while($res=mysqli_fetch_array($result))
        {
        	$nombre=$res['nombreSoft'];
        	$foto=$res['fotoSoft'];
        	$descripcion=$res['descripcionSoft'];
        	$costo=$res['costoSoft'];
        	$categoria=$res['categoriaSoft'];
            $id=$res['idSoft'];

        }


        echo $foto;


        // $carrito="INSERT INTO carrito (idS, nombreSoft, fotoSoft, descripcionSoft, costoSoft, CategoriaSoft, usuario) 
        // VALUES ('$id','$nombre','','$descripcion','$costo', '$categoria','$camp');";
        
        // $resultado = mysqli_query($cnx,$carrito);
        
        // if ($resultado) {
        //     echo "<center><h1 clase='bg-dark'>Se agrego al carrito con exito</h1></center>";
        // }else{
        //     echo "<center><h1 clase='bg-dark'>No se agrego al carrito con exito</h1></center>";
        
        // }