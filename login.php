<?php require_once('../Connections/conexion.php'); ?>
<?php
$usuar = $_POST['codigo'];
$contr = $_POST['contra'];
session_start();
mysqli_select_db($conexion,$database_conexion);
$query_Recordset1 = "SELECT * FROM usuarios WHERE correo = '$usuar' and clave = '$contr'";
$Recordset1 = mysqli_query($conexion, $query_Recordset1) or die(mysql_error());
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);
if ($totalRows_Recordset1 > 0)
{
$_SESSION['CORRE'] = $usuar;
header("location:../grupo09/menu.html");
}
else
{
header("location:../grupo09/login.html ");
}
?>