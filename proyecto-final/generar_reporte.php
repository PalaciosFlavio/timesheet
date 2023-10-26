<?php
$conexion = mysqli_connect("localhost", "root", "", "empleados");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

$meses = array(
    0 => "Enero",
    1 => "Febrero",
    2 => "Marzo",
    3 => "Abril",
    4 => "Mayo",
    5 => "Junio",
    6 => "Julio",
    7 => "Agosto",
    8 => "Septiembre",
    9 => "Octubre",
    10 => "Noviembre",
    11 => "Diciembre"
);

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
    $persona = $_POST['persona'];
    $proyecto = $_POST['proyecto'];
    $mes = $_POST['mes'];
    $horas_trabajadas = $_POST['horas_trabajadas'];

    $insert_query = "INSERT INTO horas_trabajo (codigo_recursos, codigo_proyecto, mes, horas_trabajadas) 
                     VALUES ('$persona', '$proyecto', '$mes', '$horas_trabajadas')";

    if (mysqli_query($conexion, $insert_query)) {
        echo "Datos ingresados correctamente.<br>";
    } else {
        echo "Error al ingresar datos: " . mysqli_error($conexion) . "<br>";
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['eliminar_reporte'])) {
    $reporte_id = $_POST['id'];

    $delete_query = "DELETE FROM horas_trabajo WHERE id = '$reporte_id'";

    if (mysqli_query($conexion, $delete_query)) {
        echo "Reporte eliminado correctamente.<br>";
    } else {
        echo "Error al eliminar el reporte: " . mysqli_error($conexion) . "<br>";
    }
}

$sql = "SELECT
    r.nombre AS persona,
    p.nombre AS proyecto,
    ht.mes,
    SUM(ht.horas_trabajadas) AS total_horas,
    ht.id
FROM
    horas_trabajo ht
JOIN
    recursos r ON ht.codigo_recursos = r.cod_recursos
JOIN
    proyecto p ON ht.codigo_proyecto = p.cod_proy
GROUP BY
    r.nombre, p.nombre, ht.mes, ht.id
ORDER BY
    r.nombre, p.nombre, ht.mes";

$result = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Horas Trabajadas</title>
    <br>
    <link rel="stylesheet" href="http://localhost/proyecto/assets/style.css">
    <style>
       
        body {
            margin: 0;
            padding: 0;
            border: 0;
            background-color: black; 
            color: white; 
        }
        h2 {
            margin-top: 20px;
        }
       
        .separador {
            border-top: 1px solid white;
            margin-top: 20px;
            padding-top: 20px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid white;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #333;
        }
        tr:nth-child(even) {
            background-color: #444;
        }
    </style>
</head>
<body>
    <a href="menu.php" style="color: white;">Volver</a>
    <h1>Reporte de Horas Trabajadas</h1>

    <h2>Ingresar Horas Trabajadas</h2>
    <form method="POST">
        <label for="persona">Persona:</label>
        <select id="persona" name="persona">
            <?php
            $personasQuery = mysqli_query($conexion, "SELECT * FROM recursos");

            if (!$personasQuery) {
                die("Error al obtener personas: " . mysqli_error($conexion));
            }

            while ($row = mysqli_fetch_assoc($personasQuery)) {
                echo "<option value='" . $row['cod_recursos'] . "'>" . $row['nombre'] . " " . $row['apellido'] . "</option>";
            }
            ?>
        </select>
        <br>

        <label for="proyecto">Proyecto:</label>
        <select id="proyecto" name="proyecto">
            <?php
            $proyectosQuery = mysqli_query($conexion, "SELECT * FROM proyecto");

            if (!$proyectosQuery) {
                die("Error al obtener proyectos: " . mysqli_error($conexion));
            }

            while ($row = mysqli_fetch_assoc($proyectosQuery)) {
                echo "<option value='" . $row['cod_proy'] . "'>" . $row['nombre'] . "</option>";
            }
            ?>
        </select>
        <br>

        <label for="mes">Mes:</label>
        <select id="mes" name="mes">
            <?php
            foreach ($meses as $mesNumero => $mesNombre) {
                echo "<option value='$mesNumero'>$mesNombre</option>";
            }
            ?>
        </select>
        <br>

        <label for="horas_trabajadas">Horas Trabajadas:</label>
        <input type="number" id="horas_trabajadas" name="horas_trabajadas" min="0" step="1">
        <br>

        <button type="submit" name="submit">Ingresar</button>
    </form>

    
    <div class="separador"></div>

    <h2>Reporte de Horas Trabajadas</h2>
    <table>
        <thead>
            <tr>
                <th>Persona</th>
                <th>Proyecto</th>
                <th>Mes</th>
                <th>Total Horas</th>
                <th>Acciones</th> 
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['persona'] . "</td>";
                    echo "<td>" . $row['proyecto'] . "</td>";
                    echo "<td>";

                    if (isset($row['mes'])) {
                        echo $meses[intval($row['mes'])];
                    } else {
                        echo "N/A";
                    }

                    echo "</td>";
                    echo "<td>" . number_format($row['total_horas'], 0) . "</td>";

                    echo "<td>";
                    echo "<form method='POST' action='generar_reporte.php'>";
                    echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                    echo "<button type='submit' name='eliminar_reporte'>Eliminar</button>";
                    echo "</form>";
                    echo "</td>";

                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No se encontraron registros.</td></tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>

<?php
mysqli_close($conexion);
?>
