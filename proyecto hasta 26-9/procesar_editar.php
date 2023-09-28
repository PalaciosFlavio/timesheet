<?php
include('db.php');

$conexion = mysqli_connect("localhost", "root", "", "empleados");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

$cod_recursos = $_POST['txtID'];
$nombre = $_POST['txtNombre'];
$apellido = $_POST['txtApellido'];
$disponibilidad = $_POST['txtDisponibilidad'];
$rol = $_POST['txtRol'];

mysqli_query($conexion, "UPDATE `recursos` SET `nombre` = '$nombre',
 `apellido` = '$apellido', `disponibilidad` = 
 '$disponibilidad', `rol` = '$rol' WHERE `cod_recursos` 
 = '$cod_recursos'") or die("error de actualizar");

mysqli_close($conexion);
header("Location:mostrar.php");
?>