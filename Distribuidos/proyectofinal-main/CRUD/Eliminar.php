<?php
    include("Conexion.php");
    $conexion = conectar();
    $boleta = $_GET['boleta'];
    $sql = "SELECT * FROM alumnos WHERE boleta = '$boleta'";
    $query = mysqli_query($conexion,$sql);
    if($query){
        header("Location: CRUD.php");
    }
?>