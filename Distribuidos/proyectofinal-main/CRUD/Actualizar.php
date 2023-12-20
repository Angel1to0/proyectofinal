<?php
    include("Conexion.php");
    $conexion = conectar();
    $id = $_GET['id'];
    $sql = "SELECT * FROM alumnos WHERE id = '$id'";
    $query = mysqli_query($conexion,$sql);
    $row=mysqli_fetch_array($query);

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
                        <input class="controls" required="" readonly type="text" placeholder="ID" name="txtID" value="<?php echo $row['id']?>"><br><br>
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