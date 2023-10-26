<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Proyecto/Mantenimiento</title>
    <link rel="stylesheet" href="http://localhost/proyecto/assets/style.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: black;
            color: white;
            width: 80%;
            max-width: 100%;
            margin: 0 auto;
            padding: 20px;
            min-height: 100vh;
            border: 2px solid white;
            border-radius: 10px;
        }

        .encabezado {
            background-color: black;
            color: white;
            padding: 20px;
        }

        .wrap {
            display: flex;
            justify-content: space-between;
        }

        .logos {
            font-size: 24px;
            font-weight: bold;
        }

        .table {
            width: 100%;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #444;
            color: white;
        }

        button {
            background: none;
            border: none;
            cursor: pointer;
        }

        button.editar {
            color: white;
        }

        button.eliminar {
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="encabezado">
            <div class="wrap">
                <div class="logos">
                    <img src="" alt="">
                </div>
                <nav>
                    <a href="menu.php">Volver</a>
                    <br>
                    <br>
                    <a href="asigProyectos.html">Asignar Proyectos</a>
                    <br>
                    <br>
                    <a href="tareas.php">Crear tareas</a>
                </nav>
            </div>
        </header>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Responsable Comercial</th>
                    <th scope="col">Responsable Gestión</th>
                    <th scope="col">Fecha de Inicio Ideal</th>
                    <th scope="col">Fecha de Inicio Real</th>
                    <th scope="col">Fecha de Fin Ideal</th>
                    <th scope="col">Fecha de Fin Real</th>
                    <th scope="col">Listado de Recursos Asignados</th>
                    <th scope="col">Horas Dedicadas</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $conexion = mysqli_connect("localhost", "root", "", "empleados");

                if (!$conexion) {
                    die("Error de conexión: " . mysqli_connect_error());
                }

                $sql = "SELECT * FROM proyecto";
                $result = mysqli_query($conexion, $sql);

                while ($mostrar = mysqli_fetch_array($result)) {
                ?>

                <tr>
                    <th><?php echo $mostrar['nombre'] ?></th>
                    <th><?php echo $mostrar['tipo'] ?></th>
                    <th><?php echo $mostrar['responsableCom'] ?></th>
                    <th><?php echo $mostrar['responsableGest'] ?></th>
                    <th><?php echo $mostrar['fecha_in_ideal'] ?></th>
                    <th><?php echo $mostrar['fecha_in_real'] ?></th>
                    <th><?php echo $mostrar['fecha_fin_ideal'] ?></th>
                    <th><?php echo $mostrar['fecha_fin_real'] ?></th>
                    <th><?php echo $mostrar['asigRecursos'] ?></th>
                    <th><?php echo $mostrar['horas_estimadas'] ?></th>
                    <td>
                        <button type="submit" class="editar" onclick="location.href='editarProy.php?cod_proy=<?php echo $mostrar['cod_proy'] ?>'">Editar</button>
                        <button type ="button" class="eliminar" onclick="location.href='eliminarProy.php?cod_proy=<?php echo $mostrar['cod_proy'] ?>'">Eliminar</button>
                    </td>
                </tr>

                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
