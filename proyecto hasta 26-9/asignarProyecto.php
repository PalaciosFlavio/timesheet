<?php

ini_set('display errors', 1);
error_reporting(E_ALL);

include('db.php');


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


$consulta = "INSERT INTO `proyecto` (`nombre`, `tipo`, `responsableCom`, `responsableGest`, `fecha_in_ideal`, `fecha_in_real`,
`fecha_fin_ideal`, `fecha_fin_real`, `asigRecursos`, `horas_estimadas`)
 VALUES ('$nombre', '$tipo', '$comercial', '$gestion', '$inicio_ideal', '$inicio_real', '$fin_ideal', '$fin_real', '$asigRecursos', '$dedicacion');";

$resultado = mysqli_query($conexion, $consulta) or die ('error de registro');

echo "consulta exitoso";

mysqli_close($conexion);
header("Location:tareas.html");



?>