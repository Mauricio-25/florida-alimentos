<?php
    // ! Parametros para la conexión
    $server = "localhost";
    $bd = "florida_alimentos";
    $user = "root";
    $pass = "mauriciosoto252004";

    // ! Tablas de la BD
    $tabLinea = "linea";
    $tabProducto = "producto";

    // ! Conexión
    $conexion = mysqli_connect($server, $user, $pass, $bd) or die ("Problemas de conexion");
    
?>