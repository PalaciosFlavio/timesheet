<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Menú</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            background-color: black;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin: 10px 0;
            background-color: black
        }

        a {
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
            font-size: 18px;
        }

        a:hover {
            text-decoration: underline;
        }

        .menu-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .menu-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .menu-item:hover {
            background-color: #007BFF;
        }

        .menu-item a {
            flex-grow: 1;
            padding: 10px;
            color: #fff;
        }

        .menu-item a:hover {
            text-decoration: none;
        }

        .menu-item .arrow {
            width: 30px;
            text-align: right;
            color: #fff;
        }
    </style>
</head>
<body>
    <h1>Menú</h1>
    <div class="menu-container">
        <ul>
            <li class="menu-item">
                <a href="mostrar.php">Tabla de Usuarios</a>
                <span class="arrow">➔</span>
            </li>
            <li class="menu-item">
                <a href="asigProyectos.html">Crear Proyectos</a>
                <span class="arrow">➔</span>
            </li>
            <li class="menu-item">
                <a href="tareas.php">Crear Tareas</a>
                <span class="arrow">➔</span>
            </li>
        </ul>
    </div>
</body>
</html>
