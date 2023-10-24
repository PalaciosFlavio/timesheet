<?php
$conexion = mysqli_connect("localhost", "root", "", "empleados");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

if (isset($_POST['taskNombreTarea'], $_POST['taskDescription'], $_POST['taskHours'], $_POST['taskAsignar'])) {
    $nombreTarea = $_POST['taskNombreTarea'];
    $descripcionTarea = $_POST['taskDescription'];
    $horasTarea = $_POST['taskHours'];
    $asignadoA = $_POST['taskAsignar'];

    $sqlVerificar = "SELECT COUNT(*) as count FROM recursos WHERE cod_recursos = '$asignadoA'";
    $resultVerificar = mysqli_query($conexion, $sqlVerificar);
    $rowVerificar = mysqli_fetch_assoc($resultVerificar);

    if ($rowVerificar['count'] > 0) {
        $sqlInsert = "INSERT INTO tareas (nombre, descripcion, horas_requeridas, asignado_a) VALUES ('$nombreTarea', '$descripcionTarea', $horasTarea, '$asignadoA')";
        if (mysqli_query($conexion, $sqlInsert)) {
            echo "Tarea asignada y guardada en la base de datos correctamente.";
        } else {
            echo "Error al asignar y guardar la tarea: " . mysqli_error($conexion);
        }
    } else {
        echo "El valor seleccionado en 'Asignar a' no existe en la tabla de recursos.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Crear Tareas</title>
    <nav>
        <a href="menu.php">Volver</a>
        <a href="mostrar.php">Tabla de usuarios</a>
        <a href="asigProyectos.html">Asignar Proyectos</a>
        <a href="AsigTareas.php">Asignar Tareas</a>
    </nav>
</head>
<style>

    nav {
        background-color: black;
    }
</style>
<body>
    <h1>Crear Tareas</h1>

    <form id="taskForm" method="POST">
        <label for="taskNombreTarea">Nombre de la Tarea:</label>
        <input type="text" id="taskNombreTarea" name="taskNombreTarea" required>
        <br>

        <label for="taskDescription">Descripción de la Tarea:</label>
        <textarea id="taskDescription" name="taskDescription" required></textarea>
        <br>

        <label for="taskHours">Horas Requeridas:</label>
        <input type="number" id="taskHours" name="taskHours" required>
        <br>

        <label for="taskAsignar">Asignar a:</label>
        <select id="taskAsignar" name="taskAsignar" required>
            <?php

            $sql = "SELECT cod_recursos, nombre, apellido, rol FROM recursos";
            $result = mysqli_query($conexion, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['cod_recursos'] . "'>" . $row['nombre'] . " " . $row['apellido'] . " (" . $row['rol'] . ")</option>";
                }
            }
            ?>
        </select>
        <br>

        <button type="submit">Agregar Tarea</button>
        <button type="button" onclick="deleteTask()">Borrar Tarea</button>
    </form>


    <ul id="taskList"></ul>

    <script>
        function deleteTask() {
            const taskList = document.getElementById("taskList");
            const taskItems = taskList.getElementsByTagName("li");

            if (taskItems.length > 0) {
                taskList.removeChild(taskItems[taskItems.length - 1]);
            } else {
                alert("No hay tareas para borrar.");
            }
        }
    </script>
</body>
</html>
