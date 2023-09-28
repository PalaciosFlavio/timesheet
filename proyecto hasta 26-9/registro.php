<?php

ini_set('display errors', 1);
error_reporting(E_ALL);

include('db.php');


$nombre = $_POST['txtNombre'];
$apellido = $_POST['txtApellido'];
$disponibilidad = $_POST['txtDisponibilidad'];
$rol = $_POST['txtRol'];

$consulta="INSERT INTO `recursos` (`Nombre`, `Apellido`, `Disponibilidad`, `Rol`)
VALUES ('$nombre', '$apellido', '$disponibilidad', '$rol')";

$resultado = mysqli_query($conexion, $consulta) or die ('error de registro');



mysqli_close($conexion);
header("Location:tareas.html");



?>