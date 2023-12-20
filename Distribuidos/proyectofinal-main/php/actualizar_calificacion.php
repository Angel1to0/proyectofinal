<?php
// Autenticarse en la BD (Base de Datos)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sarpa";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Procesar el formulario de actualización de calificaciones si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn_actualizar_calificacion'])) {
    $boleta_calificar = $_POST["boleta_calificar"];
    $materia_calificar = $_POST["materia_calificar"];
    $calificacion_parcial1 = $_POST["calificacion_parcial1"];
    $calificacion_parcial2 = $_POST["calificacion_parcial2"];
    $calificacion_parcial3 = $_POST["calificacion_parcial3"];

    // Verificar si ya existen calificaciones para este alumno y materia
    $verificar_calificacion = "SELECT * FROM calificaciones WHERE boleta_alumno = $boleta_calificar AND id_materia = '$materia_calificar'";
    $resultado_verificacion = $conn->query($verificar_calificacion);

    if ($resultado_verificacion->num_rows == 0) {
        // No hay calificaciones, realizar la inserción
        $sql_insert_calificacion = "INSERT INTO calificaciones (boleta_alumno, id_materia, calificacion_parcial1, calificacion_parcial2, calificacion_parcial3) VALUES ($boleta_calificar, '$materia_calificar', $calificacion_parcial1, $calificacion_parcial2, $calificacion_parcial3)";

        if ($conn->query($sql_insert_calificacion) === TRUE) {
            echo "Calificaciones insertadas correctamente";
        } else {
            echo "Error al insertar las calificaciones: " . $conn->error;
        }
    } else {
        // Ya hay calificaciones, realizar la actualización
        $sql_update_calificacion = "UPDATE calificaciones SET calificacion_parcial1 = $calificacion_parcial1, calificacion_parcial2 = $calificacion_parcial2, calificacion_parcial3 = $calificacion_parcial3 WHERE boleta_alumno = $boleta_calificar AND id_materia = '$materia_calificar'";

        if ($conn->query($sql_update_calificacion) === TRUE) {
            echo "Calificaciones actualizadas correctamente";
        } else {
            echo "Error al actualizar las calificaciones: " . $conn->error;
        }
    }
}

// Cerrar la conexión
$conn->close();
?>
