<?php
// iniciar sesion
require_once 'includes/conexion.php';

// Recoger datos del formulario
if(isset($_POST))
{

    // Borrar sesion antigua
    if(isset($_SESSION['error_login']))
    {
        session_unset();
    }

    // Recoger datos del formulario
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Comprobar credenciales de user
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";


    $login = mysqli_query($db, $sql);

    if($login && mysqli_num_rows($login) == 1)
    {
        $usuario = mysqli_fetch_assoc($login);

        // Comprobar contraseña
        $verify = password_verify($password, $usuario['password']);

        if($verify)
        {
            //Sesión para guadar datos
            $_SESSION['usuario'] = $usuario;
        
        }
        else
        {
            // Sesión de fallo
            $_SESSION['error_login'] = 'LOGIN INCORRECTO';
        }
    }
    else
    {
        // MSJ de error
        $_SESSION['error_login'] = 'LOGIN INCORRECTO';
    }
}

// redirigir a index
header('Location: index.php');