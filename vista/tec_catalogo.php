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
    
    <!-- Contenedor para notificaciones -->
    <div id="notification-container"></div>
    
    <script>
    // Mostrar notificación de bienvenida para técnico
    window.addEventListener('load', function() {
        showWelcomeNotification('<?php echo htmlspecialchars($_SESSION['nombre_us']); ?>', 'tecnico');
    });
    
    function showWelcomeNotification(username, role) {
        const container = document.getElementById('notification-container');
        
        const notification = document.createElement('div');
        notification.className = 'toast-notification show';
        
        const roleText = role === 'tecnico' ? 'Técnico' : 'Administrador';
        const icon = role === 'tecnico' ? 'fas fa-user-cog' : 'fas fa-user-shield';
        const roleClass = role === 'tecnico' ? 'role-tech' : 'role-admin';
        
        notification.innerHTML = `
            <div class="toast-content">
                <div class="toast-icon">
                    <i class="${icon}"></i>
                </div>
                <div class="toast-text">
                    <h4>¡Bienvenido de vuelta!</h4>
                    <p><strong>${username}</strong> - <span class="role-badge ${roleClass}">${roleText}</span></p>
                    <small>Sistema Farmasys • ${new Date().toLocaleTimeString()}</small>
                </div>
                <button class="toast-close" onclick="closeNotification(this)">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        
        container.appendChild(notification);
        
        // Auto-cerrar después de 5 segundos
        setTimeout(() => {
            if (notification.parentNode) {
                closeNotification(notification.querySelector('.toast-close'));
            }
        }, 5000);
    }
    
    function closeNotification(button) {
        const notification = button.closest('.toast-notification');
        notification.classList.add('hide');
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 300);
    }
    </script>
</body>
</html>
<?php
} else {
    header('Location: ../index.php');
    exit();
}
?>