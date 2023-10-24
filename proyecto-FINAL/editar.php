<?php
include('db.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="header.css">
</head>
<body>
    <div class="container">
        <header class="encabezado">
            <div class="wrap">
                <div class="logos">
                    Timesheet
                </div>
                <nav>
                    <a href="index.html">Login</a>
                    <a href="mostrar.php">Tabla</a>
                </nav>
            </div>
            <br>
        </header>


    <div class="espacio-tabla">
        <table class="table">
  <thead>
    
  </thead>
  <tbody>

<?php
$conexion = mysqli_connect("localhost", "root", "", "empleados");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

$cod_recursos = $_GET["cod_recursos"];
$sql="SELECT * FROM recursos WHERE cod_recursos = '$cod_recursos'";
$result = mysqli_query($conexion,$sql);

while($mostrar = mysqli_fetch_array($result)) {



?>
    <form action="procesar_editar.php" method="POST">
        <input type="hidden" value ="<?php echo $mostrar['cod_recursos'] ?>" name="txtID">
        <p>Nombre</p>
        <input type="text" value ="<?php echo $mostrar['nombre'] ?>" name="txtNombre">
        <p>Apellido</p>
        <input type="text" value ="<?php echo $mostrar['apellido'] ?>" name="txtApellido">
        <p>Disponibilidad</p>
        <input type="text" value ="<?php echo $mostrar['nombre'] ?>" name="txtDisponibilidad">
        <p>Rol</p>
        <input type="text" value ="<?php echo $mostrar['nombre'] ?>" name="txtRol">

    <?php
    }
    ?>
    <input type="submit" values="Actualizar">
    </form>
  </tbody>
</table>
</div>

</body>