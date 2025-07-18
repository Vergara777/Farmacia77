<?php

include_once '../modelo/Usuario.php';
session_start();

// Verificar si se enviaron los datos del formulario
if (isset($_POST['dni']) && isset($_POST['pass'])) {
    $user = $_POST['dni'];
    $pass = $_POST['pass'];
    $usuario = new Usuario();

    // Verificar si ya hay una sesión activa
    if (!empty($_SESSION['us_tipo'])) {
        // Si ya hay sesión activa, redirigir según el tipo de usuario
        switch ($_SESSION['us_tipo']) {
            case 1:
                header("Location: ../vista/adm_catalogo.php");
                break;
            case 2:
                header("Location: ../vista/tec_catalogo.php");
                break;
            default:
                header("Location: ../vista/indexindex.php");
                break;
        }
        exit();
    } else {
        // Si no hay sesión activa, proceder con el login
        $usuario->Loguearse($user, $pass);
        
        // Verificar si se encontró un usuario
        if (!empty($usuario->objetos)) {
            foreach ($usuario->objetos as $objeto) {
                $_SESSION['usuario'] = $objeto->id_usuario;
                $_SESSION['us_tipo'] = $objeto->us_tipo;
                $_SESSION['nombre_us'] = $objeto->nombre_us;
            }
            
            // Redirigir según el tipo de usuario
            switch ($_SESSION['us_tipo']) {
                case 1:
                    header("Location: ../vista/adm_catalogo.php");
                    break;
                case 2:
                    header("Location: ../vista/tec_catalogo.php");
                    break;
                default:
                    header("Location: ../vista/index.php");
                    break;
            }
            exit();
        } else {
            // Si no se encontró usuario, redirigir al login
            header("Location: ../vista/index.php?error=1");
            exit();
        }
    }
} else {
    // Si no se enviaron datos POST, redirigir al login
    header("Location: ../vista/index.php");
    exit();
}
?>