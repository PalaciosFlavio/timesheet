document.getElementById("formulario").addEventListener("submit", function(event) {
    event.preventDefault();
    var nombre = document.getElementById("nombre").value;
    var apellido = document.getElementById("apellido").value;
    var disponibilidad = document.getElementById("disponibilidad").value;
    var rol = document.getElementById("rol").value;

    alert("Nombre: " + nombre + "\nApellido: " + apellido + "\nDisponibilidad: " + disponibilidad + "\nRol: " + rol);
});
