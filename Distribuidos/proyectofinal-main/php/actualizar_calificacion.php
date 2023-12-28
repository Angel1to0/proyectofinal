<!DOCTYPE HTML>  
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .error {
            color: #FF0000;
        }
    </style>
    <title>Formulario de Calificaciones</title>
</head>
<body> 

<?php
$boleta_calificar = $materia_calificar = $calificacion_parcial1 = $calificacion_parcial2 = $calificacion_parcial3 = "";
$boleta_calificarErr = $materia_calificarErr = $calificacionErr = "";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sarpa";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar y recoger datos del formulario
    $boleta_calificar = test_input($_POST["boleta_calificar"]);
    $materia_calificar = test_input($_POST["id_materia_calificar"]);
    $calificacion_parcial1 = test_input($_POST["calificacion_parcial1"]);
    $calificacion_parcial2 = test_input($_POST["calificacion_parcial2"]);
    $calificacion_parcial3 = test_input($_POST["calificacion_parcial3"]);

    if (empty($boleta_calificar)) {
        $boleta_calificarErr = "La boleta del alumno es requerida";
    }

    if (empty($materia_calificar)) {
        $materia_calificarErr = "La materia es requerida";
    }

    if (empty($calificacion_parcial1) || empty($calificacion_parcial2) || empty($calificacion_parcial3)) {
        $calificacionErr = "Todas las calificaciones son requeridas";
    }

    if (empty($boleta_calificarErr) && empty($materia_calificarErr) && empty($calificacionErr)) {
        // Verificar si ya existen calificaciones para este alumno y materia
        $verificar_calificacion = "SELECT * FROM calificaciones WHERE boleta_alumno = '$boleta_calificar' AND id_materia = '$materia_calificar'";
        $resultado_verificacion = $conn->query($verificar_calificacion);

        if ($resultado_verificacion->num_rows == 0) {
            // No hay calificaciones, realizar la inserción
            $sql_insert_calificacion = "INSERT INTO calificaciones (boleta_alumno, id_materia, calificacion_parcial1, calificacion_parcial2, calificacion_parcial3) VALUES ('$boleta_calificar', '$materia_calificar', '$calificacion_parcial1', '$calificacion_parcial2', '$calificacion_parcial3')";

            if ($conn->query($sql_insert_calificacion) === TRUE) {
                echo "Calificaciones insertadas correctamente";
            } else {
                echo "Error al insertar las calificaciones: " . $conn->error;
            }
        } else {
            // Ya hay calificaciones, realizar la actualización
            $sql_update_calificacion = "UPDATE calificaciones SET calificacion_parcial1 = '$calificacion_parcial1', calificacion_parcial2 = '$calificacion_parcial2', calificacion_parcial3 = '$calificacion_parcial3' WHERE boleta_alumno = '$boleta_calificar' AND id_materia = '$materia_calificar'";

            if ($conn->query($sql_update_calificacion) === TRUE) {
                echo "Calificaciones actualizadas correctamente";
            } else {
                echo "Error al actualizar las calificaciones: " . $conn->error;
            }
        }
    }
}

$conn->close();

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!-- Formulario HTML -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Boleta del alumno: <input type="text" name="boleta_calificar" value="<?php echo $boleta_calificar; ?>">
    <span class="error"><?php echo $boleta_calificarErr; ?></span><br><br>

    Materia: <input type="text" name="id_materia_calificar" value="<?php echo $materia_calificar; ?>">
    <span class="error"><?php echo $materia_calificarErr; ?></span><br><br>

    Calificación Parcial 1: <input type="text" name="calificacion_parcial1" value="<?php echo $calificacion_parcial1; ?>">
    Calificación Parcial 2: <input type="text" name="calificacion_parcial2" value="<?php echo $calificacion_parcial2; ?>">
    Calificación Parcial 3: <input type="text" name="calificacion_parcial3" value="<?php echo $calificacion_parcial3; ?>">
    <span class="error"><?php echo $calificacionErr; ?></span><br><br>

    <input type="submit" name="submit" value="Enviar">
</form>

</body>
</html>
