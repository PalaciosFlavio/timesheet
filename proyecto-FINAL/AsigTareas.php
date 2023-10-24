<?php
$conexion = mysqli_connect("localhost", "root", "", "empleados");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

$tasksAssigned = array();

if (isset($_POST['desasignar'])) {
    $tareaId = $_POST['desasignar'];

    $sqlDelete = "DELETE FROM rec_proyec WHERE tarea_id = $tareaId";
    if (mysqli_query($conexion, $sqlDelete)) {
        echo "Desasignación exitosa.";
    } else {
        echo "Error al desasignar la tarea: " . mysqli_error($conexion);
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['recursos'], $_POST['proyecto'], $_POST['tarea'])) {
    $personaId = $_POST['recursos'];
    $proyectoId = $_POST['proyecto'];
    $tareaId = $_POST['tarea'];

    if (!empty($personaId) && !empty($proyectoId) && !empty($tareaId)) {
        $sqlCheckAssignment = "SELECT * FROM rec_proyec WHERE codigo_recursos = $personaId AND codigo_proyecto = $proyectoId AND tarea_id = $tareaId";
        $resultCheckAssignment = mysqli_query($conexion, $sqlCheckAssignment);

        if (mysqli_num_rows($resultCheckAssignment) > 0) {
            echo "La asignación ya existe.";
        } else {
            $sqlInsert = "INSERT INTO rec_proyec (codigo_recursos, codigo_proyecto, tarea_id) VALUES ($personaId, $proyectoId, $tareaId)";
            if (mysqli_query($conexion, $sqlInsert)) {
                echo "Asignación exitosa.";
            } else {
                echo "Error al asignar la tarea a la persona: " . mysqli_error($conexion);
            }
        }
    } else {
        echo "Por favor, seleccione una persona, un proyecto y una tarea válidos.";
    }
}

$personasQuery = mysqli_query($conexion, "SELECT * FROM recursos");
$proyectosQuery = mysqli_query($conexion, "SELECT * FROM proyecto");
$tareasQuery = mysqli_query($conexion, "SELECT * FROM tareas");

if (!$personasQuery || !$proyectosQuery || !$tareasQuery) {
    die("Error al obtener datos: " . mysqli_error($conexion));
}

if (isset($_POST['proyecto'])) {
    $proyectoId = $_POST['proyecto'];
    $sqlTasks = "SELECT tareas.nombre FROM tareas WHERE tareas.id_proyecto = $proyectoId";
    $resultTasks = mysqli_query($conexion, $sqlTasks);
    if (!$resultTasks) {
        echo "Error al obtener las tareas asignadas: " . mysqli_error($conexion);
    } else {
        while ($row = mysqli_fetch_assoc($resultTasks)) {
            $tasksAssigned[] = $row['nombre'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Asignar Personas a Proyectos</title>
</head>
<style>

    nav {
        background-color: black;
    }
</style>
<body>
    <nav>
        <a href="tareas.php">Volver</a>
        <a href="generar_reporte.php">Reporte de visualizacion</a>
    </nav>
    <h1>Asignar Personas a Proyectos</h1>

    <form method="POST">
        <label for="persona">Selecciona una persona:</label>
        <select id="persona" name="recursos">
            <?php
            while ($row = mysqli_fetch_assoc($personasQuery)) {
                echo "<option value='" . $row['cod_recursos'] . "'>" . $row['nombre'] . " " . $row['apellido'] . " (" . $row['rol'] . ")</option>";
            }
            ?>
        </select>
        <br>

        <label for="proyecto">Selecciona un proyecto:</label>
        <select id="proyecto" name="proyecto">
            <?php
            while ($row = mysqli_fetch_assoc($proyectosQuery)) {
                $optionValue = $row['cod_proy'];
                $optionText = $row['nombre'] . "," . $row['tipo'] . "," . $row['responsableCom'] . "," . $row['responsableGest'] . "," . $row['fecha_in_ideal'] . "," . $row['fecha_in_real'] . "," . $row['fecha_fin_ideal'] . "," . $row['fecha_fin_real'] . "," . $row['asigRecursos'] . "," . $row['horas_estimadas'];
                echo "<option value='$optionValue'>$optionText</option>";
            }
            ?>
        </select>
        <br>

        <label for="tarea">Selecciona una tarea:</label>
        <select id="tarea" name="tarea">
            <?php
            while ($row = mysqli_fetch_assoc($tareasQuery)) {
                echo "<option value='" . $row['tarea_id'] . "'>" . $row['nombre'] . "</option>";
            }
            ?>
        </select>
        <br>

        <button type="submit">Asignar Tarea</button>
    </form>

    <h2>Tareas Asignadas al Proyecto</h2>
    <ul>
        <?php
        foreach ($tasksAssigned as $task) {
            echo "<li>$task</li>";
        }
        ?>
    </ul>

    <h2>Asignaciones Actuales</h2>
    <table>
        <thead>
            <tr>
                <th>Proyecto</th>
                <th>Persona</th>
                <th>Tarea</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $asignacionesQuery = mysqli_query($conexion, "SELECT rec_proyec.codigo_recursos, rec_proyec.codigo_proyecto, rec_proyec.tarea_id, recursos.nombre AS persona, proyecto.nombre AS proyecto, tareas.nombre AS tarea
            FROM rec_proyec
            JOIN recursos ON rec_proyec.codigo_recursos = recursos.cod_recursos
            JOIN proyecto ON rec_proyec.codigo_proyecto = proyecto.cod_proy
            JOIN tareas ON rec_proyec.tarea_id = tareas.tarea_id
            ");

            if ($asignacionesQuery && mysqli_num_rows($asignacionesQuery) > 0) {
                while ($row = mysqli_fetch_assoc($asignacionesQuery)) {
                    echo "<tr>";
                    echo "<td>" . $row['proyecto'] . "</td>";
                    echo "<td>" . $row['persona'] . "</td>";
                    echo "<td>" . $row['tarea'] . "</td>";
                    echo "<td>";
                    echo "<form method='POST'>";
                    echo "<input type='hidden' name='desasignar' value='" . $row['tarea_id'] . "'>";
                    echo "<button type='submit'>Desasignar</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No se encontraron asignaciones.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php
mysqli_close($conexion);
?>
