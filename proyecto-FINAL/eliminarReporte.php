<?php 
include('db.php');

$cod_recursos=$_POST['txtID'];
mysqli_query($conexion, "DELETE FROM horas_trabajo WHERE id = '$reporte:id'") or die ("error al eliminar");

mysqli_close($conexion);
header("location:generar_reporte.php");
?>