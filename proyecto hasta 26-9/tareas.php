<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignar Tareas al Proyecto</title>
</head>
<body>
    <h1>Asignar Tareas al Proyecto</h1>

    <form id="taskForm">
        <label for="taskName">Nombre de la Tarea:</label>
        <input type="text" id="taskName" required>
        <br>

        <label for="taskDescription">Descripción de la Tarea:</label>
        <textarea id="taskDescription" required></textarea>
        <br>

        <button type="button" onclick="addTask()">Agregar Tarea</button>
    </form>

    <h2>Tareas Asignadas</h2>
    <ul id="taskList"></ul>

    <script>
        function addTask() {
            const taskName = document.getElementById("taskName").value;
            const taskDescription = document.getElementById("taskDescription").value;

            if (taskName && taskDescription) {
                const taskList = document.getElementById("taskList");
                const taskItem = document.createElement("li");
                taskItem.innerHTML = `<strong>${taskName}:</strong> ${taskDescription}`;
                taskList.appendChild(taskItem);

                // Limpiar el formulario después de agregar la tarea
                document.getElementById("taskForm").reset();
            } else {
                alert("Por favor, complete todos los campos.");
            }
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




            
        }
    </script>
</body>
</html>
