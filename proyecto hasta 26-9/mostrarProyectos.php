<?php
include("db.php");
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Proyecto/Mantenimiento</title>
    <link rel="stylesheet" href="styleProy.css">
</head>
<body>
    <header>
        <h1>Formulario de Proyecto/Mantenimiento</h1>
    </header>

    <style>
        .container {
            width: 80%; /* Ajusta el ancho del contenedor principal */
            margin: 0 auto; /* Centra el contenedor en la página */
            padding: 20px; /* Agrega un espacio alrededor del contenido */
        }

        form {
            display: grid;
            grid-template-columns: 1fr 1fr; /* Divide el formulario en dos columnas */
            gap: 10px; /* Agrega espacio entre los elementos del formulario */
        }

        label {
            display: block; /* Muestra cada etiqueta en una línea separada */
            font-weight: bold;
        }

        input,
        select {
            width: 100%; /* Ajusta el ancho de los campos de entrada al 100% del contenedor */
            padding: 5px;
            margin-bottom: 10px; /* Agrega espacio inferior entre los campos */
        }

        button {
            grid-column: span 2; /* Hace que el botón ocupe dos columnas completas */
        }
    </style>
    <div class="container">
        <header class="encabezado">
            <div class="wrap">
                <div class="logos">
                    Asignar Proyectos
                </div>
                <nav>
                    <a href="index.html">Login</a>
                    <a href="asigProyectos.html">Asignar Proyectos</a>
                    <a href="mostrarProyectos.php">Tabla de Proyectos</a>
                </nav>
            </div>
        </header>
        <table class="table">
  <thead>
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Tipo</th>
      <th scope="col">Responsable Comercial</th>
      <th scope="col">Responsable Gestion</th>
      <th scope="col">Fecha de Inicio Ideal</th>
      <th scope="col">Fecha de Inicio Real</th>
      <th scope="col">Fecha de Fin Ideal</th>
      <th scope="col">Fecha de Fin Real</th>
      <th scope="col">Listado de Recursos Asignados</th>
      <th scope="col">Horas dedicadas</th>
    </tr>
  </thead>
  <tbody>

<?php
$conexion = mysqli_connect("localhost", "root", "", "empleados");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

    $sql="SELECT * FROM proyecto";
    $result = mysqli_query($conexion,$sql);

    while($mostrar = mysqli_fetch_array($result)) {
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
        <a href="editarProy.php?cod_proy=<?php echo $mostrar['cod_proy'] ?>">Editar</a>
      </td>
      <td>
    <form action="eliminarProy.php" method="post">
      <input type="hidden" value="<?php echo $mostrar['cod_proy'] ?>" name="txtID"readonly> 
      <td>
        <input type="submit" value="Eliminar" name="btnEliminar">
      </td>
    </form>
      </td>

    </tr>

    <?php
    }
    ?>
  </tbody>
</table>
        </body>