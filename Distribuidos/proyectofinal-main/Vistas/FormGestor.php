<?php
//Auntenticarse en la BD
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sarpa";
 
// Create connection
$conn = new mysqli($servername,
    $username, $password, $dbname);
 
// Check connection
if ($conn->connect_error) {
    die("Connection failed: "
        . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Alumnos</title>
    <link rel="stylesheet" href="../css/formularios.css">
</head>
<body>

    <h2>Gestionar Calificaciones y Asignar Materias a Alumnos</h2>

    <!-- Formulario para asignar materias 
    <form action="asignar_materia.php" method="POST">
        <label for="boleta_asignar">Boleta del Alumno:</label>
        <input type="text" name="boleta_asignar" id="boleta_asignar" placeholder="Ingrese la boleta del alumno">

        <label for="nombre_materia_asignar">Nombre de la Materia:</label>
        <input type="text" name="nombre_materia_asignar" id="nombre_materia_asignar" placeholder="Ingrese el nombre de la materia">

        <button type="submit" name="btn_asignar_materia">Asignar Materia</button>
        <p><?php if(isset($_GET['asignacion_result'])){ echo $_GET['asignacion_result']; } ?></p>
    </form>-->

    <!-- Formulario para actualizar calificaciones -->
    <form action="../php/actualizar_calificacion.php" method="POST" enctype="multipart/form-data">
        <!--<label for="boleta_calificar">Boleta del Alumno:</label>
        <input type="text" name="boleta_calificar" id="boleta_calificar" placeholder="Ingrese la boleta del alumno">

        <label for="nombre_materia_calificar">Nombre de la Materia:</label>
        <input type="text" name="id_materia_calificar" id="id_materia_calificar" placeholder="Ingrese el nombre de la materia"> -->


        <label for="boleta_calificar">Boleta del Alumno:</label>
        <select name="boleta_calificar" id="boleta_calificar">
            <?php
                // Consulta SQL para obtener la lista de boletas desde la tabla alumnos
                $query_boletas = mysqli_query($conn, "SELECT boleta FROM alumnos");

                // Iterar sobre los resultados y generar opciones del menú desplegable
                while($row_boleta = mysqli_fetch_array($query_boletas)) {
                    echo "<option value='".$row_boleta['boleta']."'>".$row_boleta['boleta']."</option>";
                }
            ?>
        </select>

        <label for="id_materia_calificar">Nombre de la Materia:</label>
        <select name="id_materia_calificar" id="id_materia_calificar">
            <?php
                // Consulta SQL para obtener la lista de materias desde la base de datos
                $query_materias = mysqli_query($conn, "SELECT id_materia, nombre FROM materias");

                // Iterar sobre los resultados y generar opciones del menú desplegable
                while($row_materia = mysqli_fetch_array($query_materias)) {
                    echo "<option value='".$row_materia['id_materia']."'>".$row_materia['nombre']."</option>";
                }
            ?>
        </select>

        <label for="calificacion_parcial1">Calificación Parcial 1:</label>
        <input type="text" name="calificacion_parcial1" id="calificacion_parcial1" placeholder="Ingrese la calificación del parcial 1">

        <label for="calificacion_parcial2">Calificación Parcial 2:</label>
        <input type="text" name="calificacion_parcial2" id="calificacion_parcial2" placeholder="Ingrese la calificación del parcial 2">

        <label for="calificacion_parcial3">Calificación Parcial 3:</label>
        <input type="text" name="calificacion_parcial3" id="calificacion_parcial3" placeholder="Ingrese la calificación del parcial 3">

        <button type="submit" name="btn_actualizar_calificacion">Actualizar Calificación</button>
    </form>

</body>
</html>