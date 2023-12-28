<?php
    include("Conexion.php");
    $conexion = conectar();
    $boleta = $_GET['boleta'];
    $sql = "SELECT * FROM alumnos WHERE boleta = '$boleta'";
    $query = mysqli_query($conexion,$sql);
    $row=mysqli_fetch_array($query);

    // Verificar si $row es un array y tiene las claves esperadas
    if (is_array($row) && !empty($row['boleta'])) {
        // El array tiene la clave 'boleta', puedes acceder a otras claves de manera segura

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="../CSS/Estilos.css" rel="stylesheet">
        <link rel="icon" href="../Imagen/Logo-P.ico">
        <title>Actualizar</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        
    </head>
    <body>
    <div class="principal">
            <div class="contenedor">
                <h3 class="titulo">Actualizacion de Datos</h3>
                <section class="form-update">
                    <h4>Actualiza tus datos</h4>
                    <form action="./Update.php" method="POST" enctype="multipart/form-data">
                        <input class="controls" required="" type="number" placeholder="Boleta" name="txtboleta" value="<?php echo $row['boleta']?>"><br><br>
                        <input class="controls" required="" type="text" placeholder="Nombre" name="txtnombre" value="<?php echo $row['nombre']?>"><br><br>
                        <input class="controls" required="" type="text" placeholder="ApellidoP" name="txtapellidp" value="<?php echo $row['firstls']?>"><br><br>
                        <input class="controls" required="" type="text" placeholder="ApellidoM" name="txtapellidm" value="<?php echo $row['secondls']?>"><br><br>
                        <input class="controls" required="" type="text" placeholder="Email" name="txtemail" value="<?php echo $row['email']?>"><br><br>
                        <input class="controls" required="" type="text" placeholder="Contraseña" name="txtclave" value="<?php echo $row['pass']?>"><br><br>

                        <!-- Agregar campo para actualizar la imagen -->
                        <label for="img">Actualizar Imagen:</label>
                        <input type="file" name="img" accept="image/*"><br><br>

                        <input class="botons" type="submit" name="button" value="Actualizar">
</form>
                </section>
            </div>
        </div>
    </body>
</html>

<?php
    } else {
        // Manejar el caso en el que la consulta no devolvió resultados
        echo "No se encontraron datos para la boleta proporcionada.";
    }
?>