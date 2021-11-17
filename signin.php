<?php require_once('../Connections/conexion.php'); ?>
<?php
$nombr = strtoupper($_POST['nombre']);
$corre = $_POST['correo'];
$clave = $_POST['contra'];
$fenac = $_POST['fechas'];
$gener = $_POST['radio2'];
session_start();
$grupo = $_SESSION['GRUPO'];
mysqli_select_db($conexion,$database_conexion);
$sqa = "INSERT INTO usuarios (nombre, correo, clave, fechanac, genero, grupo)
values ('$nombr', '$corre', '$clave', '$fenac', '$gener', '$grupo')";
$ejecuta = mysqli_query($conexion, $sqa);
header('location:../grupo09/login.html');

?> 
