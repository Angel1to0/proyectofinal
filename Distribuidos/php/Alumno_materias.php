<?php
    include("Conexion.php");
    $conexion = conectar();

    // Asegúrate de iniciar la sesión
    session_start();

    // Obtener boleta del alumno que ha iniciado sesión de la sesión actual
    $boleta_sesion = $_SESSION['boleta'];

    $sql = "SELECT * FROM calificaciones WHERE boleta_alumno = '$boleta_sesion'";

    if (isset($_GET['searchBoleta'])) {
        $boletaABuscar = mysqli_real_escape_string($conexion, $_GET['searchBoleta']);
        $sql .= " AND boleta_alumno LIKE '%$boletaABuscar%'";
    }

    $query = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sarpa</title>
    <link rel="stylesheet" href="../CRUD/CSS/Estilos.css">
    <link rel="icon" href="../assets/img/Logo.png">
</head>

<body>

    <header>
        <div class="contenedor">
            <img src="../assets/img/Sarpa.png" alt="fondo" class="imglogo">
            <h2 class="LogoT">Materias y Calificaciones</h2>
            <nav>
                <a href="./Index_alumno.php">Información General</a>
                <a href="#" class="activo">Materias - Calificaciones</a>
                <a href="../formulario.html">Cerrar Sesión</a>
            </nav>
        </div>
    </header>

    <main>
        <div class="principal">
            <div class="contenedor">
                <h3 class="titulo">Tabla de Materias y Calificaciones</h3>
            <br><br>
                <table>
                    <thead>
                        <tr>
                            <th>Boleta</th>
                            <th>Materia</th>
                            <th>Calificación Parcial 1</th>
                            <th>Calificación Parcial 2</th>
                            <th>Calificación Parcial 3</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($query)): ?>
                            <tr>
                                <th><?= $row['boleta_alumno']; ?></th>
                                <th>
                                    <?php
                                    $id_materia = $row['id_materia'];
                                    $query_materia_nombre = mysqli_query($conexion, "SELECT nombre FROM materias WHERE id_materia = $id_materia");
                                    $row_materia_nombre = mysqli_fetch_array($query_materia_nombre);
                                    echo $row_materia_nombre['nombre'];
                                    ?>
                                </th>
                                <th><?= $row['calificacion_parcial1']; ?></th>
                                <th><?= $row['calificacion_parcial2']; ?></th>
                                <th><?= $row['calificacion_parcial3']; ?></th>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
    <script>
        document.getElementById('searchBoleta').addEventListener('input', function () {
            updateTable();
        });

        function updateTable() {
        var searchBoleta = document.getElementById('searchBoleta').value;
        console.log('Valor de búsqueda:', searchBoleta);

        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'actualizar_tabla.php?searchBoleta=' + encodeURIComponent(searchBoleta), true);
        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 400) {
                console.log('Respuesta del servidor:', xhr.responseText);
                document.getElementById('table').innerHTML = xhr.responseText;
            } else {
                console.error('Error en la solicitud AJAX');
            }
        };
        xhr.send();
        }

    </script>
    <script src="js/main.js"></script>
</body>

</html>