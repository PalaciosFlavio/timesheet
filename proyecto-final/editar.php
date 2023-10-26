<?php
include('db.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="http://localhost/proyecto/assets/style.css">
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
                    <a href="mostrar.php">Tabla de usuarios</a>
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
                    $sql = "SELECT * FROM recursos WHERE cod_recursos = '$cod_recursos'";
                    $result = mysqli_query($conexion, $sql);

                    while ($mostrar = mysqli_fetch_array($result)) {
                        ?>
                        <form action="procesar_editar.php" method="POST">
                            <input type="hidden" value="<?php echo $mostrar['cod_recursos'] ?>" name="txtID">
                            <p>Nombre</p>
                            <br>
                            <input type="text" value="<?php echo $mostrar['nombre'] ?>" name="txtNombre">
                            <br>
                            <br>
                            <p>Apellido</p>
                            <br>
                            <input type="text" value="<?php echo $mostrar['apellido'] ?>" name="txtApellido">
                            <br>
                            <br>
                            <p>Disponibilidad</p>
                            <br>
                            <input type="text" value="<?php echo $mostrar['disponibilidad'] ?>" name="txtDisponibilidad">
                            <br>
                            <br>
                            <p>Rol</p>
                            <br>
                            <input type="text" value="<?php echo $mostrar['rol'] ?>" name="txtRol">
                            <br>
                            <br>
                        <?php
                    }
                    ?>
                            <input type="submit" value="Actualizar" style="background-color: #3498db; color: #fff; padding: 10px 20px; border: none; cursor: pointer; border-radius: 5px;">
                        </form>
                </tbody>
            </table>
        </div>
    </body>
</html>
