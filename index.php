<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name ="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicio de Sesión</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type = "text/css" href="css/styles.css">
    <link rel = "stylesheet" type="text/css" href="css/css/all.min.css">

    </head>
<?php
session_start();
if (!empty($_SESSION['us_tipo'])) {
    // Si ya hay sesión activa, redirigir según el tipo de usuario
    switch ($_SESSION['us_tipo']) {
        case 1:
            header('Location: adm_catalogo.php');
            break;
        case 2:
            header('Location: tec_catalogo.php');
            break;
        default:
            session_destroy();
            break;
    }
    exit();
}

?>
<body>
    <img class = "wave" src = "img/wave.png" alt="">
    <div class="contenedor">
        <div class="img">
            <img src="img/undraw_medicine_hqqg.svg" alt="">
        </div>
        <div class = "contendor-login">
            <form action="contralador/LoginControllers.php" method="POST">
                
                <img src="img/doctor.png" alt="">
                <h2>Farmasys</h2>
                <?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
                    <div style="color: red; text-align: center; margin-bottom: 10px;">
                        Usuario o contraseña incorrectos
                    </div>
                <?php endif; ?>
                <div  class=" input-div dni">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>DNI</h5>
                        <input type="text" name ="dni" class = "input" required>
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Contraseña</h5>
                        <input type="password" name="pass" class = "input" required>
                    </div>
                </div>
                <a href="">Create Warpiece</a>
                <input type="submit" class="btn" value="Iniciar Sesión">
            </form>
    </div>
</body>
<script src ="js/login.js"></script>
<footer>
    <p>© 2025 Farmasys. Tu salud es nuestra responsabilidad</p>
</html>