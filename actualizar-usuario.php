<?php

if(isset($_POST))
{
    require_once 'includes/conexion.php';

    // Recoger valores del formulario registro
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;

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


    $guardar_usuario = false;
    //Conteo de errores
    if(count($errores) == 0)
    {
        $usuario = $_SESSION['usuario'];   
        $guardar_usuario = true;

        // Comprobar email
        $sql = "SELECT id, email FROM usuarios WHERE email = '$email'";
        $isset_email = mysqli_query($db,  $sql);
        $isset_user = mysqli_fetch_assoc($isset_email);

        if($isset_user['id'] == $usuario['id'] || empty($isset_user))
        {
            // Actualizar usuarios en la BD
            
            $sql = "UPDATE usuarios SET ".
                "nombre = '$nombre', ".
                "apellidos = '$apellidos', ".
                "email = '$email' ".
                "WHERE id = ".$usuario['id'];

            $guardar = mysqli_query($db,$sql);

            if($guardar)
            {
                $_SESSION['usuario']['nombre'] = $nombre;
                $_SESSION['usuario']['apellidos'] = $apellidos;
                $_SESSION['usuario']['email'] = $email;

                $_SESSION['completado'] = "Tus datos se ha actulizado con éxito";
            }
            else
            {
                $_SESSION['errores']['general'] = "Fallo al actualizar el usuario";
            }
        }
        else
        {
            $_SESSION['errores']['general'] = "El usuario ya existe";
        }
    }
    else
    {
        $_SESSION['errores'] = $errores;
    }
}

header('Location: mis-datos.php');
?>