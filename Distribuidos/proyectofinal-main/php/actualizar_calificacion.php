<?php
// Conectar a la base de datos (ajusta las credenciales según tu configuración)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sarpa";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Procesar el formulario si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $boleta = $_POST["boleta"];
    $materia = $_POST["materia"];
    $nueva_calificacion = $_POST["nueva_calificacion"];

    // Realizar la actualización en la base de datos
    $sql = "UPDATE calificaciones SET calificacion_parcial1 = $nueva_calificacion WHERE boleta_alumno = $boleta AND id_materia = '$materia'";

    if ($conn->query($sql) === TRUE) {
        echo "Calificación actualizada correctamente";
    } else {
        echo "Error al actualizar la calificación: " . $conn->error;
    }
}

// Cerrar la conexión
$conn->close();
?>
