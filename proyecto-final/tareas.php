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

            echo "Diríjase a Ver Tareas";
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
    <link rel="stylesheet" href="http://localhost/proyecto/assets/style.css">
    <title>Crear Tareas</title>
    <style>
        body {
            text-align: center;
            background-color: black;
            color: white;
        }

        nav {
            background-color: black;
            padding: 20px;
        }

        h1 {
            margin-top: 20px;
        }

        form {
            margin: 0 auto;
            width: 50%;
            text-align: left;
        }

        label, input, textarea, select {
            display: block;
            margin: 10px 0;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        button {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <nav>
        <a href="menu.php">Volver</a>
        <a href="mostrar.php">Tabla de usuarios</a>
        <a href="asigProyectos.html">Asignar Proyectos</a>
        <a href="AsigTareas.php">Ver Tareas</a>
    </nav>
    <h1>Crear Tareas</h1>

    <form id="taskForm" method="POST">
        <label for="taskNombreTarea">Nombre de la Tarea:</label>
        <input type="text" id="taskNombreTarea" name="taskNombreTarea" required>

        <label for="taskDescription">Descripción de la Tarea:</label>
        <textarea id="taskDescription" name="taskDescription" required></textarea>

        <label for="taskHours">Horas Requeridas:</label>
        <input type="number" id="taskHours" name="taskHours" required>

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

        <button type="submit" style="text-align:center;">Agregar Tarea</button>
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
