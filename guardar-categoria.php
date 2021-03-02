<?php

if(isset($_POST))
{
    // CONEXIÓN BD
    require_once 'includes/conexion.php';

    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;

    $errores = array();

    //Válidar datos
    //Validación NOMBRE
    if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre))
    {
        $nombre_validate = true;
    }
    else
    {
        $nombre_validate = false;
        $errores['nombre'] = "El nombre no es válido";
    }

    // Comprobar si no llegan errores
    if(count($errores) == 0)
    {
		$sql = "INSERT INTO categorias VALUES(NULL, '$nombre');";
		$guardar = mysqli_query($db, $sql);
	}
}
header('Location: index.php');