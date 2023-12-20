<?php
    include("Conexion.php");
    $conexion = conectar();
    $sql = "SELECT * FROM alumnos";
    $query = mysqli_query($conexion,$sql);
    $row = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sarpa</title>
    <link rel="stylesheet" href="./CSS/Estilos.css">
    <link rel="icon" href="../assets/img/Logo.png">
</head>

<body>

    <header>
        <div class="contenedor">
            <img src="../assets/img/Sarpa.png" alt="fondo" class="imglogo">
            <h2 class="LogoT">Administrador 
            </h2>
            <nav>
                <a href="#" class="activo">información General</a>
                <a href="#">Materias</a>
                <a href="../Lenguajes/C/LenguajeC.html">Calificaciones</a>
                <a href="../formulario.html">Cerrar Sesion</a>
            </nav>
        </div>
    </header>

    <main>
        <div class="principal">
            <div class="contenedor">
                <h3 class="titulo">Tabla de usuarios</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Boleta</th>
                            <th>Nombre</th>
                            <th>Apellido P</th>
                            <th>Apellido M</th>
                            <th>Email</th>
                            <th>Contraseña</th>
                            <th>Editar información</th>
                            <th>Eliminar usuarios</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while($row = mysqli_fetch_array($query)){
                        ?>
                        <tr>
                            <th><?php echo $row['id'];?></th>
                            <th><?php echo $row['boleta'];?></th>
                            <th><?php echo $row['nombre'];?></th>
                            <th><?php echo $row['firstls'];?></th>
                            <th><?php echo $row['secondls'];?></th>
                            <th><?php echo $row['email'];?></th>
                            <th><?php echo $row['pass'];?></th>
                            <th><a class = "neon" href="./Actualizar.php?id=<?php echo $row['id'] ?>">Editar</a></th>
                            <th><a class = "neonE" href="./Eliminar.php?id= <?php echo $row['id'] ?>">Eliminar</a></th>

                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
                </div>
        </div>
    </main>

    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
	<script src="js/main.js"></script>
</body>

</html>