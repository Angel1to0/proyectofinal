<?php
    include("Conexion.php");
    $conexion = conectar();
    $ID = $_GET['id'];
    $sql = "DELETE FROM alumnos WHERE id = '$id'";
    $query = mysqli_query($conexion,$sql);
    if($query){
        header("Location: CRUD.php");
    }
?>