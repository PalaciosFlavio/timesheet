<?php 
include('db.php');

$cod_recursos=$_POST['txtID'];
mysqli_query($conexion, "DELETE FROM recursos WHERE cod_recursos = '$cod_recursos'") or die ("error al eliminar");

mysqli_close($conexion);
header("location:mostrar.php");
?>