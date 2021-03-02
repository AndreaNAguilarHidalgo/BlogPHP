<?php

if(isset($_POST))
{
    require_once 'includes/conexion.php';

    if(!isset($_SESSION))
    {
        session_start();
    }

    // Recoger valores del formulario registro
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    $password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : false;

    // Arreglo de errores
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

    //Validación APELLIDOS
    if(!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos))
    {
        $apellidos_validate = true;
    }
    else
    {
        $apellidos_validate = false;
        $errores['apellidos'] = "Los apellidos no son válidos";
    }

    //Validación EMAIL
    if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $email_validate = true;
    }
    else
    {
        $email_validate = false;
        $errores['email'] = "Email no válido";
    }

    //Validación CONTRASEÑA
    $validacion = '/^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])\S{8,16}$/';
    if(preg_match($validacion, $password) &&  !empty($password))
    {  
        $password_validate = true;
    }
    else
    {
        $password_validate = false;
        //$errores['password'] = 'LA CONTRASEÑA ESTÁ VACÍA';
        $errores['password'] = 'La contraseña debe tener al entre 8 y 16 caracteres,'.
        ' al menos un dígito, al menos una minúscula, al menos una mayúscula y al menos'. 
        ' un caracter no alfanumérico.';
    }
    

    $guardar_usuario = false;
    //Conteo de errores
    if(count($errores) == 0)
    {
        
        $guardar_usuario = true;

        //Cifrar contraseña
        $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);

        // insertar usuarios en la BD
        $sql = "INSERT INTO usuarios VALUES(NULL, '$nombre', '$apellidos', '$email', '$password_segura', CURDATE());";
        $guardar = mysqli_query($db,$sql);

        if($guardar)
        {
            $_SESSION['completado'] = "El registro se ha completado con éxito";
        }
        else
        {
            $_SESSION['errores']['general'] = "Fallo al guardar el usuario";
        }
    }
    else
    {
        $_SESSION['errores'] = $errores;
    }
}

header('Location: index.php');
?>