<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Alumnos</title>
    <link rel="stylesheet" href="css/formularios.css">
</head>
<body>

    <h2>Gestionar Calificaciones y Asignar Materias a Alumnos</h2>

    <!-- Formulario para asignar materias -->
    <form action="asignar_materia.php" method="POST">
        <label for="boleta_asignar">Seleccionar Alumno:</label>
        <select name="boleta_asignar" id="boleta_asignar">
            <!-- Opciones de alumnos cargadas desde la base de datos -->
            <option value="123">Alumno 1</option>
            <option value="456">Alumno 2</option>
            <!-- ... Agregar más opciones según tus alumnos ... -->
        </select>

        <label for="materia_asignar">Seleccionar Materia:</label>
        <select name="materia_asignar" id="materia_asignar">
            <!-- Opciones de materias cargadas desde la base de datos -->
            <option value="matematicas">Matemáticas</option>
            <option value="historia">Historia</option>
            <!-- ... Agregar más opciones según tus materias ... -->
        </select>

        <button type="submit">Asignar Materia</button>
    </form>

    <!-- Formulario para actualizar calificaciones -->
    <form action="actualizar_calificacion.php" method="POST">
        <label for="boleta_calificar">Seleccionar Alumno:</label>
        <select name="boleta_calificar" id="boleta_calificar">
            <!-- Opciones de alumnos cargadas desde la base de datos -->
            <option value="123">Alumno 1</option>
            <option value="456">Alumno 2</option>
            <!-- ... Agregar más opciones según tus alumnos ... -->
        </select>

        <label for="materia_calificar">Seleccionar Materia:</label>
        <select name="materia_calificar" id="materia_calificar">
            <!-- Opciones de materias cargadas desde la base de datos -->
            <option value="matematicas">Matemáticas</option>
            <option value="historia">Historia</option>
            <!-- ... Agregar más opciones según tus materias ... -->
        </select>

        <label for="nueva_calificacion">Nueva Calificación:</label>
        <input type="text" name="nueva_calificacion" id="nueva_calificacion" placeholder="Ingrese la nueva calificación">

        <button type="submit">Actualizar Calificación</button>
    </form>

</body>
</html>
