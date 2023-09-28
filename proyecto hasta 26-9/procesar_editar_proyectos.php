<?php
include('db.php');

$conexion = mysqli_connect("localhost", "root", "", "empleados");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

$cod_proy = $_POST['txtID'];
$nombre = $_POST['txtNombre'];
$tipo = $_POST['txtTipo'];
$comercial = $_POST['txtComercial'];
$gestion = $_POST['txtGestion'];
$inicio_ideal = $_POST['txtInicio_ideal'];
$inicio_real = $_POST['txtInicio_real'];
$fin_ideal = $_POST['txtFin_ideal'];
$fin_real = $_POST['txtFin_real'];
$asigRecursos = $_POST['txtRecursos'];
$dedicacion = $_POST['txtDedicacion'];

mysqli_query($conexion,"UPDATE `proyecto` SET `nombre` = '$nombre', `tipo` = '$tipo',
 `responsableCom` = '$comercial', `responsableGest` = '$gestion', `fecha_in_ideal` = '$inicio_ideal',
  `fecha_in_real` = '$inicio_real', `fecha_fin_ideal` = '$fin_ideal', `fecha_fin_real` = '$fin_real',
   `asigRecursos` = '$asigRecursos', `horas_estimadas` = '$dedicacion' WHERE `proyecto`.`cod_proy` = '$cod_proy'") or die ("error de actualizacion");




mysqli_close($conexion);
header("Location:mostrarProyectos.php");
?>