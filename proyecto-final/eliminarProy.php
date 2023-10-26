<?php

include('db.php');
$cod_proy = $_POST['txtID'];

mysqli_query($conexion, "DELETE FROM proyecto WHERE cod_proy = '$cod_proy'") or die ("error al eliminar");

if (isset($_GET['cod_proy'])) {
    $cod_proy = $_GET['cod_proy'];


    $query = "DELETE FROM proyecto WHERE cod_proy = '$cod_proy'";
    if (mysqli_query($conexion, $query)) {
        echo "Proyecto eliminado con éxito.";
    } else {
        echo "Error al eliminar el proyecto: " . mysqli_error($conexion);
    }


    mysqli_close($conexion);

    header("location: mostrarProyectos.php");
}
?>

?>