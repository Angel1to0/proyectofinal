<?php
    function conectar(){
        $servername = "proyectofinal-bd.mysql.database.azure.com";
        $username = "Angel";
        $password = "Password123456";
        $dbname = "sarpa";
        $conexion = mysqli_connect($host,$user,$pass);
        mysqli_select_db($conexion,$bd);

        return $conexion;
    }
?>