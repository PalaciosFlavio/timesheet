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
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Apellido</th>
      <th scope="col">Disponibilidad</th>
      <th scope="col">Rol</th>

    </tr>
  </thead>
  <tbody>

<?php
$conexion = mysqli_connect("localhost", "root", "", "empleados");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

$sql="SELECT * FROM recursos";
$result = mysqli_query($conexion,$sql);

while($mostrar = mysqli_fetch_array($result)) {



?>
    <tr>
      <th><?php echo $mostrar['nombre'] ?></th>
      <th><?php echo $mostrar['apellido'] ?></th>
      <th><?php echo $mostrar['disponibilidad'] ?></th>
      <th><?php echo $mostrar['rol'] ?></th>
      <td>
        <a href="editar.php?cod_recursos=<?php echo $mostrar['cod_recursos'] ?>">Editar</a>
      </td>
      <td>
    <form action="eliminar.php" method="post">
      <input type="hidden" value="<?php echo $mostrar['cod_recursos'] ?>" name="txtID"readonly> 
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
</div>

</body>