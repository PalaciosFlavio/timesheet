<?php include('db.php'); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Usuarios</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="header.css">
    <style>
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .encabezado {
            background-color: black;
            color: #fff;
            padding: 10px 0;
        }

        .wrap {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logos {
            font-size: 24px;
        }

        nav a {
            text-decoration: none;
            color: #fff;
            margin-left: 20px;
            font-weight: bold;
        }

        .espacio-tabla {
            margin-top: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            background-color: black;
        }

        .table th, .table td {
            padding: 10px;
            text-align: left;
            background-color: black;
        }

        .table th {
            background-color: #007BFF;
            color: #fff;
            background-color: black;
        }

        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table tr:hover {
            background-color: #ddd;
        }

        .editar-enlace {
            text-decoration: none;
            color: #007BFF;
        }

        .editar-enlace:hover {
            text-decoration: underline;
        }

        .eliminar-form {
            display: inline-block;
        }

        .eliminar-button {
            background-color: #FF3333;
            border: none;
            color: #fff;
            padding: 5px 10px;
            margin-top: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="encabezado">
            <div class="wrap">
                <div class="logos">
                    Timesheet
                </div>
                <nav>
                    <a href="menu.php">Volver</a>
                    <a href="mostrar.php">Tabla</a>
                </nav>
            </div>
        </header>

        <div class="espacio-tabla">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Disponibilidad</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $conexion = mysqli_connect("localhost", "root", "", "empleados");

                    if (!$conexion) {
                        die("Error de conexión: " . mysqli_connect_error());
                    }

                    $sql = "SELECT * FROM recursos";
                    $result = mysqli_query($conexion, $sql);

                    while ($mostrar = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <th><?php echo $mostrar['nombre'] ?></th>
                            <th><?php echo $mostrar['apellido'] ?></th>
                            <th><?php echo $mostrar['disponibilidad'] ?></th>
                            <th><?php echo $mostrar['rol'] ?></th>
                            <td><a class="editar-enlace" href="editar.php?cod_recursos=<?php echo $mostrar['cod_recursos'] ?>">Editar</a></td>
                            <td>
                                <form class="eliminar-form" action="eliminar.php" method="post">
                                    <input type="hidden" value="<?php echo $mostrar['cod_recursos'] ?>" name="txtID" readonly>
                                    <input class="eliminar-button" type="submit" value="Eliminar" name="btnEliminar">
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
