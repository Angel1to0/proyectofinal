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

// Procesar el formulario de asignación de materias si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn_asignar_materia'])) {
    $boleta_asignar = $_POST["boleta_asignar"];
    $materia_asignar = $_POST["materia_asignar"];

    // Verificar si ya está asignada la materia al alumno
    $verificar_asignacion = "SELECT * FROM calificaciones WHERE boleta_alumno = $boleta_asignar AND id_materia = '$materia_asignar'";
    $resultado_verificacion = $conn->query($verificar_asignacion);

    if ($resultado_verificacion->num_rows == 0) {
        // La asignación no existe, realizar la asignación
        $sql_asignar_materia = "INSERT INTO calificaciones (boleta_alumno, id_materia) VALUES ($boleta_asignar, '$materia_asignar')";

        if ($conn->query($sql_asignar_materia) === TRUE) {
            echo "Materia asignada correctamente";
        } else {
            echo "Error al asignar la materia: " . $conn->error;
        }
    } else {
        echo "La materia ya está asignada a este alumno";
    }
}

// Cerrar la conexión
$conn->close();
?>
