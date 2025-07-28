<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if (isset($_SESSION['us_tipo']) && $_SESSION['us_tipo'] == 2) {
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel Técnico - Farma Conecta</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../css/css/all.min.css">
</head>
<body>
    <div class="tech-container">
        <header>
            <h1>Panel Técnico</h1>
            <a href="../contralador/logout.php" class="logout-btn">Cerrar Sesión</a>
        </header>
        <main>
            <div class="tech-content">
                <h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre_us']); ?></h2>
                <p>Accede a las herramientas técnicas de la farmacia:</p>
                <div class="tech-actions">

                </div>
            </div>
        </main>
    </div>
</body>
</html>
<?php
} else {
    header('Location: ../index.php');
    exit();
}
?>