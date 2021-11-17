<?php require_once('../Connections/conexion.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$fecha = $_POST['fechas'];
if (isset($_POST['lamast'])) {
	$maste = $_POST['lamast'];
} else {
	$maste = 0;
}
$telef = $_POST['telefo'];
$direc = $_POST['direcc'];
$preci = $_POST['precio'];
if (isset($_POST['items1'])) {
	$items = $_POST['items1'];
} else {
	$items = 0;
}
session_start();
$corre = $_SESSION['CORRE'];
if ($items > 0)
{

mysqli_select_db($conexion,$database_conexion);
$query_Recordset1 = "SELECT * FROM picker WHERE autonume = '$items'";
$Recordset1 = mysqli_query($conexion, $query_Recordset1) or die(mysql_error());
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);	
if ($totalRows_Recordset1 > 0) {
	$detal = $row_Recordset1['detalle'];	
	$sqa = "INSERT INTO master (fecha, campo1, campo2, campo3, campo4, campo5) values ('$fecha', '$telef', '$direc', '$preci', '$detal', '$corre')";
	$ejecuta = mysqli_query($conexion, $sqa);
}
}
if ($maste > 0)
{
$sqb = "DELETE FROM master WHERE autonume = '$maste'";
$ejecuta = mysqli_query($conexion, $sqb);
}
session_start();
$_SESSION['FECHA'] = $fecha;
$_SESSION['TELEF'] = $telef;
$_SESSION['DIREC'] = $direc;

header("location:../grupo09/picker.php");?>

