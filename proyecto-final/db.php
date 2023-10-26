<?php
$conexion = mysqli_connect("localhost", "root", "", "empleados");



if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

?>
