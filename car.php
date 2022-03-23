<?php
ob_start() ;
session_start();
require_once 'php/conexion.php';

$camp = $_SESSION['username']; 

$idS=$_REQUEST['idSoft'];

echo $camp;
echo $idS;