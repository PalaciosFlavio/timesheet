<?php
include("db.php");
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Formulario de Proyecto/Mantenimiento</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Formulario de Proyecto/Mantenimiento</h1>
    </header>

    <style>
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }

        form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input,
        select {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
        }

        button {
            grid-column: span 2;
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

    $cod_proy = $_GET["cod_proy"];
    $sql="SELECT * FROM proyecto where cod_proy = '$cod_proy'";
    $result = mysqli_query($conexion,$sql);

    while($mostrar = mysqli_fetch_array($result)) {
?>

    <form action="procesar_editar_proyectos.php" method="POST">
        <input type="text" value="<?php echo $mostrar['cod_proy'] ?>" name="txtID">
        <p>Nombre</p>
        <input type="text" value="<?php echo $mostrar['nombre'] ?>" name="txtNombre">
        <p>Tipo</p>
        <input type="text" value="<?php echo $mostrar['tipo'] ?>" name="txtTipo">
        <p>Comercial</p>
        <input type="text" value="<?php echo $mostrar['responsableCom'] ?>" name="txtComercial">
        <p>Gestion</p>
        <input type="text" value="<?php echo $mostrar['responsableGest'] ?>" name="txtGestion">
        <p>Inicio Ideal</p>
        <input type="text" value="<?php echo $mostrar['fecha_in_ideal'] ?>" name="txtInicio_ideal">
        <p>Inicio Real</p>
        <input type="text" value="<?php echo $mostrar['fecha_in_real'] ?>" name="txtInicio_real">
        <p>Fin Ideal</p>
        <input type="text" value="<?php echo $mostrar['fecha_fin_ideal'] ?>" name="txtFin_ideal">
        <p>Fin Real</p>
        <input type="text" value="<?php echo $mostrar['fecha_fin_real'] ?>" name="txtFin_real">
        <p>Recursos</p>
        <input type="text" value="<?php echo $mostrar['asigRecursos'] ?>" name="txtRecursos">
        <p>Horas dedicadas</p>
        <input type="text" value="<?php echo $mostrar['horas_estimadas'] ?>" name="txtDedicacion">

    <?php
    }
    ?>
    <input type="submit" value="Actualizar">
     </form>
  </tbody>
</table>
        </body>