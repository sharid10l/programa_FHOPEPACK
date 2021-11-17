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
$anno1 = date("Y");
$mess1 = date("m");
$dias1 = date("d");
$hoyes = mktime(0,0,0,$mess1,$dias1,$anno1);

session_start();
if (isset($_SESSION['TELEF'])) {} else {$_SESSION['TELEF'] = "3";}
if (isset($_SESSION['DIREC'])) {} else {$_SESSION['DIREC'] = "";}
if (isset($_SESSION['PRECI'])) {} else {$_SESSION['PRECI'] = "$";}

mysqli_select_db($conexion,$database_conexion);
$query_Recordset1 = "SELECT * FROM picker";
$Recordset1 = mysqli_query($conexion, $query_Recordset1) or die(mysql_error());
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);

$query_Recordset2 = "SELECT * FROM master ORDER BY autonume DESC";
$Recordset2 = mysqli_query($conexion, $query_Recordset2) or die(mysql_error());
$row_Recordset2 = mysqli_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysqli_num_rows($Recordset2);

?>
<!doctype html>
<html lang="es">
<html class="">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Inicio</title>
</head>
<body bgcolor="#CCCCCC">
<header>
<div align="center">
<h3>P_I_C_K_E_R</h3>
</header>
<body background="fondoazul.png">
<section id = "seccion">
<article>
 </div>
 <form action="picker2.php" method="post" name="formal">

<table border="10" bordercolor="#060606">
    <tr>
    <td>FECHA DE AGENDACION</td>
    <td><label><input required name="fechas" value="<?php echo date("Y-m-d", $hoyes); ?>" type="date"  id="cod1" /></label></td>
    <td rowspan="15">
    <select name="lamast" id="zona" size = "25" > <option selected disabled></option>
<?php do { ?>
<option value="<?php echo $row_Recordset2['autonume']; ?>"><?php echo $row_Recordset2['campo4']; ?></option>

<?php
} while ($row_Recordset2 = mysqli_fetch_assoc($Recordset2));
?>
</select>
    </td>
    </tr>
    <tr>
    <td>TELEFONOS </td>
    <td><label><input required name="telefo" type="text" value="<?php echo $_SESSION['TELEF']; ?>"  id="cod2" maxlength="40" size="40" /></label></td>
    </tr>
    <tr>
    <td>DIRECCION DE ENVIO</td>
    <td><label><input required name="direcc" type="text" value="<?php echo $_SESSION['DIREC']; ?>"  id="cod3" maxlength="40" size="40" /></label></td>
    </tr>
    <tr>
    <td>QUE DINERO DESEAS DIRIGIR A LA DONACION mesa </td>
    <td><label><input required name="precio" type="text"  id="cod3"  value="<?php echo $_SESSION['PRECI']; ?>" maxlength="40" size="40" /></label></td>
    </tr>
	<tr>
    	<td>lista de productos</td>
        <td><select name="items1" id="zona" size = "10" > <option selected disabled></option>
<?php do { ?>
<option value="<?php echo $row_Recordset1['autonume']; ?>"><?php echo $row_Recordset1['detalle']; ?></option>

<?php
} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1));
?>
</select></td>
    </tr>
</table>    
<input type="image" src="../imagenes/Botonenviar.PNG" name="sub" />
</form>

<a href="../grupo20/menu.html" ><img src="../imagenes/menu.PNG"></a>
</article>
</section>
</body>
</html>
<?php
mysqli_free_result($Recordset1);
?>

