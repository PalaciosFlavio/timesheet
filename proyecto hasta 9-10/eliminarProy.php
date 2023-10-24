<?php

include('db.php');
$cod_proy = $_POST['txtID'];

mysqli_query($conexion, "DELETE FROM proyecto WHERE cod_proy = '$cod_proy'") or die ("error al eliminar");

mysqli_close($conexion);
header("location:mostrarProyectos.php");

?>